@extends('layouts.master')

@section('nav')
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link active" href="{{ route('classroom.show', ['id' => $classroom->cls_id]) }}">
            <i class="fas fa-graduation-cap pr-2"></i>
            Stream</a>
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
        <div class="col-xl-1">

        </div>
        <div class="col-xl-8 col-lg-8">
            {{-- <div class="row">
                        <div class="col owl-carousel owl-theme week_carousel">
                            <div class="card mb-4 list-weeks active">
                                <div class="card-body p-0">
                                    <span class="text-uppercase">
                                        <i class="far fa-calendar-alt fa-lg"></i>
                                        week 1
                                    </span>
                                </div>
                            </div>
                            <div class="card mb-4 list-weeks">
                                <div class="card-body p-0">
                                    <span class="text-uppercase">
                                        <i class="far fa-calendar-alt fa-lg"></i>
                                        week 2
                                    </span>
                                </div>
                            </div>
                            <div class="card mb-4 list-weeks">
                                <div class="card-body p-0">
                                    <span class="text-uppercase">
                                        <i class="far fa-calendar-alt fa-lg"></i>
                                        week 3
                                    </span>
                                </div>
                            </div>
                            <div class="card mb-4 list-weeks">
                                <div class="card-body p-0">
                                    <span class="text-uppercase">
                                        <i class="far fa-calendar-alt fa-lg"></i>
                                        week 4
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
            <div class="card card_heading mb-4 border-0 shadow-theme">
                @if($classroom->cls_img)
                <img class="card_bg" src="{{asset('storage')}}/{{$classroom->cls_img}}">
                @else
                <img class="card_bg" src="{{asset('images/bg_card/etienne-bosiger-WTkUYzNCu-A-unsplash.jpg')}}">
                @endif
                <div class="card-body">
                    <h1 class="display-4 font-weight-light">{{$classroom->cls_name}}</h1>
                    <h4 class="card-text">{{$classroom->cls_level}}</h4>
                    <h5 class="card-text code">Code : {{$classroom->cls_code}}</h5>
                    <h5 class="card-text teacher d-lg-block d-none">
                        @if(Auth::user()->profile->prf_img)
                        <img src="{{asset('storage')}}/{{Auth::user()->profile->prf_img}}" class="avatar border border-light">
                        @else
                        <img src="{{asset('images/user.jpg')}}" class="avatar border border-light">
                        @endif

                        : {{Auth::user()->profile->prf_firstname}} {{Auth::user()->profile->prf_lastname}}</h5>
                </div>
            </div>
            @can ('update', $owner->profile)
                <div class="row">
                    <div class="col owl-carousel owl-theme week_carousel">
                        <div class="card mb-4 list-weeks active">
                            <div class="card-body p-0">
                                <span class="text-uppercase">
                                    <a class="nav-link generate-schedule" href="#" data-toggle="modal" data-target="#Genarate">
                                        <i class="fas fa-robot fa-lg"></i>
                                    GENARATE</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            <div class="row">

                {{-- Create Schedule --}}
                <div class="col-xl-10 mx-auto">
                    <div class="accordion d-lg-block d-none" id="accordionPost">
                        <div class="card mb-4 border-0 shadow-theme card-radius">

                            @can ('update', $owner->profile)
                            <div class="card-header bg-white" id="Postheading">
                                <h5 class="mb-0">
                                    <a href="#" class="link_post text-uppercase" data-toggle="collapse" data-target="#Post" aria-expanded="true" aria-controls="Post">
                                        <i class="far fa-edit"></i> Create Schedule
                                    </a>
                                </h5>
                            </div>

                            <div id="Post" class="collapse show" aria-labelledby="Postheading" data-parent="#accordionPost">
                                <div class="card-body">
                                    <form action="{{route('schedule.store', ['id' => $classroom->cls_id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Division Name..." name="name" id="" rows="2" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" placeholder="Division Description..." name="role" id="" rows="5" required></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-2 col-lg-4">
                                                <label>Win Point</label>
                                                <input type="number" class="form-control" name="winpoint" placeholder="3" value="3" required>
                                            </div>
                                            <div class="form-group col-md-2 col-lg-4">
                                                <label>Draw Point</label>
                                                <input type="number" class="form-control" name="drawpoint" value="1" placeholder="1" required>
                                            </div>
                                            <div class="form-group col-md-2 col-lg-4">
                                                <label>Lose Point</label>
                                                <input type="number" class="form-control" name="losepoint" value="0" placeholder="0" required>
                                            </div>
                                        </div>

                                        <div class="clearfix">
                                            <div class="float-right">
                                                <button type="submit" class="btn btn-theme rounded px-5 btn-block text-uppercase">
                                                    Create
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endcan

                        </div>
                    </div>
                </div>

                @foreach ($classroom->classroomdivision as $division)
                <div class="col-xl-10 mx-auto">
                    <div class="card mb-4 border-0 shadow-theme card-radius">
                        <div class="card-header bg-blue text-white clearfix">
                            <div class="float-left">
                                <h4>Schedule</h4>
                            </div>
                            <div class="float-right">
                                <div class="dropdown d-inline dropdown_post">
                                    @can ('update', $owner->profile)
                                    <a href="#" class="link_icon" id="dropdownPost" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v pt-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right animate slideIn border-0 shadow" aria-labelledby="dropdownPost">
                                        <a href="#" class="dropdown-item edit-modal" data-id="{{$division->div_id}}" data-name="{{$division->div_name}}" data-win="{{$division->div_win}}" data-draw="{{$division->div_draw}}" data-lose="{{$division->div_lose}}" data-role="{{$division->div_role}}">
                                            <i class="far fa-edit pr-1"></i>แก้ไข</a>
                                        <a class="dropdown-item" href="{{route('schedule.destroydivision', ['id' => $division->div_id])}}"><i class="fas fa-trash pr-1"></i>
                                            ลบ</a>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="item{{$division->div_id}}">
                            <h4>Disvision: {{$division->div_name}}</h4>
                            <ul class="list-group list-group-flush">
                                @foreach ($division_member as $teammember)
                                    @if($teammember->div_id == $division->div_id)
                                    <li class="list-group-item clearfix border-0">
                                        @if($teammember->prf_img)
                                            <img src="{{asset('storage')}}/{{$teammember->prf_img}}" class="avatar">
                                        @else
                                            <img src="{{asset('images/user.jpg')}}" class="avatar" alt="Avatar">
                                        @endif
                                        <span class="pl-2">{{$teammember->prf_firstname}} {{$teammember->prf_lastname}}</span>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer bg-white">
                            @can ('update', $owner->profile)
                            <a href="#" class="setting-modal" data-set_id="{{$division->div_id}}" data-set_name="{{$division->div_name}}">
                                <span class="btn btn-outline-primary"><i class="fas fa-cog"></i> Setting</span></a>
                            <a href="{{route('schedule.destroymember', ['id' => $division->div_id])}}">
                                <span class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Reset</span></a>
                            @endcan
                            <a class="role-modal" data-name="{{$division->div_name}}" data-rule="{{$division->div_role}}" data-win="{{$division->div_win}}" data-draw="{{$division->div_draw}}" data-lose="{{$division->div_lose}}">
                                <span class="btn btn-info "><i class="fas fa-sign-in-alt"></i> Rule</span></a>

                            <a href="{{route('match.show', ['id' => $division->div_id])}}">
                                <span class="btn btn-warning"><i class="fas fa-sign-in-alt"></i> View</span></a>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
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
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('modal')
    <!-- Modal Team-->
    {{-- <div class="modal fade" id="SettingModal" tabindex="-1" role="dialog" aria-labelledby="SettingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SettingModalLabel">ตั้งค่าทีม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item clearfix">
                            <div class="float-left">
                                <img src="images/img1.jpg" class="avatar mr-2">
                                <span>Name</span>
                            </div>
                            <div class="float-right">
                                <a href="#" class="delete-comment">
                                    <small>
                                        <i class="fas fa-trash"></i>
                                    </small>
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item clearfix">
                            <div class="float-left">
                                <img src="images/img1.jpg" class="avatar mr-2">
                                <span>Name</span>
                            </div>
                            <div class="float-right">
                                <a href="#" class="delete-comment">
                                    <small>
                                        <i class="fas fa-trash"></i>
                                    </small>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-theme">บันทึก</button>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Edit Post -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-white" id="Postheading">
                            <h5 class="modal-title">
                                    <i class="far fa-edit"></i> Edit Division
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                <form id="change_name" class="form-horizontal" role="form">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div class="col-sm-10">
                                <input type="hidden" name="id" class="form-control" id="fid">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="name" id="name" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="role" id="role" rows="4" required></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2 col-lg-4">
                                <label>Win Point</label>
                                <input type="number" class="form-control" id="win" name="win" required>
                            </div>
                            <div class="col-md-2 col-lg-4">
                                <label>Draw Point</label>
                                <input type="number" class="form-control" id="draw" name="draw" required>
                            </div>
                            <div class="col-md-2 col-lg-4">
                                <label>Lose Point</label>
                                <input type="number" class="form-control" id="lose" name="lose" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="submit" class="btn actionBtn">
                                <span id="footer_action_button" class='glyphicon'></span>
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Setting Post -->
    <div id="myModalSetting" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-white" id="Postheading">
                            <h5 class="modal-title">
                                    <i class="far fa-edit"></i> Setting Division
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                <form action="{{route('schedule.create', ['id' => $classroom->cls_id])}}" method="POST" class="form-horizontal" role="form">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div>
                            <div class="col-sm-10">
                                <input type="hidden" name="set_id" class="form-control" id="set_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="set_name" id="set_name" rows="1" disabled></textarea>
                        </div>
                        <div class="form-group">
                            @foreach ($division_list as $key => $item)
                            <div class="form-check">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="input" id="checkbox-1" name="option[]" value="{{$item->user_id}}">
                                        @if($item->prf_img)
                                            <img src="{{asset('storage')}}/{{$item->prf_img}}" class="avatar ml-2">
                                        @else
                                            <img src="{{asset('images/user.jpg')}}" class="avatar ml-2" alt="Avatar">
                                        @endif
                                    <span>
                                    {{$item->prf_firstname}} {{$item->prf_lastname}}
                                    </span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <!-- select all boxes -->
                            <input type="checkbox" name="select-all" id="select-all" />
                            <label for="checkbox-3"> Select All</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-theme px-3">Update</button>
                        {{-- <button type="submit" >
                                            <span id="footer_action_button_edit" class='glyphicon'></span>
                                        </button> --}}
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Rule -->
    <div id="myModalRule" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                        <div class="modal-header bg-white" id="Postheading">
                            <h5 class="modal-title">
                                    <i class="far fa-edit"></i>  Division Rule
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                <form id="change_name" class="form-horizontal" role="form">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <div class="col-sm-10">
                                <input type="hidden" name="id" class="form-control" id="fid">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="role" id="rulerole" rows="5" disabled></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-md-2 col-lg-4">
                                <label>Win Point</label>
                                <input type="number" class="form-control" id="rule_win" name="rule_win" disabled>
                            </div>
                            <div class="col-md-2 col-lg-4">
                                <label>Draw Point</label>
                                <input type="number" class="form-control" id="rule_draw" name="rule_draw" disabled>
                            </div>
                            <div class="col-md-2 col-lg-4">
                                <label>Lose Point</label>
                                <input type="number" class="form-control" id="rule_lose" name="rule_lose" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class='glyphicon glyphicon-remove'></span> Close
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Genarate -->
    <div class="modal fade" id="Genarate" tabindex="-1" role="dialog" aria-labelledby="GenarateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            {{-- <form action="{{route('match.generate', ['id' => $classroom->cls_id])}}" method="post" enctype="multipart/form-data" role="form"> --}}
            <form action="" method="post" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Setting">เลือกรูปแบบการจับคู่</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <div>
                                <div class="col-sm-12">
                                    สัปดาห์แข่งขัน<input type="text" name="week" class="form-control" value="{{$classroom->cls_duration}}" placeholder="จำนวนสัปดาห์" id="week">
                                </div>
                            </div>

                            <div class="col-12 card p-3 mb-1 mt-2">
                                <div class="custom-control custom-radio pt-2">
                                    <input type="radio" id="choice1" name="radio" value ="1" class="custom-control-input" required>
                                    <label class="custom-control-label" for="choice1">1. แบบสุ่ม</label>
                                </div>
                                <div class="custom-control custom-radio pt-3">
                                    <input type="radio" id="choice2" name="radio" value ="2" class="custom-control-input">
                                    <label class="custom-control-label" for="choice2">2. แบบสลับเลขลำดับคู่คี่</label>
                                </div>
                                <div class="custom-control custom-radio pt-3">
                                    <input type="radio" id="choice3" name="radio" value ="3" class="custom-control-input">
                                    <label class="custom-control-label" for="choice3">3. แบบใช้คะแนนทดสอบก่อนเรียน (งูกินหาง) *</label>
                                </div>
                                <div class="custom-control custom-radio pt-3">
                                    <input type="radio" id="choice4" name="radio" value ="4" class="custom-control-input">
                                    <label class="custom-control-label" for="choice4">4. แบบใช้คะแนนทดสอบก่อนเรียน (ช่วงลำดับชั้น)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="submit" id="btn" type="button" class="btn btn-theme Genarate">ยืนยัน</button>
                    </div>
                </div>
            </form>
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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Edit Data (Modal and function edit data)
    // =============================================================================================
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        // ตั้งค่าชื่อ ปุ่ม
        $('#footer_action_button').addClass('glyphicon-check');
        // การเพิ่ม คลาสเข้าไปใน id footer_action_button
        $('.actionBtn').addClass('btn-success');
        // การเพิ่ม คลาสเข้าไปใน id actionBtn
        $('.actionBtn').addClass('edit');
        // การเพิ่ม คลาสเข้าไปใน id actionBtn
        $('.modal-title').text('Edit');
        // ตั้งค่าชื่อ title
        $('.form-horizontal').show();
        // การสั่งให้คลาส แสดงขึ้นมา เพื่อให้มันมา Form ในการส่งข้อมูล
        $('#fid').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#win').val($(this).data('win'));
        $('#draw').val($(this).data('draw'));
        $('#lose').val($(this).data('lose'));
        $('#role').val($(this).data('role'));
        // การกำหนดค่าตัวแปร
        $('#myModal').modal('show');
        // การแสดงค่า
    });

    $(document).ready(function() {
        $('form#change_name').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('cls_id', '{{$classroom->cls_id}}');
            $.ajax({
                url: "{{ route('schedule.edit') }}",
                method: "POST",
                data: formData,
                dataType: "JSON",
                success: function(data) {
                    // $('#success_name').removeClass('d-none');
                    // $('#success_name').html(data.success);
                    // $('#fullname').html(data.name);
                    $('#item' + data.id).replaceWith("<div class='card-body ' id='item" + data.id + "'><h4>Disvision: " + data.name + "</h4><p class='card-text pb-1'><i class='far fa-clock'></i> Friday 1</p><a href='#' ><h6 class='btn-link'><i class='fas fa-cog'></i> Setting</h6></a></div>");
                    $('#myModal').modal('toggle');
                    //alert(data.id+' '+data.cls_id+' '+' '+data.name+' '+data.win+' '+data.draw+' '+data.lose);
                },
                error: function(data) {
                    $('#danger_name').removeClass('d-none');
                    $('#danger_name').html(data.responseJSON.error);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
    // =============================================================================================

    // Setting Data (Modal and function setting data)
    // =============================================================================================
    $(document).on('click', '.setting-modal', function() {
        $('#footer_action_button_edit').text("Update");
        // ตั้งค่าชื่อ ปุ่ม
        $('#footer_action_button_edit').addClass('glyphicon-check');
        // การเพิ่ม คลาสเข้าไปใน id footer_action_button
        $('.actionBtn').addClass('btn-success');
        // การเพิ่ม คลาสเข้าไปใน id actionBtn
        $('.actionBtn').addClass('edit');
        // การเพิ่ม คลาสเข้าไปใน id actionBtn
        $('.modal-title').text('Setting');
        // ตั้งค่าชื่อ title
        $('.form-horizontal').show();
        // การสั่งให้คลาส แสดงขึ้นมา เพื่อให้มันมา Form ในการส่งข้อมูล
        $('#set_id').val($(this).data('set_id'));
        $('#set_name').val($(this).data('set_name'));
        $('#win').val($(this).data('win'));
        $('#draw').val($(this).data('draw'));
        $('#lose').val($(this).data('lose'));
        // การกำหนดค่าตัวแปร
        $('#myModalSetting').modal('show');
        // การแสดงค่า
    });
    // =============================================================================================

    // Rule Data (Modal and function rule data)
    // =============================================================================================
    $(document).on('click', '.role-modal', function() {
        $('.form-horizontal').show();
        // การสั่งให้คลาส แสดงขึ้นมา เพื่อให้มันมา Form ในการส่งข้อมูล
        $('#rulename').val($(this).data('name'));
        $('#rulerole').val($(this).data('rule'));
        $('#rule_win').val($(this).data('win'));
        $('#rule_draw').val($(this).data('draw'));
        $('#rule_lose').val($(this).data('lose'));
        // การกำหนดค่าตัวแปร
        $('#myModalRule').modal('show');
        // การแสดงค่า
    });

    $(document).ready(function() {
        $('form#change_name').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('cls_id', '{{$classroom->cls_id}}');
            $.ajax({
                url: "{{ route('schedule.edit') }}",
                method: "POST",
                data: formData,
                dataType: "JSON",
                success: function(data) {
                    // $('#success_name').removeClass('d-none');
                    // $('#success_name').html(data.success);
                    // $('#fullname').html(data.name);
                    $('#item' + data.id).replaceWith("<div class='card-body ' id='item" + data.id + "'><h4>Disvision: " + data.name + "</h4><p class='card-text pb-1'><i class='far fa-clock'></i> Friday 1</p><a href='#' ><h6 class='btn-link'><i class='fas fa-cog'></i> Setting</h6></a></div>");
                    $('#myModal').modal('toggle');
                    //alert(data.id+' '+data.cls_id+' '+' '+data.name+' '+data.win+' '+data.draw+' '+data.lose);
                },
                error: function(data) {
                    $('#danger_name').removeClass('d-none');
                    $('#danger_name').html(data.responseJSON.error);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    });
    // =============================================================================================

    // Listen for click on toggle checkbox

    $(document).on('click', '#select-all', function() {
        if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
    });

    // $(document).ready(function() {
    //     $('#select-all').click(function(event) {
    //         if (this.checked) {
    //             // Iterate each checkbox
    //             $(':checkbox').each(function() {
    //                 this.checked = true;
    //             });
    //         } else {
    //             $(':checkbox').each(function() {
    //                 this.checked = false;
    //             });
    //         }
    //     })
    // };
</script>
