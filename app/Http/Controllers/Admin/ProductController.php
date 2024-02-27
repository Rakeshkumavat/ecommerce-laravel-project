<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function showForm(){
        $categorys = Category::orderBy('name','asc')->Pluck('name','id')->toArray();    
        $product = new Product;
        return view('admin.product.product_add',compact('product','categorys'));
    }

    public function productFormStore(Request $request){
        // dd($request->all());
        $response = array('status'=>false,'message'=>'');
        $request->validate([
            'name'=>'required|unique:products',
            'amount'=>'required',
            'quantity'=>'required',
            'description'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('assets/images/product'),$imageName);

        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->amount = $request->amount;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();
        $response['status'] = true;

        return response()->json($response);

    
    }

    public function productFormList(ProductDataTable $datatable)
    {
        $categorys = Category::Pluck('name','id')->toArray();
        return $datatable->render('admin.product.product_list',compact('categorys'));
    }

    public function productEdit($id){
        $categorys = Category::orderBy('name','asc')->Pluck('name','id')->toArray();
        $product = Product::find($id);
        return view('admin.product.product_edit',compact('categorys','product'));

    }

    public function productUpdate(Request $request){
        // dd($request->all());
        $response = array('status'=>false,'message'=>'');
        $request->validate([
            'name'=>'required|unique:products,name,'.$request->id,
            'amount'=>'required',
            'quantity'=>'required',
            'description'=>'required',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:1000',
        ]);

        $product = Product::find($request->id);
        // dd($product);
        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images/product'),$imageName);
            $product->image = $imageName;
        }
        
        $product->name = $request->name;
        $product->slug = Str::slug($request->name, '-');
        $product->amount = $request->amount;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();
        $response['status'] = true;

        return response()->json($response);

    
    }



    public function productDelete($id){
        $response = array('status'=>false);
        if ($id) {
            $product = Product::find($id);
            $product->delete();
            $response['status'] = true;
        }
        return response()->json($response);
    }

    public function productStatus($id){
        $response = array('status'=>false,'message'=>'');
        $product = Product::find($id);

        if ($product){
            $product->status = $product->status == 1 ? 0 : 1;
            $product->save();
            // dd($product->save());
            $response['status'] = true;
        }
        return response()->json($response);
    }



}
