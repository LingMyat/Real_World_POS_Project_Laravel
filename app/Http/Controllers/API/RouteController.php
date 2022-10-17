<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Contact;
use App\Models\OrderList;

class RouteController extends Controller
{
    //
    public function dataList(){
        $products = Product::all();
        $categorys = Category::all();
        $users = User::all();
        $carts = Cart::all();
        $order_lists = OrderList::all();
        $orders = Order::all();
        $contacts = Contact::all();
        $dataList = [
            'products' => $products,
            'categorys' => $categorys,
            'users' => $users,
            'carts' => $carts,
            'order_lists' => $order_lists,
            'orders' => $orders,
            'contacts' => $contacts,
        ];
        return response()->json($dataList,200);
    }
    // Route Model Binding get short code
    public function productListId(Product $id){
        return response()->json($id,200);
    }

    public function categoryCreate(CategoryRequest $request){
        Category::create($request->validated());
        return response()->json($request->validated(),200);
    }

    public function categoryDelete(Category $id){
        $id->delete();
        return response()->json(['message'=>'delete was successful'],200);
    }

    public function CategoryUpdate(Request $request){
        $data = Category::where('id',$request->id)->first();
        if (!empty($data)) {
            $data->update([
                'category_name'=>$request->category_name,
            ]);
            return response()->json(['message'=>'Category update success'],200);
        }
        return response()->json(['message'=>'There is no data with this category_id'],500);
    }
}
