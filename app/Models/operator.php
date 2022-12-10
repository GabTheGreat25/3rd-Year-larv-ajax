<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operator extends Model
{
    use HasFactory;
    public $table = "operator";
    public $timestamps = false;
    public $primaryKey = "operator_id";
    protected $fillable = [
        "full_name",
        "contact_number",
        "age",
        "address",
        "image_path"
    ];

    public function services() {
        return $this->hasMany('App\Models\service');
    }
}
