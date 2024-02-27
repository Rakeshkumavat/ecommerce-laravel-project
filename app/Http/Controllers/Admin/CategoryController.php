<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Category;
use Illuminate\Support\Str;
// use DataTables;

class CategoryController extends Controller
{

  public function showForm(){
    $category = new Category;
    return view('admin.category.category',compact('category'));
  }

  public function categoryAdd(Request $request){
    // dd($request->all());
    $response = array('status'=>false,'message'=>'');
    
    $request->validate([
        'name'=>'required|unique:categories',
        'image'=>'required|mimes:jpeg,jpg,png,gif|max:1000',
    ]);

    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('assets/images'),$imageName);

    $category = new Category();
    // dd($category);
    $category->image = $imageName; 
    $category->name = $request->name;
    $category->slug = Str::slug($request->name,'-');
    $category->save();
    $response['status'] = true;
    return response()->json($response);

  }

  public function categoryList(UsersDataTable $datatable)
  {
       return $datatable->render('admin.category.category_list');
  }


  public function categoryEdit($id){
    $category = Category::find($id);
    return view('admin.category.category_edit',compact('category'));

  }

  public function categoryUpdate(Request $request){
    $response = array('status'=>false,'message'=>'');
    $request->validate([
      'name'=>'required|unique:categories,name,'.$request->id,
      'image'=>'nullable|mimes:jpeg,jpg,png,gif|max:1000',
    ]);

    $category = Category::find($request->id);

    if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images'),$imageName);
            $category->image = $imageName;
            }

    $category->name = $request->name;
    $category->slug = Str::slug($request->name, '-');
    $category->save();
    $response['status'] = true;
    return response()->json($response);
  }

  public function categoryDelete($id){
    $response = array('status'=>false);
        if ($id) {
            $category = Category::find($id);
            $category->delete();
            $response['status'] = true;
        }
        return response()->json($response);
  }


  public function activeInActive($id){
    $response = array('status'=>false,'message'=>'sdfsdfdsf');
    $category = Category::find($id);

    if ($category){
        $category->status = $category->status == 1 ? 0 : 1;
        $category->save();
        // dd($category->save());
        $response['status'] = true;
        $response['message'] = 'jjjjjjjjjjjjjjjjjjj';
    }
    return response()->json($response);

}
}
