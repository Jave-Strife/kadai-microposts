@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('users.navtabs', ['user' => $user])
            <ul class="list-unstyled">
                @foreach( $favorites as $key => $favorite )
                    <li class="media mb-3">
                        <img class="mr-2 rounded" src="{{ Gravatar::src($emails[$key], 50) }}" alt="">
                        <div class="media-body">
                            <div>
                                {!! link_to_route('users.show', $users[$key], ['id' =>$favorite->user->id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
                            </div>
                            <div>
                                <p class="mb-0">{!! nl2br( e($favorite->content) ) !!}</p>
                            </div>
                            <div class="d-flex flex-row">
                                @if( Auth::user()->is_favoriting($favorite->id) )
                                    {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('UnFavorite', ['class' => "btn btn-success btn-sm"]) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['favorites.favorite', $favorite->id]]) !!}
                                        {!! Form::submit('Favorite', ['class' => "btn btn-light btn-sm"]) !!}
                                    {!! Form::close() !!}
                                @endif
                                @if( Auth::id() == $favorite->user_id )
                                    {!! Form::open(['route' => ['microposts.destroy', $favorite->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection