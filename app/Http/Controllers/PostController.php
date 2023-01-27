<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct admin posts
    public function index(Request $request) {
        $categories = Category::get();
        // $posts = Post::paginate(3);

        $posts = Post::select('posts.*','categories.title as category_title')
                      ->when(request('postSearch'),function($query){
                        $query->where('posts.title','like','%'.request('postSearch').'%');

                      })
                      ->leftJoin('categories','posts.category_id','categories.category_id')
                      ->paginate(4);

        $posts->append($request->all());
        return view('admin.post.index',compact('categories','posts'));
    }

    //create post
    public function createPost(Request $request) {

        $this->checkPostValidation($request);

        if(!empty($request->postImage)) {

            $imgFile = $request->file('postImage');
            $imgName = uniqid().'_'.$imgFile->getClientOriginalName();

            $imgFile->move(storage_path('app/public/postImage'),$imgName);

            $postData = $this->getPostData($request,$imgName);
        }else {
            $postData = $this->getPostData($request,null);
        }


        Post::create($postData);
        return back();

    }

    //delete post
    public function deletePost($id) {
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData->image;

        Post::where('post_id', $id)->delete();

        if(File::exists(storage_path('app/public/postImage/').$dbImageName)){
            File::delete(storage_path('app/public/postImage/').$dbImageName);
        }

        return back();
    }

    //direct edit post page
    public function postEditPage($id){
        $post = Post::where('post_id',$id)->first();
        $posts = Post::get();
        $categories = Category::get();
        return view('admin.post.edit',compact('post','categories','posts'));
    }

    //update post
    public function postUpdate($id, Request $request) {
        $this->checkPostValidation($request);
        $data = $this->updatePostData($request);

        if(isset($request->postImage)) {
            $this->storeNewUpdateImage($request,$id);
        }else {
            Post::where('post_id', $id)->update($data);
        }

        return back();

    }

    //updated post with new image
    private function storeNewUpdateImage($request, $id) {
        //get image from client
        $imgFile = $request->file('postImage');
        $imgName = uniqid().'_'.$imgFile->getClientOriginalName();

        //get image from db
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData->image;

        //delete image from storage
        if(File::exists(storage_path('app/public/postImage/').$dbImageName)){
            File::delete(storage_path('app/public/postImage/').$dbImageName);
        }

        //store new image in storage
        $imgFile->move(storage_path('app/public/postImage'),$imgName);

        //update data with new image
        $data['image'] = $imgName;
        Post::where('post_id', $id)->update($data);
    }

    //request update post data
    private function updatePostData($request) {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now(),
        ];
    }
    //post validation check
    private function checkPostValidation($request) {
        return Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required',
            'postImage' => 'mimes:png,jpg,jpeg,gif,webp|file',
        ],[
            'postImage.mimes' => 'The post image must a file of image type.'
        ])->validate();
    }

    //get post data
    private function getPostData($request,$imgFile){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $imgFile,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
