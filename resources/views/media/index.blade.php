@extends('layouts.admin')

@section('content')
    <h1>Media</h1>

    @if ($photos)
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Created At</th>
                    <th>Delete Image</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($photos as $photo)
                        <tr>
                            <td scope="row">{{ $photo->id }}</td>
                            <td><img width="50" src="{{ $photo->file ? $photo->file : 'no photo' }}" alt=""></td>
                            <td scope="row">{{ $photo->file ? $photo->file : 'no path' }}</td>
                            <td>{{ $photo->created_at ? $photo->created_at : 'no date' }}</td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id]])!!}
                                    <div class="form-group">
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    @endif
@endsection