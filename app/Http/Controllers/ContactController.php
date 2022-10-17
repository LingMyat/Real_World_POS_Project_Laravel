<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // contact list page
    public function contactList(){
        $data = Contact::select('contacts.*','users.image')
                ->join('users','users.name','contacts.name')
                ->paginate(6);
        return view('admin.contact.list',compact('data'));
    }

    // contact delete
    public function delete(Contact $id){
        $id->delete();
        return to_route('admin#contactList');
    }
}
