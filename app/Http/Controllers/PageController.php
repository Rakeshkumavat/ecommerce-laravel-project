<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Session;
class PageController extends Controller
{
    // dd(12);
    public function index(Request $request)
    {  

        // $test =
        //     [
        //         1 => [
        //             "id" => 1,
        //             "category_id" => 1,
        //             "name" => "gbnf",
        //             "amount" => 611.0,
        //             "image" => "1708903757.jpg",
        //             "description" => "cvbbbbbfgfg bfgbfb",
        //             "quantity" => "1",
        //             "status" => 1,
        //             "created_at" => "2024-02-25T23:29:17.000000Z",
        //             "updated_at" => "2024-02-25T23:29:17.000000Z",
        //             "slug" => "gbnf",
        //             "order_quantity" => 2,
        //             "detail" => array('phone' => 999999999, 'father_name' => 'ram', 'child_detail' => array('total_son' => 5, 'daughter' => 2)),
        //         ],

        //         2 => [
        //             "id" => 2,
        //             "category_id" => 1,
        //             "name" => "dsfgdgd",
        //             "amount" => 65.0,
        //             "image" => "1708903872.jpg",
        //             "description" => "fxdgdfgdfg",
        //             "quantity" => "1",
        //             "status" => 1,
        //             "created_at" => "2024-02-25T23:31:12.000000Z",
        //             "updated_at" => "2024-02-25T23:31:12.000000Z",
        //             "slug" => "dsfgdgd",
        //             "order_quantity" => 4,
        //         ],

        //     ];
        // // dd($test[2]);

        // $test[2]['detail'] = array('mother_name' => 'maa ko nam', 'father_name' => 'bapu ko name', 'child_detail' => array('total_son' => 5, 'daughter' => 2));
        // //  dd($test['detail']);
        // // dump($test[]['amount']);
        // $amount = 0;
        // foreach ($test as $key => $value) {

        //     $amount = $amount + $value['amount'];
        //     // dump($amount);
        //     // dump($value);  
        //     if (isset($value['detail'])) {
        //          dump($value['detail']['father_name']);
        //     //    dump($amount);
        //     }
        // }
        // // dump($value['detail']['mother_name']);
        // dd($amount);
        // $a = 10;
        // $b = 20;
        // // $a = $b;
        // $b = $b - $a;
        // $a = $b + $a;  

        // dd($a);
        // dd( "aq b xc d g rakesh lis googo dsfdslkfdshfsd = ====== $b, b = $a");
        // dd(Session::get('cart_data'));
        // Session::flush('cart_data');
        // $array=array('vusfy',2,'ugeaiud','uhvsdad',2,3,3,333,33);
         
        // dd(count($array));
        // $cars=array(
        //       "Volvo"=>array( "XC60","XC90"),"BMW"=>array("X3","X5"),"Toyota"=>array("Highlander")
        // );
        //  dd(count($cars));

         

        // $my_cart_data = Session::flashs('cart_data');
        // dd($my_cart_data);
        $products = Product::where('status',1)->get();
        $categorys = Category::get();
        // dd($product);
        // $categorys = Category::orderBy('name','asc')->Pluck('name','id')->toArray();   
        return view('frontend.index',compact('categorys','products'));
    }
    public function blog()
    {
        $products = Product::get();
        $categorys = Category::get();
        return view('frontend.blog',compact('categorys','products'));
    }
    public function shopGrid()
    {
        $products = Product::get();
        $categorys = Category::get();
        return view('frontend.shop_grid',compact('categorys','products'));
    }
    public function shopDetails()
    {
        $products = Product::get();
        $categorys = Category::get();
        return view('frontend.shop-details',compact('categorys','products'));
    }




