<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    public function getAllPost(){
        $posts = Post::select('posts.*','categories.title as category_title')
                    ->leftJoin('categories','posts.category_id','categories.category_id')
                    ->get();

        return response()->json([
            'posts' => $posts,
            'status' => 'good success'
        ]);
    }


    //post serch
    public function postSearch(Request $request) {
        $searchPosts = Post::select('posts.*','categories.title as category_title')
                            ->join('categories', 'categories.category_id', 'posts.category_id')
                            ->where('posts.title', 'like' , '%' .$request->key. '%')->get();

        return response()->json([
            'searchKey' => $request->all(),
            'searchPosts' => $searchPosts
        ]);
    }

    //post detail
    public function postDetail(Request $request) {
        $id = $request->postId;
        $post = Post::where('post_id',$id)->first();

        return response()->json([
            'post' => $post
        ]);
    }
}
