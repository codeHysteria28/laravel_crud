@extends('layouts.blog-post')
@section('styles')
    <style>
        #nested-comment {
            margin-top: 60px;
        }
        .comment-reply {
            display: none;
        }

        .toggle-reply {
            margin-bottom: 20px;
        }
    </style>
@endsection
@section('content')
                   <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $post->title }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{ $post->user->name }}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>

                <hr>

                <!-- Preview Image -->
            <img class="img-responsive" src="{{ $post->photo->file }}" alt="">

                <hr>

                <!-- Post Content -->
                <p>{{ $post->body }}</p>

                <hr>

                @if (Session::has('comment_message'))
                    <p class="text-success">{{ session('comment_message') }}</p>
                @endif

                <!-- Blog Comments -->

                @if (Auth::check())
                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}

                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <div class="form-group">
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter your comment here']) !!}
                                {{@csrf_field()}}
                            </div>
                    
                    
                            <div class="form-group">
                                {!! Form::submit('Submit comment', ['class' => 'btn btn-primary']) !!}
                            </div>
                    
                    
                        {!! Form::close() !!}
                    </div>
                @endif

                <hr>

                <!-- Posted Comments -->
                @if (count($comments) > 0)
                    @foreach ($comments as $comment)
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img height="64" class="media-object" src="{{ $comment->photo }}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $comment->author }}
                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                </h4>
                                <p>{{ $comment->body }}</p>

                                @if (count($comment->replies) > 0)
                                    @foreach ($comment->replies as $reply)
                                        <!-- Nested Comment -->
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img height="64" class="media-object" src="{{ $reply->photo }}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{ $reply->author }}
                                                    <small>{{ $reply->created_at->diffForHumans() }}</small>
                                                </h4>
                                                <p>{{ $reply->body }}</p>
                                            </div><br>

                                            <div class="comment-reply-container">
                                                <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                                <div class="comment-reply">
                                                    {{-- reply form --}}
                                                    {!! Form::open(['method' => 'POST', 'action' => 'CommentsRepliesController@createReply']) !!}
                                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                        <div class="form-group">
                                                            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => 'Enter your reply here']) !!}
                                                            {{@csrf_field()}}
                                                        </div>
                                                
                                                
                                                        <div class="form-group">
                                                            {!! Form::submit('Reply', ['class' => 'btn btn-primary']) !!}
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        <!-- End Nested Comment -->
                                    </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    @endforeach
                @endif
@endsection

@section('scripts')
    <script>
        $('.comment-reply-container .toggle-reply').click(function(){
            $(this).next().slideToggle('slow');
        });
    </script>
@endsection