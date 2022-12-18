<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"];
    public $table = "client";
    // public $timestamps = false;
    public $primaryKey = "client_id";
    protected $fillable = [
        "full_name",
        "age",
        "valid_id",
        "billing_address",
        "address",
        "contact_number",
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
