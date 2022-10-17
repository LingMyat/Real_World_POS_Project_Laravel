<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // category list page
    public function list(){
        $data = Category::when(request('search'),function($dt){
            $dt->where('category_name','like','%'.request('search').'%');
        })->orderBy('id','desc')->paginate(5);
        $id = 1;
        return view('admin.category.list',['data'=>$data,"id"=>$id]);
    }
    // category create page
    public function createPage(){
        return view('admin.category.create');
    }
    // create category item using manual request class to get short code
    public function create(CategoryRequest $request){
        Category::create($request->validated());
        // use config to get clear flash session
        return to_route('category#list')->with('created',config('condition.category.created'));
    }
    // show (or) Read category
    public function show(){

    }
    // category edit
    public function edit(Category $id){
        return view('admin.category.edit',['data'=>$id]);
    }
    // update category
    public function update(Category $id,CategoryRequest $request){
        $id->update($request->validated());
        return to_route('category#list')->with('updated',config('condition.category.updated'));
    }
    // delete category
    public function delete(Category $id){
        $id->delete();
        return to_route('category#list')->with('created',config('condition.category.deleted'));;
    }
}
