@extends('layouts.admin.master')
@section('title','User List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div >
                    @if(Auth::user()->role->name == 'Admin' && $user->id != Auth::user()->id )
                    <a href="{{route('user.index')}}" class="float-left btn btn-primary btn-circle"><i class="fas fa-arrow-left"></i></a>
                    <h2 class="float-left ml-2">User Details</h2>
                    @else
                    <h2 class="float-left ml-2">Your Profile</h2>
                    @endif
                </div>
                @if(Auth::user()->role->name != 'Admin')
                <div class="float-right">
                    <a href="{{ route('user.edit',$user->id)}}" class="btn btn-info btn-icon-split"><span class="text">Edit Profile</span></a>
                </div>
                @endif
            </div>
            <div class="card-body">

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>{{$user->name}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Department :{{ $user->department }}</td></tr>
                    <tr><td>Email :{{ $user->email }}</td></tr>
                    <tr><td>Role :{{ $user->role->name }}</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
