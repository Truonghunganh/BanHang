<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
    ];
    
    protected $table = "type_products";
    public function product()
    {
        return $this->hasMany('App\Products', 'id_type', 'id');
        // id : ở đây là id của Type_Products
        // id_type : dùng chung cho Type_Products và Products
    }
    
}
