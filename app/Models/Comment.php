<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Post -> table_name = post
    // custome table name :
    // protected $table='table_name'

    //define cloumn name
    protected $table = 'comment';
    protected $fillable = array('id', 'nama', 'email', 'judul', 'author', 'gender','description',);
}