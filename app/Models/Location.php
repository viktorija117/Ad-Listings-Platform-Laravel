<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name'];

    public function ads() {
        return $this->hasMany(Ad::class);
    }
}

