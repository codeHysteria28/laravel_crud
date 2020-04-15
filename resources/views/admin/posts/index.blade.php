@extends('layouts.admin');

@section('content')
    <h1>All Posts</h1>
    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Photo</th>
                <th>Body</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
                @if ($posts)
                    @foreach ($posts as $post)
                    <tr>
                        <td scope="row">{{$post->id}}</td>
                        <td>{{$post->user->name}}</td>
                        <td><a href="{{ route('posts.edit', $post->id) }}">{{$post->title}}</a></td>
                        <td>{{$post->category_id ? $post->category_id : 'no category' }}</td>
                        <td><img height="50" src="{{$post->photo ? $post->photo->file : 'no photo'}}" alt=""></td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
    </table>
@endsection