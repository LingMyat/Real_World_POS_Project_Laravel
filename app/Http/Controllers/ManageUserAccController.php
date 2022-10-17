<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManageUserAccController extends Controller
{
    // user list
    public function userList(){
        $data = User::when(request('search'),function($dt){
            $dt->orWhere('name','like','%'.request('search').'%')->where('role','user');
        })
        ->where('role','user')
        ->paginate(5);
        return view('admin.user.list',compact('data'));
    }

    // user info edit
    public function userEdit(User $id){
        return view('admin.user.userEdit',['data'=>$id]);
    }

}
