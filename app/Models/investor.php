<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class investor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"];
    public $table = "investor";
    public $timestamps = false;
    public $primaryKey = "investor_id ";
    protected $fillable = [
        "full_name",
        "age",
        "contact_number",
        "image_path",
        "user_id",
        'deleted_at'
    ];
    
    public function users() {
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
}
