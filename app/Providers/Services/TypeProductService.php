<?php

namespace App\Providers\Services;

use App\Models\Product;
use App\Models\Type_Product;

class TypeProductService 
{
    public function getAll()
    {
        return Type_Product::all();
    }
    public function save(array $data ,int $id = null)
    {

        return Type_Product::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'image'=> $data['image']
            ]

        );
    }
    public function delete($ids=[]){
        return Type_Product::destroy($ids);
    }
public function getProductsByidTypeProduct($id){
    return Product::where('id_type', $id)->get();
}
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
