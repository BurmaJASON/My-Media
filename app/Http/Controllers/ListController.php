<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ListController extends Controller
{
    //direct admin list
    public function index () {
        $users = User::select('id','name','email','phone','address','gender')->get();

        return view('admin.list.index',compact('users'));
    }

    //delete admin accoutn
    public function deleteAccount($id) {
        User::find($id)->delete();
        return back()->with('deleteSuccess','Admin Account Deleted!');
    }

    //admin list search
    public function adminListSearch(Request $request) {
        $users = User::orWhere('name','like','%'.$request->adminSearchKey.'%')
                    ->orWhere('email','like','%'.$request->adminSearchKey.'%')
                    ->orWhere('phone','like','%'.$request->adminSearchKey.'%')
                    ->orWhere('gender','like','%'.$request->adminSearchKey.'%')
                    ->orWhere('address','like','%'.$request->adminSearchKey.'%')
                    ->get();
        // dd($userData->toArray());
        return view('admin.list.index',compact('users'));
    }
}
