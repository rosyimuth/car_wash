<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'foto',
        'nama',
        'jenis',
        'deskripsi',
        'harga',
    ];
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
