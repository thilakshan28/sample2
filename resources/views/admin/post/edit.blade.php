@extends('layouts.admin.master')
@section('title', 'edit')
@section('header')
<h4> Welcome {{Auth::user()->name}} </h4>
@endsection
@section('content')
@if (session('error'))
                <div>
                    {{ session('error') }}
                </div>
                @endif
{!! Form::open()->fill($post)->route('post.update',[$post->id])->method('patch') !!}

@include('admin.post._form')
<button value="submit">Update</button>
<a class="btn btn-dark btn-md" href="{{ route('post.index') }}"><i class="mdi mdi-cancel"></i>Cancel</a>

{!! Form::close() !!}
@endsection
