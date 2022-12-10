<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investor extends Model
{
    use HasFactory;
    public $table = "investor";
    public $timestamps = false;
    public $primaryKey = "investor_id ";
    protected $fillable = [
        "name",
        "age",
        "contact_number",
        "image_path"
    ];
    // public function services() {
    //     return $this->hasMany('App\Models\service');
    // }
}
