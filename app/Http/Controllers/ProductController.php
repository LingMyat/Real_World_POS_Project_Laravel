<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PizzaRequest;
use Illuminate\Support\Facades\Storage;




class ProductController extends Controller
{
    // category list page using db Join
    public function list(){
        $data = Product::select('products.*','categories.category_name')
        ->when(request('search'),function($dt){
            $dt->where('products.name','like','%'.request('search').'%');
        })
        ->join('categories','products.category_id','categories.id')
        ->orderBy('products.id','desc')->paginate(4);
        return view('admin.products.list',['data'=>$data]);
    }
    // category create page
    public function createPage(){
        $category = Category::all();
        return view('admin.products.create',compact('category'));
    }

    // create category item using manual request class to get short code
    public function create(PizzaRequest $request){
        $validated = $request->validated();
        if($request->hasFile('image')){
            $imgName =uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imgName);
            $validated['image']=$imgName;
            Product::create($validated);
            return to_route('product#list')->with('productCreated',config('condition.product.created'));
        } else {
            return to_route('product#createPage')->with('imgUnmatch',config('condition.product.imgUnmatch'));
        }

    }

    // (show product) in this method I use Eloquent: Relationships to show category data
    public function show(Product $id){
        return view('admin.products.show',['data'=>$id]);
    }

    // product edit
    public function edit(Product $id){
        $category = Category::all();
        return view('admin.products.edit',['data'=> $id,'category'=>$category]);
    }

    // product update
    public function update(Product $id,PizzaRequest $request){
        $validated = $request->validated();

        if($request->hasFile('image')){
            $imgName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imgName);
            Storage::delete('public/'.$id->image);
            $validated['image']=$imgName;
        } else {
            $validated['image']=$id->image;
        }
        $id->update($validated);
        return to_route('product#list')->with('productUpdated',config('condition.product.updated'));
    }

    // delete product
    public function delete(Product $id){
        $id->delete();
        return to_route('product#list')->with('productDeleted',config('condition.product.deleted'));
    }

}
