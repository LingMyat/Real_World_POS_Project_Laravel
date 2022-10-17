<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountInfoUpdatedRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // change admin acc password page
    public function changePasswordPage(){
       return view('admin.adminAcc.changePassword');
    }

    // update password
    public function changePassword(ChangePasswordRequest $request,User $id){
        if (Hash::check($request->currentPassword,$id->password)) {
            $id->update(['password'=>Hash::make($request->newPassword)]);
            return to_route('category#list')->with('pswUpdated',config('condition.password.pswUpdated'));
        }else{
            return back()->with('notMatch',config('condition.password.notMatch'));
        }
    }

    // account Info Page
    public function accountInfoPage(){
        return view('admin.adminAcc.accountInfo');
    }

    // account Info Edit
    public function accountInfoEdit(User $id){
        return view('admin.adminAcc.accountInfoEdit',['data'=>$id]);
    }

    // account Info Updated
    public function accountInfoUpdated(User $id,AccountInfoUpdatedRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $imgName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imgName);
            $validated['image']=$imgName;
            if ($id->image !== NULL) {
                Storage::delete('public/'.$id->image);
            }
        }
        $id->update($validated);
        return to_route('category#list')->with('profileUpdated',config('condition.profile.profileUpdated'));
    }

    // admin list page
    public function adminList(){
        $data = User::when(request('search'),function($dt){
            $dt->orWhere('name','like','%'.request('search').'%')->where('role','admin')
               ->orWhere('email','like','%'.request('search').'%')->where('role','admin')
               ->orWhere('address','like','%'.request('search').'%')->where('role','admin');
        })
        ->where('role','admin')
        ->get();
        return view('admin.adminAcc.adminList',compact('data'));
    }

    // edit Acc Role
    public function editAccRole(User $id){
        return view('admin.adminAcc.roleEdit',['data'=>$id]);
    }

    // change admin to user with ajax
    public function adminToUser(Request $request){
        User::where('id',$request->id)->update(['role'=>$request->role]);
        return response()->json(['status'=>'success'],200);
    }

    // update
    public function updateAccRole(User $id,Request $request){
        $id->update(['role'=>$request->role]);
        return to_route('admin#list');
    }
    // delete acc
    public function deleteAcc(User $id){
        $id->delete();
        return to_route('admin#list')->with('accDelete',config('condition.account.accDelete'));
    }


}
