@extends('layouts.admin.master')
@section('title','User List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Users</h2>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <a href="{{ route('post.report',$user->id)}}" class="btn btn-info btn-icon-split"><span class="text">Report</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-2">
                <div class="float-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
