<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUpdateRequest;
use App\Models\District;
use App\Models\Post;
use App\Models\Province;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
  public function index(){

      $posts = Post::with('user','usercomments')->orderBy('id', 'desc')->paginate(12);
      return view('admin.post.index',compact('posts'));
  }

  public function create(){
    $provinces = Province::all();
    return view('admin.post.create',compact('provinces'));
    }

    public function dropdown(Request $request){
        $districts = District::where("province_id",$request->province)->get();
        return response()->json($districts);
    }

    public function store(PostStoreRequest $request){
        $data = $request->validated();
        $user=Auth::user()->id;
        Post::create([
            'user_id' => $user ,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        return redirect()->route('post.index')->with('success', 'Post has been created successfuly!');
    }

    public function show(Post $post){
        return view('admin.post.show',compact('post'));
    }

    public function edit(Post $post){
        return view('admin.post.edit',compact('post'));
    }

    public function update(Post $post,PostUpdateRequest $request){
        $data = $request->validated();
        $post->update($data);
            return redirect()->route('post.index')->with('success', 'Post  details has been updated successfuly!');
    }

    public function delete(Post $post){
        return view('admin.post.delete',compact('post'));
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post details has been deleted successfuly!');
    }

}
