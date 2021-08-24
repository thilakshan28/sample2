@extends('layouts.admin.master')
@section('title', 'show')
@section('header')
<h4> Welcome {{Auth::user()->name}} </h4>
@endsection
@section('content')
<h4>Title :</h4>{{ $post->title}}
</br>
<h4>Content :</h4> {{ $post->content}}
@endsection
