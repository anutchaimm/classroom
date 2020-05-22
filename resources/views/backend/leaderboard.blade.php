@extends('layouts.master')

@section('nav')
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link active" href="{{ route('classroom.show', ['id' => $classroom->cls_id]) }}">
            <i class="fas fa-graduation-cap pr-2"></i>
            Steam</a>
    </li>
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link" href="{{ route('schedule.show', ['id' => $classroom->cls_id]) }}">
            <i class="fas fa-list-ul pr-2"></i>
            Schedule</a>
    </li>
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link" href="{{ route('leaderboard.show', ['id' => $classroom->cls_id]) }}">
            <i class="fas fa-chart-line pr-2"></i>
            LeaderBoard</a>
    </li>
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link" href="{{ route('pairing.show', ['id' => $classroom->cls_id]) }}">
            <i class="far fa-heart pr-2"></i>
            Paring</a>
    </li>
@stop

@section('content')
        <!------------------------- Content ------------------------->
        <div class="container-fluid mt-4 mb-4 pb-4">
            <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
            <div class="row">
                <div class="col-xl-1" id="week"></div>

                <div class="col-xl-8 col-lg-8">

                    <div class="card card_heading mb-4 border-0 shadow-theme">
                        @if($classroom->cls_img)
                            <img class="card_bg" src="{{asset('storage')}}/{{$classroom->cls_img}}">
                        @else
                            <img class="card_bg" src="{{asset('images/bg_card/etienne-bosiger-WTkUYzNCu-A-unsplash.jpg')}}">
                        @endif
                        <div class="card-body">
                            <h1 class="display-4 font-weight-light">{{$classroom->cls_name}}</h1>
                            <h4 class="card-text">{{$classroom->cls_level}}</h4>
                            <h5 class="card-text code">CODE : {{$classroom->cls_code}}</h5>
                            <h5 class="card-text teacher d-lg-block d-none">
                                @if(Auth::user()->profile->prf_img)
                                <img src="{{asset('storage')}}/{{Auth::user()->profile->prf_img}}"
                                class="avatar border border-light">
                                @else
                                <img src="{{asset('images/user.jpg')}}"
                                class="avatar border border-light">
                                @endif

                            : {{Auth::user()->profile->prf_firstname}} {{Auth::user()->profile->prf_lastname}}</h5>
                        </div>
                    </div>

                    @foreach ($table as $tables)
                    <div class="card mb-4 border-0 shadow-theme card-radius">
                        <div class="card-header bg-blue text-white">
                            <h4>{{$tables->div_name}}</h4>
                        </div>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Team
                                        </th>
                                        <th class="text-center text-warning">
                                            Played
                                        </th>
                                        <th class="text-success">
                                            Won
                                        </th>
                                        <th class="text-secondary">
                                            Drawn
                                        </th>
                                        <th class="text-danger">
                                            Lost
                                        </th>
                                        <th class="text-info">
                                            Points
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($team as $key => $teams)

                                        @if($teams->div_id == $tables->div_id)
                                        <tr>
                                        <td>{{$teams->rank}}</td>
                                            <td>{{$teams->realname}}</td>
                                            <td class="text-center text-warning">{{$teams->div_usr_total_match}}</td>
                                            <td class="text-success">{{$teams->div_usr_total_win}}</td>
                                            <td class="text-secondary">{{$teams->div_usr_total_draw}}</td>
                                            <td class="text-danger">{{$teams->div_usr_total_lose}}</td>
                                            <td class="text-info">{{$teams->div_usr_total_point}}</td>
                                        </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="col-lg-4 col-xl-3 d-none d-lg-block">
                    <div class="card border-0 shadow-theme mb-4" id="list-team">
                        <div class="card-header bg-white">
                            <h4 class="m-0 text-theme">Member</h4>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @foreach ($member as $item)
                                    <li class="list-group-item clearfix border-0">
                                        <div class="float-left">
                                            @if(is_null($item->prf_img))
                                                <img src="{{asset('images/user.jpg')}}" class="avatar" alt="Avatar">
                                            @else
                                                <img src="{{asset('storage')}}/{{$item->prf_img}}" class="avatar mr-2">
                                            @endif
                                        <span>{{$item->prf_firstname}} {{$item->prf_lastname}}</span>
                                        </div>
                                        {{-- <div class="float-right">
                                            <span>
                                                <button class="btn btn-danger btn-sm rounded-circle" data-toggle="modal" data-target="#exampleDelteam">
                                                    <i class="fas fa-times p-1"></i>
                                                </button>
                                            </span>
                                        </div> --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('mobile-bar')
            <!------------------------- Moblie-bar ------------------------->
            <div class="d-block d-lg-none moblie-bar p-2">
                <div class="container-fluid text-center">
                    <div class="row row-cols-5">
                        <div class="col">
                            <a class="list-moblie" href="control.html">
                                <i class="fas fa-home"></i>
                                <small class="d-block ">Home</small>
                            </a>
                        </div>
                        <div class="col">
                            <a href="room.html" class="list-moblie active">
                                <i class="fas fa-graduation-cap"></i>
                                <small class="d-block">Strem</small>
                            </a>
                        </div>
                        <div class="col">
                            <a href="schedule.html" class="list-moblie">
                                <i class="fas fa-list-ul"></i>
                                <small class="d-block">Schedule</small>
                            </a>
                        </div>
                        <div class="col">
                            <a href="leaderboard.html" class="list-moblie">
                                <i class="fas fa-chart-line"></i>
                                <small class="d-block">Leader</small>
                            </a>
                        </div>
                        <div class="col">
                            <a href="pairing.html" class="list-moblie">
                                <i class="far fa-heart"></i>
                                <small class="d-block">Paring</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
@stop
