<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function province(){                             // create post
        return $this->belongsTo(District::class,'province_id');
    }
}
