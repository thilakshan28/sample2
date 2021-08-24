@extends('layouts.admin.master')
@section('title','User List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if(Auth::user()->role->name == 'Admin' && $user->id != Auth::user()->id )
                <div class="float-left">
                    <h2>Edit User</h2>
                </div>
                @else
                <div class="float-left">
                    <h2>Edit Profile</h2>
                </div>
                @endif
            </div>
            <div class="card-body">
                @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
                @endif
                {!! Form::open()->fill($user)->route('user.update',[$user->id])->method('patch') !!}
                @include('admin.user._form')
                <div class="row">
                    <div class="col-12">
                        <div class="float-right">
                        <button class="btn btn-success btn-md"><i class="mdi mdi-floppy"></i>Update</button>
                        <a class="btn btn-dark btn-md" href="{{ route('dashboard') }}"><i class="mdi mdi-cancel"></i>Cancel</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
