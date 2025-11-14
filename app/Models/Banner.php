<?php

namespace App\Models;

use App\BannerStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
     use HasFactory;
     
      protected $fillable = [
        'image_path', 
        'link',
        'is_active'        
    ];


}
