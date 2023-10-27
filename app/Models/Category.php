<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Post -> table_name = post
    // custome table name :
    // protected $table='table_name'

    //define cloumn name
    protected $table = 'category';
    protected $fillable = array('id','name', 'email', 'judul', 'status','description',);
}