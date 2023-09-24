<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){

        $posts = Blog::with('user','usercomments')->orderBy('id', 'desc')->paginate(12);
        return view('admin.post.index',compact('posts'));
    }
}
