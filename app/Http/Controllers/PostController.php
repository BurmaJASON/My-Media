<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //direct admin posts
    public function index() {
        return view('admin.post.index');
    }
}
