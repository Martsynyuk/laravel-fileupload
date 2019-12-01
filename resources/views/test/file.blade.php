@extends('layouts.app')

@section('content')
    <div style="margin: 30px">
    {{ Form::open(array('url' => '/file-upload')) }}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{ Form::label('file', 'upload xlsx file here') }}
        {{ Form::file('file') }}
        {{ Form::submit('Save file') }}
    {{ Form::close() }}
    </div>
@endsection
