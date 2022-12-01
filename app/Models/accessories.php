<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accessories extends Model
{
    use HasFactory;
    public $table = "accessories";
    public $timestamps = false;
    public $primaryKey = "accessories_id";
    protected $fillable = [
        "description",
        "quantity",
        "costs",
        "image_path"
    ];

    // public function services() {
    //     return $this->hasMany('App\Models\service');
    // }
}