    public function shopingCart($product_id)
    {
        // dd($product_id);
        
        $response = array('status'=>false,'message'=>'');
        $product = Product::find($product_id)->toArray();

        $cart_data = Session::get('cart_data');

        
        if(isset($cart_data[$product_id])){
            $cart_data[$product_id]['order_quantity']=$cart_data[$product_id]['order_quantity'] + 1;
        }else{
            $cart_data[$product_id]= $product;
            $cart_data[$product_id]['order_quantity'] = 1;
        }


        Session::put('cart_data',$cart_data);
        
        $response['status'] = true;
        $response['data'] = array('item_count'=>count(Session::get('cart_data')));
        return response()->json($response);
      
    }



   

    public function showCart(Request $request)
    {   

        $categorys = Category::get();

        $cart = session()->get('cart_data',);
        // $products = Product::get();
        // dd($carts);
        return view('frontend.shoping-cart', compact('cart','categorys'));
    }

    public function addToQuantity(Request $request)
    {
        

        $response = array('status'=>false,'message'=>'');
        $product = Product::find($request->id);
          
        $cart = session()->get('cart_data');

        if(isset($cart[$request->product_id])) {
            $cart[$request->product_id]['order_quantity'] = $request->product_quantity;
            $cart = session()->put('cart_data',$cart);
        }
          
        // session()->put('cart_data', $cart);
        $response['status'] = true;
        $response['data'] = [];
        return response()->json($response);
    }


    public function remove(Request $request)
    {
        $response = array('status'=>false,'message'=>'');
            $cart = session()->get('cart_data');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart_data', $cart);
                $response['status'] = true;
            }


        return response()->json($response);
        
    }



    public function checkout()
    {
        $products = Product::get();
        $categorys = Category::get();
        return view('frontend.checkout',compact('categorys','products'));
    }
    public function blogDetails()
    {
        $products = Product::get();
        $categorys = Category::get();
        return view('frontend.blog-details',compact('categorys','products'));
    }
    public function contact()
    {
        $products = Product::get();
        $categorys = Category::get();
        return view('frontend.contact',compact('categorys','products'));
    }

    public function categorysProduct($category_slug)
    {

        $categorys = Category::get();
        $category = Category::where('slug',$category_slug)->first();
       
        if(isset($category)){
        // dd($category->created_at);
            
            $products = Product::where('category_id',$category->id)->get();
            return view('frontend.categorys_product.category_product',compact('categorys','products'));
        }
        abort(404);
    }

    public function productDetail($product_slug)
    {
        $categorys = Category::get();
        $product = Product::where('slug',$product_slug)->first();
        if (isset($product)) {
            
        return view('frontend.categorys_product.product_details',compact('categorys','product'));
        }
        abort(404);

    }

    public function tast(){
        $students =array(
            ["name"=>'ram','class'=>3,'mask'=>50],
            ["name"=>'shyam','class'=>4,'mask'=>40],
            ["name"=>'sam','class'=>5,'mask'=>30],
            ["name"=>'vik','class'=>5,'mask'=>45],
            ["name"=>'gagan','class'=>4,'mask'=>35],
            ["name"=>'chagan','class'=>5,'mask'=>25],
        );
        $new_array =[];
        echo "<table border='2px'>";
        echo "<tr>
                <th>name</th>
                <th>class</th>
                <th>mask</th>
              </tr>";

        foreach($students as $key=>$row) {
            echo "<tr>";
            foreach($row as $key2=>$row2){
              echo "<td> $row2 </td>";
            }
            echo "</tr>";
        }
        echo "<table>";
        echo "<br>";
        // dd($new_array);
        // $mask=array(['mask'=>50]);
       
        echo "<table border='2px'>";
        echo "<tr>
                <th>name</th>
              </tr>";
        foreach($students as $key=>$student){
            echo "<tr>";
            if ($student['mask'] >= 40) {
             echo "<td>". $student['name']. "</td>";
            }
             
        }
        echo "<table>";
        echo "<br>";

        echo "<table border='2px'>";
        echo "<tr>
                <th>name</th>
              </tr>";
        foreach($students as $key=>$student){
            echo "<tr>";
            if ($student['mask'] <= 25) {
             echo "<td>". $student['name']. "</td>";
            }
             
        }
        echo "<table>";
        // dd($student);

        return view('frontend.tast');
    }











}
