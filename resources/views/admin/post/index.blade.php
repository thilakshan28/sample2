@extends('layouts.admin.master')
@section('title', 'index')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h2>Posts</h2>
                </div>
                <div class ="float-right">
                    <a href="{{ route('post.create')}}" class="btn btn-info btn-icon-split"><span class="text">Create</span></a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>CREATED BY</th>
                        <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->email}}</td>
                            <td>
                                <a href="{{ route('post.show',$post->id)}}" class="btn btn-info btn-icon-split"><span class="text">Show</span></a>
                                @if($post->usercomments->isEmpty())
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example-{{$post->id}}" >Comments</button>
                                <div class="modal fade" id="example-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        {!! Form::open()->route('comment.store',[$post->id])->method('post') !!}
                                        <div class="modal-body">
                                            <div class="form-group">
                                              {!! Form::text('q','Your Comment',request()->input('q'))->required() !!}
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
                                @else
                                 @foreach($post->usercomments as $post1)
                                @if($post1->pivot->user_id == Auth::user()->id)
                                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example-{{$post->id}}" disabled>Comments</button>
                                 <div class="modal fade" id="example-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        {!! Form::open()->route('comment.store',[$post->id])->method('post') !!}
                                        <div class="modal-body">
                                            <div class="form-group">
                                              {!! Form::text('q','Your Comment',request()->input('q'))->required() !!}
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
                                  @else
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example-{{$post->id}}" >Comments</button>

                                  <div class="modal fade" id="example-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                         <div class="modal-header">
                                           <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                           </button>
                                         </div>
                                         {!! Form::open()->route('comment.store',[$post->id])->method('post') !!}
                                         <div class="modal-body">
                                             <div class="form-group">
                                               {!! Form::text('q','Your Comment',request()->input('q'))->required() !!}
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
                                 @endforeach
                                 @endif

                                <a href="{{ route('post.edit',$post->id)}}" class="btn btn-info btn-icon-split"><span class="text">Edit</span></a>
                                <a href="{{ route('post.delete',$post->id)}}" class="btn btn-info btn-icon-split"><span class="text">Delete</span></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                <div class="pt-2">
                    <div class="float-right">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

