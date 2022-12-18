<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class admin extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"];
    public $table = "admin";
    // public $timestamps = false;
    public $primaryKey = "admin_id";
    protected $fillable = [
        "name",
        "age",
        "image_path",
        "user_id",
        "created_at",
        "updated_at",
        'deleted_at'
    ];

    public function users() {
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
}
