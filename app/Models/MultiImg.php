<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiImg extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
        //multiimg table er sathe product table er relation jeikhne multiimg er product_id product table er product id er sathe match korbe
    }

}
