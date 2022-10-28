<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
