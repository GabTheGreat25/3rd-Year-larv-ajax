<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'contact_number', 'comments', 'ratings', 'operator_id'];

    protected $table = "comment"; 

    protected $primaryKey = "comment_id";

    public $timestamps = false;

}
