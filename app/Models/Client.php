<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'lastName',
        'postalCode',
        'city',
        'phone',
        'email',
        'typeOfClient',
    ];

    public function getClientTextAttribute()
    {
        switch($this->typeOfClient) {
            case 0:
                return 'Nowy';
            case 1:
                return 'Stały';
            case 2:
                return 'Nowy';
            default:
                return 'Powracający';
        }
    }
}
