<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function createPro(Request $request)
    {
        $user = Auth::user();
        if ($user==null) {
            return response()->json([
                'message' => 'User not found (Error token)',
                'refresh_token'=>true
            ], 201);
        }
        $pro_data = $request->all();
        $pro_data['creater_id']=$user->id;
        $pro_data['updater_id']=$user->id;
        $existingProducts = Product::where('model', $pro_data['model'])->get();
        if ($existingProducts->count() > 0) {
            return response()->json([
                'message' => 'Product already added',
                'data' => $existingProducts,
            ], 201);
        }
        $name_image=time() . '.' . $request->pro_image->extension();
        $pro_data['pro_image']=$name_image;
        $request->pro_image->move(public_path('proImages'), $name_image);
        $pro_data = Product::create($pro_data);
        return response()->json([
            'message' => 'Product added',
            'data'=>$pro_data
        ], 200);
    }
    public function editPro()
    {

    }
    public function showPro()
    {
        $pro = Product::get();
        return response()->json([
            'message' => 'This all products',
            'data'=>$pro
        ], 200);
    }
}
