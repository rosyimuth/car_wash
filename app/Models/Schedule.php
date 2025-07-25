<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
    ];
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
