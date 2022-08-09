<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    //Modifica la tabla de images en bd
    protected $table='images'; // Como esta declarada en la bd
    //Relacion one to many
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
    //Relacion one to many Like
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }
    // many to one
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

}
