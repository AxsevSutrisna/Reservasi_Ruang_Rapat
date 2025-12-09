<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'user_id',
        'room_id',
        'tanggal',
        'waktu_mulai',
        'waktu_berakhir',
        'tujuan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'tanggal' => 'datetime',
        'waktu_mulai' => 'datetime:H:i',
        'waktu_berakhir' => 'datetime:H:i',
    ];


}
