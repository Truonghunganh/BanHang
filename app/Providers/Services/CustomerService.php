<?php

namespace App\Providers\Services;
use App\Models\Customer;
use Illuminate\Support\ServiceProvider;

class CustomerService extends ServiceProvider
{
    public function getAll($request, $Limit = 4)
    {
        // sort=asc : tăng dần
        // sort=desc : giảm dần
        $query = Customer::query();
        if ($request->get('column') && $request->get('sort')) {
            $query->orderBy($request->get('column'), $request->get('sort'));
        }
        return $query->paginate($Limit);
    }
    public function getCustomerById($id)
    {
        return Customer::where('id_type', $id)->get(); // lấy cái  loại sản phẩm;
    }
    public function save(array $data, int $id = null)
    {

        return Customer::updateOrCreate(
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
        return Customer::find($id);
    }
    public function destroy($ids = [])
    {
        return Customer::destroy($ids);
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
