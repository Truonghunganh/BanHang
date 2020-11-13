<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Type_Product;
use App\Providers\Services\TypeProductService;

class Type_ProductsController extends Controller
{
    protected $typeProductService;
    public function __construct(TypeProductService $typeProductService){
        $this->typeProductService = $typeProductService;
    }
    public function index()
    {
        try {
            $Type_Product = $this->typeProductService->getAll();
            
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'TypeProducts'=> $Type_Product,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $Type_Product = $this->typeProductService->save(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $request->image
                ]
            );
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'TypeProducts'=>$Type_Product
            ]);
        } 
        catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $ProductsByidTypeProduct = $this->typeProductService->getProductsByidTypeProduct($id);
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'ProductsByidTypeProduct' => $ProductsByidTypeProduct
            ]);
        } catch (\Exception $e) {
            $ProductsByidTypeProduct = $this->typeProductService->getProductsByidTypeProduct($id);
            return response()->json([
                'status'  => false,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $Type_Product = $this->typeProductService->save(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $request->image
                ],
                $id
            );
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'TypeProducts' => $Type_Product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ]);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->typeProductService->delete([$id]);
            return response()->json([
                'status'  => true,
                'code'    => Response::HTTP_OK,
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
