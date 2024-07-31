<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $dates = ['fecha'];

    protected $fillable = [
        'user_id',
        'motivo',
        'fecha',
        'monto',
        'estatus',
    ];

    //Uno a Muchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }


}
