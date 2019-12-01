@extends('layouts.app')

@section('content')
    <div style="margin: 30px">
    {{ Form::open(array('url' => '/file-upload')) }}

        @if (!empty($errors))
            @foreach($errors as $error)
                <p> {{ $error }} </p>
            @endforeach
        @endif

        {{ Form::label('file', 'upload xlsx file here') }}
        {{ Form::file('file') }}
        {{ Form::submit('Save file') }}
    {{ Form::close() }}
    </div>
@endsection
