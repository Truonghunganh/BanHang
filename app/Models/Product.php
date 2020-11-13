<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'id_type',
        'description',
        'unit_price',
        'promotion_price',
        'image',
        'unit',
        'new'

    ];
    
    // public function questions()
    // {
    //     return $this->belongsToMany(Question::class);
    // }
    // public function type_products()
    // {
    //     return $this->belongsTo('App\Models\Type_Products', 'id_type', 'id');
    //     // id : ở đây là id của Products
    // }
    // public function bill_detail()
    // {
    //     return $this->hasMany('App\Models\Bill_Detail', 'id_product', 'id');
    // }
}
