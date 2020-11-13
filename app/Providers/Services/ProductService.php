<?php

namespace App\Providers\Services;

use Illuminate\Support\ServiceProvider;

use App\Models\Product;
class ProductService 
{
    public function getAll($request, $Limit = 4)
    {
        // sort=asc : tăng dần
        // sort=desc : giảm dần
        $query = Product::query();
        if($request->get('id_type')){
            return $query->where('id_type', $request->get('id_type'))->paginate($Limit);
        }
        if ($request->get('column')&& $request->get('sort')) {
            $query->orderBy($request->get('column'), $request->get('sort'));
        }
       
       
        return $query->paginate($Limit);
    }
    public function getProductByIdTypeProduct($id)
    {
        return Product::where('id_type', $id)->get(); // lấy cái  loại sản phẩm;
    }
    public function save(array $data, int $id = null)
    {

        return Product::updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $data['name'],
                'id_type' => $data['id_type'],
                'description' => $data['description'],
                'unit_price' => $data['unit_price'],
                'promotion_price' => $data['promotion_price'],
                'image' => $data['image'],
                'unit' => $data['unit'],
                'new' => $data['new']
            ]

        );
    }
    public function findById($id)
    {
        return Product::find($id);
    }
    public function destroy($ids = [])
    {
        return Product::destroy($ids);
    }
    public function register()
    {
        //
    }
    public function boot()
    {
        //
    }
}
