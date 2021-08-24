@extends('layouts.admin.master')
@section('title', 'create')
@section('header')
<h4> Welcome {{Auth::user()->name}} </h4>
@endsection
@section('content')
{!! Form::open()->route('post.store')->method('post') !!}

@include('admin.post._form')
<button value="submit">Create</button>
<a class="btn btn-dark btn-md" href="{{ route('post.index') }}"><i class="mdi mdi-cancel"></i>Cancel</a>

{!! Form::close() !!}
<!---<form method="post" action="{{ route('post.store') }}">
    @csrf
</form>--->
@endsection
