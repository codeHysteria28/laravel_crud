@extends('layouts.admin');

@section('content')

    <div class="row">
        <h1>Edit Post</h1>

        {!! Form::model($post, ['method' => 'PATCH', ['action' => 'AdminPostsController@update', $post->id], 'files' => true])!!}

            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                {{@csrf_field()}}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', array('' => 'options'), null, ['class' => 'form-control']) !!}
                {{@csrf_field()}}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:') !!}
                {!! Form::file('photo_id', ['class' => 'form-control']) !!}
                {{@csrf_field()}}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Description:') !!}
                {!! Form::textarea('body', ['class' => 'form-control', 'rows' => 5]) !!}
                {{@csrf_field()}}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Post', ['class' => 'btn btn-primary col-sm-6']) !!}
            </div>

        {!! Form::close() !!}
        
        {!! Form::model($post, ['method' => 'DELETE', ['action' => 'AdminPostsController@destroy', $post->id]])!!}
            
            <div class="form-group">
                {!! Form::submit('Delete Post', ['class' => 'btn btn-danger col-sm-6']) !!}
            </div>
            
        {!! Form::close() !!}



    </div>

    @include('includes.form_error')

@endsection