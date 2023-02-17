<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    //direct trend post page
    public function index(Request $request) {
        $posts = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
                         ->leftJoin('posts','posts.post_id','action_logs.post_id')
                         ->groupBy('action_logs.post_id')
                         ->orderBy('post_count','desc')
                         ->get();

        // dd($posts->toArray());
        return view('admin.trend_posts.index',compact('posts'));
    }

    //direct trend post detail
    public function trendPostDetails($id) {
        $post = Post::where('post_id',$id)->first();
        return view('admin.trend_posts.details',compact('post'));
    }
}
