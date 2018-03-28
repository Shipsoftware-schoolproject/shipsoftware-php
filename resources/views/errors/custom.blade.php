@extends('layouts.app')

@section('title', 'Error')

@section('content')
    <h1>{{ $title }}</h1>
    <p>
        {{ $message }}
    </p>
@endsection