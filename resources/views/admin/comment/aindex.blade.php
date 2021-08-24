@extends('layouts.admin.master')
@section('title','User List')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    @if(Auth::user()->role->name == 'Publisher')
                    <a href="{{route('comment.uindex')}}" class="float-left btn btn-primary btn-circle"><i class="fas fa-arrow-left"></i></a>
                    <h2 class="float-left ml-2">{{ $name }}</h2>
                    @else
                    <h2 class="float-left ml-2">Comment</h2>
                    @endif
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
                        <th>Post Title</th>
                        <th>Post Content</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->postcomments as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->pivot->comment }}</td>
                            <td>
                            @if(Auth::user()->role->name == 'Writer')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-{{$post->id}}" data-whatever="@mdo">Edit</button>
                            <div class="modal fade" id="edit-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    {!! Form::open()->route('comment.update',[$post->id])->method('patch') !!}
                                    <div class="modal-body">
                                        <div class="form-group">
                                          {!! Form::text('q','Your Comment',request()->input('q'))->required()->value($post->pivot->comment) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button value="submit" class="btn btn-primary">Publish</button>
                                    </div>
                                    {!! Form::close() !!}
                                  </div>
                                </div>
                              </div>
                            @endif
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete-{{$post->id}}">Delete</button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this comment?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    {!! Form::open()->route('comment.destroy',[$post->id])->method('delete') !!}
                                    <div class="modal-body">
                                        Post Title:{{ $post->title }}</br>
                                        Post Content:{{ $post->content }}</br>
                                        Comment:{{ $post->pivot->comment }}</br>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
