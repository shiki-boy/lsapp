@extends('layouts.master')

@include('partials.navbar')

@section('title')
first
@endsection

@section('content')


<div class="ui hidden divider"></div>
<form action="{{ route('login') }}" method="POST">
    <input type="hidden" name="_token" value="{{ Session::token()}}"> {{--CSRF protection--}}
    <div class="ui placeholder segment container">
        <div class="ui two column very relaxed stackable grid container">
            <div class="column">
                <div class="ui form">
                    <div class="field">
                        <label class="_form-label">Email</label>
                        <div class="ui left icon input">
                            <input type="text" name="email" placeholder="email" required>
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <div class="field">
                        <label class="_form-label">Password</label>
                        <div class="ui left icon input">
                            <input type="password" name="password" required>
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <input type="submit" class="ui green button" value="Login" style="fomt-family:'nunito'">
                </div>
            </div>
</form>
<div class="middle aligned column">
    <a class="ui big button" href="/signup">
        <i class="signup icon"></i>
        Sign Up
    </a>
</div>
</div>
<div class="ui vertical divider">
    Or
</div>
</div>
@endsection
