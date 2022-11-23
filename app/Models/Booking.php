<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Room;
use App\Models\Client;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'booking';

    protected $fillable = [
        'client_id',
        'room_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
        'numberOfPeople',
        'price',
        'comments',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusTextAttribute()
    {
        switch($this->status)
        {
            case 0:
                return 'Nie wybrano';
            case 1:
                return 'Zarezerwowane';
            case 2:
                return 'Oczekiwanie na płatność';
            case 3:
                return 'Zapłacone';
        }
    }
}
