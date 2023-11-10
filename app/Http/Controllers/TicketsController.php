<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // Validasi formulir di sini jika diperlukan

        // Simpan data ke dalam database
        $userId = auth()->user()->userId; // Ambil ID pengguna yang terautentikasi
        // $userId = $request->input('userId');
        $tempatId = $request->input('tempatId');
        $tanggal = $request->input('tanggal');
        $ticketType = $request->input('ticketType');


        Booking::create([
            'user_id' => $userId,
            'tempat_id' => $tempatId,
            'bookingDate' => $tanggal,
            'ticketType' => $ticketType,
            'status' => 'pending', // Sesuaikan sesuai kebutuhan
        ]);

        // Redirect atau kirim respons balik ke React
        return Inertia::render('Tiket', [
            'pesan' => 'berhasil'
        ]);
    }
}
