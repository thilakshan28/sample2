@extends('layouts.admin.master')
@section('title', 'show')
@section('header')
<h4> Welcome {{Auth::user()->name}} </h4>
@endsection
@section('content')

@endsection
