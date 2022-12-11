<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camera extends Model
{
    use HasFactory;
    public $table = "camera";
    public $timestamps = false;
    public $primaryKey = "camera_id";
    protected $fillable = [
        "model",
        "shuttercount",
        "quantity",
        "costs",
        "image_path"
    ];
}
