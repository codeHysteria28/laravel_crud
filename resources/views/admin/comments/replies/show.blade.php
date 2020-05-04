@extends('layouts.admin')

@section('content')

    @if(count($replies) > 0)
    <h1>Replies</h1>
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
                @foreach ($replies as $reply)
                    <tr>
                        <td scope="row">{{ $reply->id }}</td>
                        <td>{{ $reply->author }}</td>
                        <td>{{ $reply->email }}</td>
                        <td><a href="{{ route('home.post', $reply->comment->post->id) }}">View post</a></td>
                        <td>{{ $reply->body }}</td>
                        <td>{{ $reply->created_at->diffForHumans() }}</td>
                        <td>{{ $reply->updated_at->diffForHumans() }}</td>
                        <td>
                            @if ($reply->is_active == 1)
                                {!! Form::open(['method' => 'PATCH', 'action' => ['CommentsRepliesController@update', $reply->id]]) !!}

                                    <input type="hidden" name="is_active" value="0">
                        
                                    <div class="form-group">
                                        {!! Form::submit('Un-approve', ['class' => 'btn btn-warning']) !!}
                                    </div>
                        
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['method' => 'PATCH', 'action' => ['CommentsRepliesController@update', $reply->id]]) !!}

                                <input type="hidden" name="is_active" value="1">
                    
                                <div class="form-group">
                                    {!! Form::submit('Approve', ['class' => 'btn btn-success']) !!}
                                </div>
                    
                                {!! Form::close() !!}
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['CommentsRepliesController@destroy', $reply->id]]) !!}
                    
                                <div class="form-group">
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                </div>
                    
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table> 
    @else
        <p class="text-center text-danger">No replies to show</p>
    @endif
@endsection