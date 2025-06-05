<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    // Menambahkan atribut virtual ke hasil JSON
    protected $appends = ['ketJenis'];

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

    // Accessor: akan dipanggil saat JSON di-generate
    public function getKetJenisAttribute()
    {
        return DB::selectOne("SELECT ketJenis(?) AS hasil", [$this->jenis])->hasil ?? '-';
    }
}
