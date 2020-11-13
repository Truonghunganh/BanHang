<?php

namespace App\Providers\Services;

use Illuminate\Support\ServiceProvider;
use App\Models\Bill;
class BillService 
{
    public function getAll($request, $Limit = 4)
    {
        // sort=asc : tăng dần
        // sort=desc : giảm dần
        $query = Bill::query();
        if ($request->get('id_customer')) {
            return $query->where('id_customer', $request->get('id_customer'))->paginate($Limit);
        }
        if ($request->get('column') && $request->get('sort')) {
            $query->orderBy($request->get('column'), $request->get('sort'));
        }

        return $query->paginate($Limit);
    }
    public function getBillById($id)
    {
        return Bill::where('id_type', $id)->get(); // lấy cái  loại sản phẩm;
    }
    public function save(array $data, int $id = null)
    {

        return Bill::updateOrCreate(
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
        return Bill::find($id);
    }
    public function destroy($ids = [])
    {
        return Bill::destroy($ids);
    }
    
}
