@extends('layouts.admin.master')
@section('title', 'delete')
@section('header')
<h4> Welcome {{Auth::user()->name}} </h4>
@endsection
@section('content')
{!! Form::open()->route('post.destroy',[$post->id])->method('delete') !!}

                <div>
                    <h4> Are sure you want to delete this post?</h4>
                </div>
<button class="btn btn-danger btn-md float-right"><i class="mdi mdi-delete"></i> Delete </button>
<a href="{{ route('post.index')}}" class="btn btn-info btn-icon-split"><span class="text">Cancel</span></a>

{!! Form::close() !!}
@endsection
