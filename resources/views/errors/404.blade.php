@extends('layouts.app')

@section('title')
    404 - {{ trans('errors.error') }}
@endsection

@section('content')
    <div class="content">
        <h1>404 - {{ trans('errors.error') }}</h1>
        <p>
            {{ trans('errors.404') }}
        </p>
        <div id="push"></div>
    </div>
@endsection