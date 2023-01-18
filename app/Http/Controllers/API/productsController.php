<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productsModel;
use Validator;
class productsController extends Controller{
    public function index(Request $request){
        $product_data= productsModel::with('getGroup')->get();
        if(!empty($product_data)){
            $response=[
                'sucess'=> true,
                'data'=>$product_data
            ];
            return response()->json($response,200);
        }else{
            $response=[
                'sucess'=> false,
                'data'=>'no data found'
            ];
            return response()->json($response,400);
        }

    }
    public function productAdd(Request $request){
        $validator=Validator::make($request->all(),[
            'name' => 'required|string',
            'price'=>'required|numeric',
        ]);
        if($validator->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator->errors()
            ];  
            return response()->json($response,400);
        }else{
            $input=$request->all();
            $products=productsModel::create($input);
            $response=[
            'success'=>true,
            'message'=>'product add succesfully',
            ];
            return response()->json($response,200);
        }
        
    }
    public function productUpdate(Request $request){
        $validator=Validator::make($request->all(),[
            'product_id'=>'required|numeric',
            'name' => 'required|string',
            'price'=>'required|numeric',
        ]);
        if($validator->fails()){
            $response=[
                'success'=>false,
                'message'=>$validator->errors()
            ];  
            return response()->json($response,400);
        }else{
            $id=$request->product_id;
            $products=productsModel::where('product_id' , '=',$id)->first();
            if(!empty($products)){
                $products->name=$request->name; 
                $products->price=$request->price;   
                $products->update();
                if($products){
                    $response=[
                    'success'=>true,
                    'message'=>'update succesfully',
                    ];
                    return response()->json($response,200);
                }else{
                    $response=[
                        'success'=>false,
                        'message'=>'no data update',
                        ];
                        return response()->json($response,200);
                }
            }else{
                $response=[
                    'success'=>false,
                    'message'=>'lease provide a valid product id',
                    ];
                    return response()->json($response,400);
            }
        }
    }
}
