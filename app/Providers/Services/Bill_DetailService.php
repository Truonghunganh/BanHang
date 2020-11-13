<?php

namespace App\Providers\Services;

use Illuminate\Support\ServiceProvider;
use App\Models\Bill_Detail;
class Bill_DetailService 
{
    public function getAll($request, $Limit = 4)
    {
        // sort=asc : tăng dần
        // sort=desc : giảm dần
        $query = Bill_Detail::query(); // câu lệnh sql dùng cho Bill Detail
        if ($request->get('id_bill')) {// nếu có yêu cầu id 
            return $query->where('id_bill', $request->get('id_bill'))->paginate($Limit);
        }
        // có sấp sấp xếp
        if ($request->get('column') && $request->get('sort')) {
            $query->orderBy($request->get('column'), $request->get('sort'));
        }

        // lấy hết các yêu cầu ra
        return $query->paginate($Limit);
    }
    public function save(array $data, int $id = null)
    {

        return Bill_Detail::updateOrCreate(
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
        return Bill_Detail::find($id);
    }
    public function destroy($ids = [])
    {
        return Bill_Detail::destroy($ids);
    }
}
