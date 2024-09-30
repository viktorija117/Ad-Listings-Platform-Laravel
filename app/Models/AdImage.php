<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    protected $fillable = ['ad_id', 'image_path'];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}

