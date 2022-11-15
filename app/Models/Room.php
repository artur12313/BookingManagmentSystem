<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'rooms';

    protected $fillable = [
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getBookingsAttribute()
    {
        return $this->bookings()->get();
    }

    public function getBookingsCountAttribute()
    {
        return $this->bookings()->count();
    }
}
