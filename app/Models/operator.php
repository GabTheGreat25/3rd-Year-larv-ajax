<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class operator extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"];
    public $table = "operator";
    public $timestamps = false;
    public $primaryKey = "operator_id";
    protected $fillable = [
        "full_name",
        "contact_number",
        "age",
        "address",
        "image_path",
        "user_id",
        'deleted_at'
    ];

    public function services() {
        return $this->hasMany('App\Models\service');
    }
}
