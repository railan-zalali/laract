<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Booking extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'bookingId';
    protected $table = 'bookings'; // Sesuaikan dengan nama tabel database Anda jika berbeda
    protected $fillable = ['user_id', 'tempat_id', 'bookingDate', 'ticketType', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'tempatID');
    }
}
