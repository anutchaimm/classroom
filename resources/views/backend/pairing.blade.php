@extends('layouts.master')

@section('nav')
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link active" href="{{ route('classroom.show', ['id' => $id]) }}">
            <i class="fas fa-graduation-cap pr-2"></i>
            Steam</a>
    </li>
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link" href="{{ route('schedule.show', ['id' => $id]) }}">
            <i class="fas fa-list-ul pr-2"></i>
            Schedule</a>
    </li>
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link" href="{{ route('leaderboard.show', ['id' => $id]) }}">
            <i class="fas fa-chart-line pr-2"></i>
            LeaderBoard</a>
    </li>
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link" href="{{ route('pairing.show', ['id' => $id]) }}">
            <i class="far fa-heart pr-2"></i>
            Paring</a>
    </li>
@stop

@section('content')
            <!------------------------- Content ------------------------->
            <div class="container mt-4 mb-4 pb-4">
                <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
                <div class="row justify-content-md-center">

                    <div class="col-md-4">
                        <div id="pairing" class="row">
                            <div id="multiple-carousel" class="col mb-4 owl-carousel owl-theme paring_carousel">

                                @foreach ($friend as $friends)
                                    @if($userid <> Auth::user()->id or $user_zone <> $friends->zone and $friends->match <> 1)
                                        <div id="success_img{{$friends->user_id}}" class="card h-100 border-0 shadow-theme success_img">
                                            @if($friends->prf_imgcover)
                                            <a href="{{asset('storage')}}/{{$friends->prf_imgcover}}"><img  class="card-img-top" src="{{asset('storage')}}/{{$friends->prf_imgcover}}"></a>
                                            @else
                                                <img  class="card-img-top" src="{{asset('images/bg_card/meckl-antal-dqaMpjwnvVA-unsplash.jpg')}}">
                                            @endif
                                            <div class="img_member mx-auto mb-2">
                                                @if($friends->prf_img)
                                                <a href="{{asset('storage')}}/{{$friends->prf_img}}"><img  src="{{asset('storage')}}/{{$friends->prf_img}}" class="member-pairing"></a>
                                                @else
                                                <img  src="{{asset('images/user.jpg')}}" class="member-pairing">
                                                @endif
                                            </div>
                                            <div class="card-body text-center mt-4">
                                                <h5 class="card-title mt-4"><i class="fas fa-tag"></i> {{$friends->prf_firstname ?? '-'}} {{$friends->prf_lastname ?? ''}}</h5>
                                                <h6><i class="fas fa-address-book"></i>
                                                <strong>สถานศึกษา</strong>
                                                {{$friends->prf_workaddress ?? '-'}}</h6>
                                                <h6><i class="fas fa-birthday-cake"></i>
                                                    <strong>วันเกิด</strong>
                                                    {{$friends->prf_birthday ?? '-'}}</h6>
                                                <h6><i class="fas fa-school pr-1"></i>
                                                    <strong>ระดับการศึกษา</strong>
                                                    {{$friends->grd_id ?? '-'}}</h6>
                                                <h6><i class="fas fa-medal"></i>
                                                    <strong>ตารางคะแนน</strong>
                                                    {{$friends->div_usr_rank ?? '-'}}</h6>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a role="button" data-toggle="modal"
                                                    data-target="#Modallike"
                                                    data-myid="{{Auth::user()->id}}"
                                                    data-name="{{$friends->prf_firstname}}"
                                                    data-user_id="{{$friends->user_id}}"
                                                    data-cls_id="{{$friends->cls_id}}"
                                                    data-status="Like"
                                                    class="btn btn-primary text-white rounded-0 edit-modal">
                                                    <i class="far fa-thumbs-up"></i> like</a>

                                                    <a role="button" data-toggle="modal"
                                                    data-target="#Modalunlike"
                                                    data-myid="{{Auth::user()->id}}"
                                                    data-name="{{$friends->prf_firstname}}"
                                                    data-user_id="{{$friends->user_id}}"
                                                    data-cls_id="{{$friends->cls_id}}"
                                                    data-status="Unlike"
                                                    class="btn btn-danger text-white rounded-0 edit-modalunlike">
                                                    <i class="far fa-thumbs-down"></i> Unlike</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="owl-navigation">
                    <span class="owl-nav-prev"><i class="fas fa-long-arrow-alt-left"></i></span>
                    <span class="owl-nav-next"><i class="fas fa-long-arrow-alt-right"></i></span>
                </div>
                    </div>
                </div>
            </div>
