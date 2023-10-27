<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Post -> table_name = post
    // custome table name :
    // protected $table='table_name'

    //define cloumn name
    protected $fillable = array('id', 'name', 'price','nama_produk','jenis_produk');

    public $timestamps = true;
}