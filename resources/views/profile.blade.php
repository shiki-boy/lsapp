@extends('layouts.master')

@include('partials.navbar')

@section('title')
Profile
@endsection

@section('content')

<div class="ui hidden divider"></div>
<h1 class="ui _form-label container" style="font-size:2rem;">Your Profile</h1>
<div class="ui divider container"></div>

<div class="ui hidden divider"></div>

@if (Storage::disk('local')->has($user->username.'.jpg'))

<div class="ui grid container">
    <div class="row">
        <div class="three wide column">
            <div class="section">
                <img class="ui small image" src="{{ route('profile.pic',['filename'=>$user->username.'.jpg']) }}">
            </div>
        </div>
        <div class="five wide column">
            <form class="PIC-FORM" style="display:none;" action="{{ route('profile.pic.save') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <div class="field">
                    <label>Image .jpg</label>
                    <input type="file" name="profilepic">
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="ui grid container">
    <div class="row">
        <div class="section">
            <img class="ui small image" src="/image.png">
        </div>
    </div>
    <div class="five wide column">
        <form class="PIC-FORM" style="display:none;" action="{{ route('profile.pic.save') }} " method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <div class="field">
                <label>Image .jpg</label>
                <input type="file" name="profilepic">
            </div>
        </form>
    </div>
</div>

@endif
<div class="ui grid container">
    <button class="ui basic primary button" id="img-btn">
        Edit
    </button>
</div>

<div class="ui hidden divider"></div>

<div class="ui grid container">
    <form action="{{ route('profile.edit') }}" id="TEXT-FORM" method="POST">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <div class="ui eaual width form">
            <div class="fields">
                <div class="inline field _form-label">
                    <label> Email Address</label>
                    <input type="email" name="email" readonly='' placeholder="Your email" value="{{ $user->email }}">
                </div>
                <div class="inline field _form-label">
                    <label>Username</label>
                    <input type="text" name="username" readonly='' placeholder="Your Username" value="{{ $user->username }}">
                </div>
                <div class="inline field">
                    <button class="ui primary basic button" id='edit-btn'>Edit</button>
                </div>
            </div>
        </div>
    </form>
</div>





@endsection

@section('myscript')
<script>
    var btnName = imgbtn = 'Save';

    $("#img-btn").click(function (event) {
        event.preventDefault();
        var el = $("input[name='profilepic']");

        $(this).text(imgbtn);

        if (imgbtn == 'Save') {
            imgbtn = 'Edit';
            $(".PIC-FORM").show();
        } else {
            imgbtn = 'Save';
            $(".PIC-FORM").hide();
            $(".PIC-FORM").submit();
        }
        $(this).toggleClass('primary basic positive');
    });

    $("#edit-btn").click(function (event) {
        event.preventDefault();
        var el = $("input[name='email'],input[name='username']");

        $(this).text(btnName);

        if (btnName == 'Save') {
            $(el).removeAttr('readonly');
            btnName = 'Edit';
        } else {
            $(el).attr('readonly', '');
            btnName = 'Save';
            $("#TEXT-FORM").submit();
        }
        $(this).toggleClass('primary basic positive');
    });

</script>
@endsection
