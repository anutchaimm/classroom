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
    <div id="all_schedule" class="container mt-4 mb-4 pb-4">
        <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
        <div class="row">

            <div class="col-lg-12">
                @can ('update', $owner->profile)
                <a href="#">

                    <a class="m-0" href="{{ route('schedule.show', ['id' => $classroom->cls_id]) }}">
                        <i class="fas fa-arrow-left text-white fa-sm pr-2" style="font-size: 24px;"></i>
                        </a>

                </a>
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row d-flex">
                            <div class="col-8">
                                <div class="text-left text-theme ">
                                    <a href="#">
                                        <h4 class="m-0">
                                            Time Table ({{$classroom->div_name}})
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-right text-theme">
                                    {{-- <small><i class="far fa-clock"></i> Friday 15</small> --}}
                                </div>
                            </div>
                            @if($countmember > 0)
                                <div class="col-md-2 text-right pt-3">
                                    <a href="{{route('match.createround', ['id' => $id])}}" class="btn btn-theme btn-block btn-sm">Matching</a>
                                </div>
                            @else
                            <div class="pt-3">
                                <div class="col-md-12 text-left" style="color:red;" role="alert">
                                    <strong>Error !</strong> Matching at least 2 member.

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endcan
                @if(count($match))
                @foreach ($match as $item)
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="text-left d-block">
                            <h6><i class="far fa-calendar-alt"></i> {{$item->com_date}} (Week {{$item->com_week}})</h6>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="card border-0 shadow-theme mb-4 card-schedule-left">
                                    <div class="row card-body">
                                        <span class="score-left text-white" id="home{{$item->scd_id}}">{{$item->com_scoreuser1}}</span>
                                        <div class="col-12">
                                            <h5 class="text-center">{{$item->com_realname1}}</h5>
                                        </div>
                                        @if($item->com_realpic1)
                                        <img src="{{asset('storage')}}/{{$item->com_realpic1}}" class="avatar-schedule-right d-none d-md-block">
                                        @else
                                        <img src="{{asset('images/user.jpg')}}" class="avatar-schedule-right d-none d-md-block">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center col-lg-2 mb-3">

                                @if($item->com_status <> "Finished")
                                    <button class="btn btn-white rounded-circle shadow-sm edit-modal pb-5" data-scd_id="{{$item->scd_id}}" data-div_id="{{$item->div_id}}" data-com_user1="{{$item->com_user1}}" data-com_scoreuser1="{{$item->com_scoreuser1}}" data-com_user2="{{$item->com_user2}}" data-com_scoreuser2="{{$item->com_scoreuser2}}" data-com_realname1="{{$item->com_realname1}}" data-com_realname2="{{$item->com_realname2}}">
                                        <span class="d-block">VS</span>
                                        <small class="d-block" id="result{{$item->scd_id}}">{{$item->com_status}}</small>
                                    </button>
                                    @else
                                    <button class="btn btn-white rounded-circle shadow-sm">
                                        <span class="d-block p-2">{{$item->com_result}}</span>
                                    </button>
                                    @endif

                                    @can ('update', $owner->profile)

                                    @if($item->com_status == "Waiting")
                                    <a  role="button" data-scd_id="{{$item->scd_id}}" class="btn btn-outline-warning btn-sm text-warning d-block mt-3 confrimScore" id="confrimScore">Confirm</a>
                                    @endif

                                    @if($item->com_status == "Finished")
                                    <a  role="button" data-scd_id="{{$item->scd_id}}" class="btn btn-outline-danger btn-sm text-danger d-block mt-3 cancelScore" id="cancelScore">Cancel</a>
                                    @endif

                                    @endcan
                            </div>

                            <div class="col-12 col-lg-5">
                                <div class="card border-0 shadow-theme mb-4 card-schedule-right">
                                    <div class="row card-body">
                                        <span class="score-right text-white" id="away{{$item->scd_id}}">{{$item->com_scoreuser2}}</span>
                                        <div class="col-12 text-center">
                                            <h5>{{$item->com_realname2}}</h5>
                                        </div>
                                        @if($item->com_realpic2)
                                        <img src="{{asset('storage')}}/{{$item->com_realpic2}}" class="avatar-schedule-left d-none d-md-block">
                                        @else
                                        <img src="{{asset('images/user.jpg')}}" class="avatar-schedule-left d-none d-md-block">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

        </div>
    </div>
@stop

@section('modal')
    <!-- Modal AddStudent -->
    <div class="modal fade" id="AddStudent" tabindex="-1" role="dialog" aria-labelledby="AddStudentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="change_name" class="form-horizontal" role="form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addScoreLabel">คะแนน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                        <input type="hidden" name="scd_id" class="form-control" id="scd_id">
                        <input type="hidden" name="div_id" class="form-control" id="div_id">
                        <input type="hidden" name="com_user1" class="form-control" id="com_user1">
                        <input type="hidden" name="com_user2" class="form-control" id="com_user2">
                    </div>

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-12 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-theme" id="com_realname1"></span>
                                    </div>
                                    <input type="number" id="com_scoreuser1" name="com_scoreuser1" min="0" max="20" value="0" class="form-control" placeholder="score" aria-describedby="user-score-1" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-theme" id="com_realname2"></span>
                                    </div>
                                    <input type="number" id="com_scoreuser2" name="com_scoreuser2" min="0" max="20" class="form-control" placeholder="score" aria-describedby="user-score-2" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-theme">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
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
                    <a href="room.html" class="list-moblie">
                        <i class="fas fa-graduation-cap"></i>
                        <small class="d-block">Strem</small>
                    </a>
                </div>
                <div class="col">
                    <a href="schedule.html" class="list-moblie active">
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
    $(document).on('click', '.edit-modal', function() {

        // การเพิ่ม คลาสเข้าไปใน id actionBtn
        $('.modal-title').text('Score');
        // ตั้งค่าชื่อ title
        $('.form-horizontal').show();
        // การสั่งให้คลาส แสดงขึ้นมา เพื่อให้มันมา Form ในการส่งข้อมูล
        $('#scd_id').val($(this).data('scd_id'));
        $('#div_id').val($(this).data('div_id'));
        $('#com_user1').val($(this).data('com_user1'));
        $('#com_scoreuser1').val($(this).data('com_scoreuser1'));
        $('#com_user2').val($(this).data('com_user2'));
        $('#com_scoreuser2').val($(this).data('com_scoreuser2'));
        $('#com_realname1').html($(this).data('com_realname1'));
        $('#com_realname2').html($(this).data('com_realname2'));

        // การกำหนดค่าตัวแปร
        $('#AddStudent').modal('show');
        // การแสดงค่า
    });

    $(document).on('click', '.confrimScore', function() {
        document.getElementById("confrimScore").disabled  = true;
        document.getElementById("confrimScore").style.visibility = "hidden";

        var match_id = $(this).data("scd_id");
        //confirm("Are You sure want to delete !");
        var url = '{{ route("match.incrementpoint", ":id") }}';
        url = url.replace(':id', match_id);
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                console.log(data.scd_id);
                $('#result' + data.scd_id).html('Finished');
                //alert('SucessConfrim');
            },
            error: function(data) {
                console.log('Error:', data);
                alert('Failed');
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).on('click', '.cancelScore', function() {
        document.getElementById("cancelScore").disabled = true;
        document.getElementById("cancelScore").style.visibility = "hidden";

        var match_id = $(this).data("scd_id");
        //confirm("Are You sure want to delete !");
        var url = '{{ route("match.decrementpoint", ":id") }}';
        url = url.replace(':id', match_id);

        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                console.log(data.scd_id);
                $('#result'+data.scd_id).html('Reject');
                //$('#result' + data.scd_id).html('Finished');
                alert('Sucess');
            },
            error: function(data) {
                console.log('Error:', data);
                alert('Failed');
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).ready(function() {
        $('form#change_name').submit(function(e) {

            //alert('55555');
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('match.update') }}",
                method: "POST",
                data: formData,
                dataType: "JSON",
                success: function(data) {
                    $('#home' + data.scd_id).html(data.com_scoreuser1);
                    $('#away' + data.scd_id).html(data.com_scoreuser2);
                    $('#result' + data.scd_id).html('Waiting');
                    $('#AddStudent').modal('toggle');
                    //alert(data.scd_id+' '+data.div_id+' '+data.com_user1+' '+data.com_scoreuser1+' '+data.com_user2+' '+data.com_scoreuser2);
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

</script>
