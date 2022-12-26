<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $primaryKey = 'transaction_id';
    public $timestamps = false;
    protected $fillable = ['date_of_rent','payment_type','shipment_type','status','client_id'];
    
    public function accessories(){
        return $this->belongsToMany(accessories::class,'accessories_transaction_line','accessories_id','transaction_id')->withPivot('quantity');
    }

    public function cameras(){
        return $this->belongsToMany(camera::class,'camera_transaction_line','camera_id','transaction_id')->withPivot('quantity');
    }
}
