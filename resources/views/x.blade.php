@extends('layouts.master')

@section('title')
    x
endsection

@section('content')
    this is the content.
    <p>
        {{ Auth::user()->likes()->get()->count() }}
    </p>
@endsection