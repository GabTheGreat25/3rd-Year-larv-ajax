<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;
    public $table = "admin";
    public $timestamps = false;
    public $primaryKey = "admin_id";
    protected $fillable = [
        "name",
        "age",
        "image_path",
        "user_id"
    ];

    public function users() {
        return $this->belongsTo('App\Models\User','user_id','admin_id');
    }
}
