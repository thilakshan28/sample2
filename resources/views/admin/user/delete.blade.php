@extends('layouts.admin.master')
@section('title', 'UserList')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class = "float-left">
                <h4> Are sure you want to delete this User?</h4>
                </div>
            </div>
            <div class="card-body">
                {!! Form::open()->route('user.destroy',[$user->id])->method('delete') !!}
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Created Posts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->posts as $post)
                    <tr><td>Title :{{ $post->title }}</td></tr>
                    <tr><td>Content :{{ $post->content }}</td></tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-danger btn-md float-right"><i class="mdi mdi-delete"></i> Delete </button>
<a href="{{ route('user.index')}}" class="btn btn-info btn-icon-split"><span class="text">Cancel</span></a>

{!! Form::close() !!}
        </div>
    </div>
</div>
</div>
@endsection

