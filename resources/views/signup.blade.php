@extends('layouts.master')
    @include('partials.navbar') 
@section('title') first
@endsection
 
@section('content')

<div class="ui hidden divider"></div>

<div class="ui centered doubling stackable grid container">

    @if ($errors->any())
    <div class="ui error message">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</div>

<div class="ui hidden divider"></div>

<form method="POST" action="{{ route('create') }}">
    <input type="hidden" name="_token" value="{{ Session::token()}}"> {{--CSRF protection--}}
    <div class="ui centered doubling stackable grid container">
        <div class="row">
            <div class="six wide column">
                <div class="ui form {{ $errors->has('username') ? 'error' : '' }}">
                    <div class="field {{ $errors->has('username') ? 'error' : ''}}">
                        <label class="_form-label">Username</label>
                        <div class="ui left icon input">
                            <input type="text" name="username" placeholder="Username" value="{{ Request::old('username')}}">
                            <i class="user icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="six wide column">
                <div class="ui form {{ $errors->has('email') ? 'error' : ''}}">
                    <div class="field {{ $errors->has('email') ? 'error' : ''}}">
                        <label class="_form-label">Email</label>
                        <div class="ui left icon input">
                            <input type="email" name="email" placeholder="email" value="{{ Request::old('email')}}">
                            <i class="envelope icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="six wide column">
                <div class="ui form {{ $errors->has('password') ? 'error' : ''}}">
                    <div class="field {{ $errors->has('password') ? 'error' : ''}}">
                        <label class="_form-label">Password</label>
                        <div class="ui left icon input">
                            <input type="password" name="password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row centered">
            <input class="ui submit blue button" value="Sign Up" type="submit" style="font-family:'nunito'">
        </div>

    </div>

</form>
@endsection