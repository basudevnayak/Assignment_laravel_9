<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productsModel;
use App\Models\imageModel;
class imageUploadController extends Controller{
    public function imageUpload(Request $request){
        // if($request->has('image')){
        //     $image=$request->image;
        //     $name=time().'.'.$image->getClientOriginalExtension();
        //     $path=public_path('upload');
        //     $image->move($path,$name);
        //     return response()->json(['data'=>$name,'message'=>'image upload succesfully','status'=>true],200);
        // }
        $productsModel=productsModel::where('name' , '=',$request->product_name)->first();
        if(!empty($productsModel)){
            $product_id=$productsModel['product_id'];
            if($request->has('image')){
                $image=$request->image;
                $image_name=[];
                foreach($image as $key=>$value){
                    $name=time().$key.'.'.$value->getClientOriginalExtension();
                    $image_name[]=$name;
                    $path=public_path('upload');
                    $value->move($path,$name);
                }
                    $imageModel=new imageModel();
                    $imageModel->files=json_encode($image_name); 
                    $imageModel->product_id=$product_id;   
                    $imageModel->save();
                    $response=[
                        'data'=>$name,
                        'message'=>'image upload succesfully',
                        'status'=>true];
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
