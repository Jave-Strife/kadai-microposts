<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Microposts</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
            @if( Auth::check() )
                <div class="row">
                    <aside class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ Auth::user()->name }}</h3>
                            </div>
                            <div class="card-body">
                                <img class="rounded img-fluid" src="{{ Gravatar::src(Auth::user()->email, 500) }}" alt="">
                            </div>
                        </div>
                    </aside>
                    <div class="col-sm-8">
                        @if( Auth::id() == $user->id )
                            {!! Form::open(['route' => 'microposts.store']) !!}
                                <div class="form-group">
                                    {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                                    {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                                </div>
                            {!! Form::close() !!}
                        @endif
                        @if( count( $microposts ) > 0 )
                            @include('microposts.microposts', ['microposts' => $microposts])
                        @endif
                    </div>
                </div>
            @else
                <div class="center jumbotron">
                    <div class="text-center">
                        <h1>Welcome to the Microposts</h1>
                        {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
                    </div>
                </div>
            @endif
        @endsection
    </body>
</html>