@stop
@section('modal')
    <!-- Modal Like -->
    <div class="modal fade" id="Modallike" tabindex="-1" role="dialog" aria-labelledby="ModallikeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModallikeLabel">การแจ้งเตือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                คุณต้องการเป็นเพือนกับ <span id="name" style="color:red;">{{$friends->prf_firstname }}</span> ใช่หรือไม่?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" id="btn" data-myid="{{Auth::user()->id}}" data-user_id="{{$friends->user_id}}" data-cls_id="{{$friends->cls_id}}" data-status="Like" type="button" class="btn btn-theme confirmLike">ยืนยัน</button>
            </div>
            </div>
        </div>
    </div>
    {{-- Modal Unlike --}}
    <div class="modal fade" id="Modalunlike" tabindex="-1" role="dialog" aria-labelledby="ModalunlikeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModallikeLabel">การแจ้งเตือน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                คุณไม่ต้องการเป็นเพือนกับ <span id="nameunlike" style="color:red;">{{$friends->prf_firstname }}</span> ใช่หรือไม่?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" id="btn" data-myid="{{Auth::user()->id}}" data-user_id="{{$friends->user_id}}" data-cls_id="{{$friends->cls_id}}" data-status="UnLike" type="button" class="btn btn-theme cancelLike">ยืนยัน</button>
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

    $(document).ready(function(){
        $("a.btn").click(function(){
              window.match_id = $(this).data("user_id");
          //  $('#success_img'+match_id).remove(".success_img");
        });
    });

    $(document).on('click', '.edit-modal', function() {
            // เก็บค่ามาใส่ Window form clsid
            window.clsid = $(this).data("cls_id");
            window.myid = $(this).data("myid");
            window.friendid = $(this).data("user_id");
            window.status = $(this).data("status");
            window._token = document.getElementsByName("_token")[0].value;
            $('#name').html($(this).data('name'));
            // console.log('Classroom: '+window.clsid);
            // console.log('MyId: '+window.myid);
            // console.log('FrindId: '+window.friendid);
            // console.log('Status: '+window.status);
    });

    $(document).on('click', '.edit-modalunlike', function() {
            // เก็บค่ามาใส่ Window form clsid
            window.clsid = $(this).data("cls_id");
            window.myid = $(this).data("myid");
            window.friendid = $(this).data("user_id");
            window.status = $(this).data("status");
            window._token = document.getElementsByName("_token")[0].value;
            $('#nameunlike').html($(this).data('name'));
            // console.log('Classroom: '+window.clsid);
            // console.log('MyId: '+window.myid);
            // console.log('FrindId: '+window.friendid);
            // console.log('Status: '+window.status);
    });

    $(document).on('click', '.confirmLike', function () {
        //console.log(window._token);
        event.preventDefault();
        var $post = {};
        $post.clsid = window.clsid;
        $post.myid =  window.myid;
        $post.friendid = window.friendid;
        $post.status = window.status;
        $post._token = window._token;

        $.ajax({
            url: '{{ route('pairing.edit') }}',
            type: 'POST',
            data: $post,
            dataType: "JSON",
            cache: false,
            success: function (data) {
                console.log(data);
                $('#Modallike').modal('toggle');
                $('#success_img'+window.match_id).remove(".success_img");
            },
            error: function (data) {
                alert('error handing here');
                console.log(data);
            }
        });
    });

    $(document).on('click', '.cancelLike', function () {
        event.preventDefault();
        var $post = {};
        $post.clsid = window.clsid;
        $post.myid =  window.myid;
        $post.friendid = window.friendid;
        $post.status = window.status;
        // TODO ตรงนี้สำคัญมาก เพราะถ้าไม่ทำแบบนี้จะไม่มี Token ติดมาด้วย
        $post._token = window._token;

        $.ajax({
            url: '{{ route('pairing.edit') }}',
            type: 'POST',
            data: $post,
            dataType: "JSON",
            cache: false,
            success: function (data) {
                console.log(data);
                $('#Modalunlike').modal('toggle');
                $('#success_img'+window.match_id).remove(".success_img");
            },
            error: function (data) {
                alert('error handing here');
                console.log(data);
            }
        });
    });

</script>
