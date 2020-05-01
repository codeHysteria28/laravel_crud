@extends('layouts.admin')

@section('content')

@if ($comment)
    <h1>Comments</h1>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Post</th>
                <th>Body</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Approve/Un-approve</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                    <tr>
                        <td scope="row">{{ $comment->id }}</td>
                        <td>{{ $comment->author }}</td>
                        <td>{{ $comment->email }}</td>
                        <td><a href="{{ route('home.post', $comment->post->id) }}">View post</a></td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                        <td>{{ $comment->updated_at->diffForHumans() }}</td>
                        <td>
                            @if ($comment->is_active == 1)
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}

                                    <input type="hidden" name="is_active" value="0">
                        
                                    <div class="form-group">
                                        {!! Form::submit('Un-approve', ['class' => 'btn btn-warning']) !!}
                                    </div>
                        
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}

                                <input type="hidden" name="is_active" value="1">
                    
                                <div class="form-group">
                                    {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                                </div>
                    
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}
                    
                                <div class="form-group">
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                </div>
                    
                            {!! Form::close() !!}
                        </td>
                    </tr>
            </tbody>
    </table> 
@else
    <p class="text-center text-danger">No comments to show</p>
@endif
    
@endsection