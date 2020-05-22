
@extends('layouts.chat')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user-wrapper">
                <ul class="users">
                    @foreach($users as $user)
                        @if($user->profile->match == "pair")
                            <li class="user" id="{{ $user->profile->user_id }}">

                                {{--will show unread count notification--}}
                                @if($user->profile->unread > 0)
                                    <span class="pending">{{ $user->profile->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                        @if($user->profile->prf_img)
                                            <img src="{{asset('storage')}}/{{$user->profile->prf_img}}" class="media-object" alt="Avatar">

                                        @else
                                            <img src="{{asset('images/user.jpg')}}" class="media-object" alt="Avatar">
                                        @endif
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->profile->prf_firstname }}</p>
                                        <p class="email">{{ $user->profile->prf_workaddress }}</p>

                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-8" id="messages">

        </div>
    </div>
</div>
@endsection
