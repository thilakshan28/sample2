<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUpdateRequest;
use App\Models\District;
use App\Models\Post;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
  public function index(){

      $posts = Post::all();
      return view('admin.post.index',compact('posts'));
  }

  public function create(){
    //$provinces = Province::all();
    return view('admin.post.create');
    }

    public function dropdown(Request $request){
        $districts = District::where("province_id",$request->province)->get();
        return response()->json($districts);
    }

    public function store(PostStoreRequest $request){

        $data = $request->validated();
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $user=Auth::user()->id;

        if($request->has('file')){
            $path=$request->file('file')->store('notes','public');

        }
         $post=Post::create([
            'user_id' => $user ,
            'title' => $data['title'],
            'content' => $data['content'],
            'filename' => $path,
            'actual_filename' => $name,
        ]);

        return redirect()->route('post.index')->with('success', 'Post has been created successfuly!');
    }

    public function show(Post $post){

        $pathToFile = storage_path('app/notes/' . $post->filename);
        //return response()->download($pathToFile,$post->actual_filename);
        return response()->file($pathToFile,['Content-Type', 'application/pptx']);
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
