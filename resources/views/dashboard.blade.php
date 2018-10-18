@extends('layouts.master')

@include('partials.navbar')
@section('title')
dashboard
@endsection

@section('content')

<div class="ui hidden divider"></div>



{{-- ------------------------ MODAL ---------------------------------- --}}

<div class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        Edit Your Post
    </div>
    <div class="content">
        <div class="ui form" id="MODAL-FORM">
            <div class="field">
                <label>Write Something...</label>
                <textarea name="editpost" id='editpost' data-emojiable="true"></textarea>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui black deny button">
            Cancel
        </div>
        <div class="ui positive right labeled icon button">
            Save
            <i class="checkmark icon"></i>
        </div>
    </div>
</div>

{{-- ---------------------------------------------------------------------- --}}

<form action="{{ route('post.create') }}" id='CREATE-POST' method="POST">
    <input type="hidden" name="_token" value="{{ Session::token()}}"> {{--CSRF protection--}}
    <div class="ui centered doubling stackable grid container">

        <div class="row">
            <div class="eight wide column">
                <div class="ui huge form error">
                    <div class="field ">
                        <label class="_form-label">What about today...</label>
                        <textarea rows="3" name="body" data-emojiable="true"></textarea>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="ui animated fade big teal button" id='_create-post-btn' style="width:11rem;">
                <div class="hidden content">Create Post</div>
                <div class="visible content">
                    <i class="check icon"></i>
                </div>
            </div>
        </div>

    </div>
</form>

<div class="ui container divider"></div>

<div class="ui doubling stackable centered grid container">

    <div class="row">
        <div class="twelve wide column" style="box-shadow:0px 9px 20px 0px #0000004d;padding:0;">
            <h3 class="ui top attached header inverted _form-label">
                Feed
            </h3>

            @foreach ($posts as $post)

            <div class="ui attached segment post">
                {{-- <a class="ui green left corner label">
                    <i class="exclamation icon"></i>
                </a> --}}
                <a class="ui teal tag label _form-label">New</a>
                <div class="ui feed">
                    <div class="event">
                        <div class="label">
                            <img src="{{ route('profile.pic',['filename'=>$post->user->username.'.jpg']) }}">
                            {{-- <img src="/images/avatar/small/joe.jpg"> --}}
                        </div>
                        <div class="content">
                            <div class="summary">
                                <a>{{ $post->user->username }}</a> posted on his page
                                <div class="date">
                                    {{ $post->created_at }} 3 days ago
                                </div>

                                @if (Auth::user() == $post->user)
                                <a href='{{ route('post.delete',['post_id' => $post->id]) }}' class="circular ui icon basic right floated negative mini button"
                                    data-tooltip="Delete your post" data-position="right center">
                                    <i class="icon trash"></i>
                                </a>
                                <a href='#' class="circular ui icon basic right floated positive mini button _edit-post"
                                    data-tooltip="Edit your post" data-position="left center">
                                    <i class="icon edit"></i>
                                </a>
                                @endif

                            </div>
                            <div class="extra text" data-postId="{{ $post->id }}">
                                {{ $post->body }}
                            </div>

                            <div class="ui hidden divider"></div>
                            {{--
                            <div class="ui mini horizontal statistic">
                                <button class="ui circular basic icon button" id="like-btn">
                                    <i class="heart icon"></i>
                                </button>
                                <div class="value">
                                    5
                                </div>
                            </div> --}}
                            <div class="ui labeled button">
                                <div  class="ui button _like-btn {{ Auth::user()->likes()->where('post_id',$post->id)->get()->first() != null ? 'red' : 'basic' }}">
                                    <i class="heart icon {{ Auth::user()->likes()->where('post_id',$post->id)->get()->first() != null ? 'white' : 'red'}}"></i>
                                     Like
                                </div>
                                <a class="ui basic left pointing label">
                                    {{ $post->likes()->where('post_id',$post->id)->get()->count() }}
                                </a>
                            </div>
                            <div class="meta">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>

</div>

@endsection

@section('myscript')


<script>
    $('.ui.modal').modal()
    var postBody = '';
    var postId, postElement;


    // ==================================================================================
    //                                     LIKE BTN 

    $("._like-btn").click(function () {
        $(this).toggleClass('basic red')
        $(this).children().last().toggleClass('red white')
        var postEl = $(this).parent().parent().children()[1]
        var postId = postEl.attributes[1].value
        console.log(postId);
        $.ajax({
            method: "POST",
            url: "{{ route('like') }}",
            data: {
                _token: "{{ Session::token() }}",
                postId
            },
            success: function (data) {
                console.log(data);
            }
        })
    });

    // .................................................................................


    // ==================================================================================
    //                                 FORM VALIDATIONS

    $("#_create-post-btn").click(function () {
        if ($("#CREATE-POST").form('is valid')) {
            $("#CREATE-POST").submit();
        } else {
            $("#CREATE-POST").form("validate form");
        }
    });

    $("#CREATE-POST").form({
        fields: {
            post: {
                identifier: 'body',
                rules: [{
                    type: 'empty',
                    prompt: 'This field is empty.'
                }]
            }
        }
    })

    $("#MODAL-FORM").form({
        fields: {
            editpost: {
                identifier: 'editpost',
                rules: [{
                    type: 'empty',
                    prompt: 'This field is empty.'
                }]
            }
        }
    })

    // ..................................................................................


    // ==================================================================================
    //                                      POST EDIT

    $('.ui.modal')
        .modal({
            blurring: true,
            closable: false,
            onApprove: function () {
                if (!$("#MODAL-FORM").form('is valid')) {
                    $("#MODAL-FORM").form("validate form");
                } else {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('editpost') }}",
                        data: {
                            body: $("#editpost").val(),
                            postId: postId,
                            _token: "{{ Session::token() }}"
                        },
                        success: function (data) {
                            postElement.textContent = $("#editpost").val(); // ? update post in view alse no need for reloading
                            $('.page.dimmer:first').dimmer('toggle');
                            // $("body.dimmable,.ui.dimmer.modals").dimmer('hide');
                        }
                    });
                }
            }
        })
        .modal('attach events', '._edit-post', 'show')
        .modal('setting', 'transition', 'vertical flip')
        .modal('setting', 'onVisible', function () {
            $(this).find('textarea').val(postBody);
        });

    $("._edit-post").click(function (el) {
        postElement = $(this).parent().parent().children()[1];
        postBody = postElement.textContent.trim();
        postId = postElement.attributes[1].value;
    });


    // ............................................................................

</script>

@endsection
