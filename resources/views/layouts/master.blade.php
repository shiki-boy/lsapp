<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.3/dist/semantic.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <title>@yield('title')</title>

</head>

<style>
    body {
        display: none;
        background: #f3f7f7;
    }

    input, textarea{
        caret-color: red;
    }

    ._form-label {
        font-family: nunito;
        font-variant-caps: small-caps;
        font-size: 1.2rem;
        letter-spacing: 1.5px;
    }

    ._vignette {
        /* position: fixed; */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        box-shadow: 0 0 200px -43px #666 inset;
    }

</style>

<body class="">

    {{-- ------------------------PAGE DIMMER-------------------------- --}}

    <div class="ui page dimmer">
        <div class="content">
            <h2 class="ui inverted icon header">
                <i class="hand peace icon"></i>
                <div class="ui hidden divider"></div>
                <span style="font-family:'nunito';">Post Edited</span>
            </h2>
        </div>
    </div>

    {{-- ------------------------------------------------------------- --}}

    <div>
        @yield('content')
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.3/dist/semantic.min.js"></script>
    <script>
        $('.ui.dropdown').dropdown({
            'on': 'hover'
        });

        $(document).ready(() => {
            $('body').transition('vertical flip');

            setTimeout(()=>{
                $('.post:lt(5)').transition({
                    animation: 'pulse',
                    duration: 800,
                    interval: 200
                });
            },700);
        });

    </script>
    @yield('myscript')

</body>

</html>
