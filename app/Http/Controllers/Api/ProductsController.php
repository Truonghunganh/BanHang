<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\Services\ProductService;

class ProductsController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    // index : get all products
    // 
    public function index(Request $request)
    {
        try {
            $limit=$request->get('limit')??config('app.paginate.per_page');
            
            $productService= $this->productService->getAll($request,$limit);
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'product' => $productService->items(),
                'meta'    =>[
                    'total'       => $productService->total(),
                    'perPage'     => $productService->perPage(),
                    'currentPage' => $productService->currentPage(),
                    'lastPage'    => $productService->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getProductByIdTypeProduct($id){
        try {
            $productService = $this->productService->getProductByIdTypeProduct($id);
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'product' => $productService->findById($id),

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }    
    
    public function store(Request $request)
    {
        try {
            $productService = $this->productService->save([
                
                'id_type'=>$request->id_type,
                'description'=>$request->description,
                'unit_price'=>$request->unit_price,
                'promotion_price'=>$request->promotion_price,
                'image'=>$request->image,
                'unit'=>$request->unit,
                'new'=>$request->new,
                'name' => $request->name, 
                ]);
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'product' => $productService,
                
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        dd("haha");
        try {
            $SanPhamTheoIDloai = $this->productService->findById($id);
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'product' => $SanPhamTheoIDloai,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $productService = $this->productService->save(
            [
                'id_type' => $request->id_type,
                'description' => $request->description,
                'unit_price' => $request->unit_price,
                'promotion_price' => $request->promotion_price,
                'image' => $request->image,
                'unit' => $request->unit,
                'new' => $request->new,
                'name' => $request->name,
            ],$id);
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'product' => $productService,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->destroy([$id]);
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }
}
