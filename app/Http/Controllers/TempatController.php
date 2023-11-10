<?php

namespace App\Http\Controllers;

use App\Http\Requests\TempatStoreRequest;
use App\Models\Tempat;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PHPUnit\Framework\Attributes\Ticket;

class TempatController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        // Inisialisasi array untuk menyimpan tanggal dan hari
        $dates = [];

        // Loop untuk mengambil semua tanggal dalam 7 hari ke depan
        for ($i = 0; $i < 7; $i++) {
            $currentDate = $today->clone()->addDays($i);
            $formattedDate = $currentDate->format('d-m-Y');
            $dayOfWeek = $currentDate->isoFormat('dddd'); // Menampilkan hari dalam bahasa Inggris

            $dates[] = [
                'date' => $formattedDate,
                'day' => $dayOfWeek,
            ];
        }




        $data = Tempat::all();

        return Inertia::render('Tiket', [
            'props' => $data,
            'today' => $today,
            'dateAndDays' => $dates
            // 'dateAndDays' => $dateAndDays,
            // 'dateAndDays' => $dateAndDays,

        ]);
    }
    public function home()
    {
        $data = User::all();

        return Inertia::render('Home', [
            'props' => $data
        ]);
    }

    public function tampilkanTanggal()
    {
        // Tanggal hari ini
        $today = Carbon::now();

        // Tanggal 1 minggu ke depan
        $nextWeek = Carbon::now()->addWeek();

        return Inertia::render('Tiket', [
            'today' => $today,
            'nextWeek' => $nextWeek,
        ]);
    }
    public function show($id)
    {
        $tempat = Tempat::find($id);
        if (!$tempat) {
            return response()->json([
                'message' => 'Tempat Tidak Ditemukan'
            ], 404);
        }

        return response()->json([
            'tempat' => $tempat
        ], 200);
    }

    public function store(TempatStoreRequest $request)
    {
        try {
            $tempat = new Tempat;
            $tempat->namaTempat = $request->input('namaTempat');
            $tempat->alamat = $request->input('alamat');
            $tempat->kota = $request->input('kota');
            $tempat->kapasitas = $request->input('kapasitas');
            $tempat->deskripsi = $request->input('deskripsi');
            $tempat->tanggal = $request->input('tanggal');
            $tempat->harga = $request->input('harga');

            // Upload dan simpan gambar tempat jika diperlukan
            if ($request->hasFile('fotoTempat')) {
                $tempat->fotoTempat = $request->file('fotoTempat')->store('public/tempat');
            }

            $tempat->kontak = $request->input('kontak');
            $tempat->save();

            return response()->json([
                'message' => 'Tempat berhasil ditambahkan'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ada Sesuatu Yang Salah!'
            ], 500);
        }
    }

    public function update(TempatStoreRequest $request, $id)
    {
        try {
            $tempat = Tempat::find($id);
            if (!$tempat) {
                return response()->json([
                    'message' => 'Tempat tidak ditemukan'
                ], 404);
            }

            $tempat->namaTempat = $request->input('namaTempat');
            $tempat->alamat = $request->input('alamat');
            $tempat->kota = $request->input('kota');
            $tempat->kapasitas = $request->input('kapasitas');
            $tempat->deskripsi = $request->input('deskripsi');
            $tempat->harga = $request->input('harga');
            // Upload dan simpan gambar tempat jika diperlukan
            if ($request->hasFile('fotoTempat')) {
                $tempat->fotoTempat = $request->file('fotoTempat')->store('public/tempat');
            }

            $tempat->kontak = $request->input('kontak');
            $tempat->save();

            return response()->json([
                'message' => 'Data tempat berhasil diperbarui'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ada Sesuatu Yang Salah!'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $tempat = Tempat::find($id);
        if (!$tempat) {
            return response()->json([
                'message' => 'Tempat tidak ditemukan'
            ], 404);
        }

        $tempat->delete();

        return response()->json([
            'message' => 'Data tempat berhasil dihapus'
        ], 200);
    }
    public function searchTickets(Request $request)
    {

        $request->validate([
            'namaTempat' => 'required|string',
            // Add other validation rules as needed
        ]);
        // $result = Tempat::all();
        // $type = TicketType::all();

        // 
        // Tanggal hari ini
        $today = Carbon::now();
        Carbon::setLocale('id');

        // Inisialisasi array untuk menyimpan tanggal dan hari
        $dates = [];

        // Loop untuk mengambil semua tanggal dalam 7 hari ke depan
        for ($i = 0; $i < 7; $i++) {
            $currentDate = $today->clone()->addDays($i);
            $formattedDate = $currentDate->format('d-m-Y');
            $dayOfWeek = $currentDate->isoFormat('dddd'); // Menampilkan hari dalam bahasa Inggris

            $dates[] = [
                'date' => $formattedDate,
                'day' => $dayOfWeek,
            ];
        }

        $result = Tempat::where('namaTempat', $request->namaTempat)
            ->get();
        // Perform your search logic using $request->namaTempat and other parameters
        // $searchResults = [
        // $request->namaTempat
        //];  Replace this with your actual search logic

        // Assuming $searchResults is an array of results, you can pass it to the Inertia view
        return Inertia::render('ResultSearch', [
            'searchResults' => $result,
            'dateAndDays' => $dates,
        ]);
    }
}
