<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\AccountInfoUpdatedRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class UserController extends Controller
{
    // user home page
    public function home(){
        // $data = Product::whereBetween('price',[1,10])->get();
        // dd($data->toArray());
        $data = Product::when(request('search'),function($dt){
            $dt->where('name','like','%'.request('search').'%');
        })->orderBy('id','desc')->paginate(6);
        $category = Category::all();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $qty = 0;
        foreach ($cart as $item) {
            $qty+=$item->qty;
        }
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('data','category','qty','order'));
    }

    //user sorting not use ajax. ajax can't carry paginate
        public function sorting(){
            $data = Product::when(request('search'),function($dt){
                $dt->where('name','like','%'.request('search').'%');
            })->paginate(6);
            $category = Category::all();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $qty = 0;
            foreach ($cart as $item) {
                $qty+=$item->qty;
            }
            $order = Order::where('user_id',Auth::user()->id)->get();
            return view('user.main.home',compact('data','category','qty','order'));

        }

    // user filter page
    public function filter($catId){
        $data = Product::when(request('search'),function($dt){
            $dt->where('name','like','%'.request('search').'%');
        })->where('category_id',$catId)->orderBy('id','desc')->paginate(6);
        $category = Category::all();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $qty = 0;
        foreach ($cart as $item) {
            $qty+=$item->qty;
        }
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('data','category','qty','order'));
    }

    // product detail show
    public function productDetail(Product $id){
        $products = Product::orderBy('id','desc')->paginate(3);
        $relatedProducts = Product::where('category_id',$id->category_id)->get();
        $reviews = Review::select('reviews.*','users.image','users.name')
        ->join('users','users.id','reviews.user_id')
        ->where('product_id',$id->id)
        ->get();
        return view('user.main.detail',['products'=>$products,'data'=>$id,'relatedProducts'=>$relatedProducts,'reviews'=>$reviews]);
    }

    // review
    public function userReview(ReviewRequest $request){
        Review::create($request->validated());
        return back();
    }

    // cart Page
    public function cartPage(){
        $data = Cart::select('carts.*','products.name','products.image','products.price')
        ->join('products','carts.product_id','products.id')
        ->get();
        return view('user.cart.cart',compact('data'));
    }

    // order History
    public function orderHistory(){
        $data = Order::where('user_id',Auth::user()->id)->get();
        return view('user.cart.orderHistory',compact('data'));
    }

    // contact Page
    public function contactPage(){
        return view('user.contact.contact');
    }

    // send message to customer service
    public function message(SendMessageRequest $request){
        Contact::create($request->validated());
        return to_route('user#home')->with('messageSend',config('condition.contact.messageSend'));
    }

    // user change password page
    public function changePasswordPage(){
        return view('user.account.changePsw');
    }

    // user password update
    public function changePassword(User $id,ChangePasswordRequest $request){
        if(Hash::check($request->currentPassword, $id->password)){
            $id->update(['password'=>Hash::make($request->newPassword)]);
            return to_route('user#home')->with('pswUpdated',config('condition.password.pswUpdated'));
        }else{
            return back()->with('notMatch',config('condition.password.notMatch'));
        };
    }

    // user account info page
    public function accountInfoPage(){
        $products = Product::orderBy('id','desc')->paginate(3);
        return view('user.account.accInfo',compact('products'));
    }

    // user account Info Edit
    public function accountInfoEdit(User $id){
        $products = Product::orderBy('id','desc')->paginate(3);
        return view('user.account2.accInfoEdit',['products'=>$products,'data'=>$id]);
    }

    // user account Info Update
    public function accountInfoUpdate(User $id,AccountInfoUpdatedRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $imgName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imgName);
            $validated['image'] = $imgName;
            if ($id->image !== NULL) {
                Storage::delete('public/'.$id->image);
            }
        }
        $id->update($validated);
        return to_route('user#home')->with('profileUpdated',config('condition.profile.profileUpdated'));
    }
}
