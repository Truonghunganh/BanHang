<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory; 
    protected $fillable=['id','link','image'];
    protected $table = "slides";// lấy cái bảng từ sql
}
