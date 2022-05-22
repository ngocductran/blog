<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\EditRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function listCategory(){
        $category = Category::all();
        return view('admin.layout.categories.list', ['category' => $category]);
    }

    public function getCreateCategory(){
        return view('admin.layout.categories.create');
    }

    public function postCreateCategory(CreateRequest $request){

    	$category = new Category();
    	$category->category = $request->input('category');
    	$category->slug = $request->input('slug');
        $category->status = $request->input('status');
        $category->user_id = Auth::user()->id;
    	$category->save();

        return redirect()->route('admin.list.category')->with('success', 'Thêm chuyên mục thành công.');
    }

    public function getEditCategory($id){
        $category = Category::find($id);
        return view('admin.layout.categories.edit', ['category' => $category]);
    }

    public function postEditCategory(EditRequest $request , $id){

        $category = Category::find($id);
    	$category->category = $request->input('category');
    	$category->slug = $request->input('slug');
        $category->status = $request->input('status');
        $category->update();

        return redirect()->route('admin.list.category')->with('success', 'Chỉnh sửa chuyên mục thành công.');
    }

    public function getDeleteCategory($id){
        $cate = Category::find($id);
        if($cate){
            $cate->delete();
            return redirect()->route('admin.list.category')->with('warning', 'Xóa chuyên mục thành công.');
        }
        else{
            return redirect()->route('admin.list.category')->with('warning', 'Không tìm thấy chuyên mục cần xóa.');
        }
    }
}
