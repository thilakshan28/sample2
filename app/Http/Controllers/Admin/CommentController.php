<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class CommentController extends Controller
{
    public function uindex(){
        $users = User::with('role')->orderBy('id','desc')->paginate('12');
        return view('admin.comment.uindex',compact('users'));
    }

    public function aindex(User $user = null){
        if(!empty($user)){
            $name = $user->name;
            return view('admin.comment.aindex',compact('user','name'));
        }
            $user = User::find(Auth::user()->id);
            return view('admin.comment.aindex',compact('user'));
    }

    public function store(Post $post){
        $q = request()->input('q');
        $user_id = Auth::user()->id;
            $post->usercomments()->attach([$post->id=>['user_id'=>$user_id,'comment'=>$q]]);
            return redirect()->back()->with('success','You comment is Published');
    }

    public function update(Post $post){
        $q = request()->input('q');
        $user_id = Auth::user()->id;
            $post->usercomments()->sync([$post->id=>['user_id'=>$user_id,'comment'=>$q]]);
            return redirect()->back()->with('success','You comment is Published');
    }

    public function destroy(Post $post){
        $user_id = Auth::user()->id;
        $post->usercomments()->detach([$post->id,$user_id]);
        return redirect()->back()->with('success','You comment is Deleted');
    }
}
