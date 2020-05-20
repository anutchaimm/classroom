@extends('layouts.master')

@section('nav')
    <li class="nav-item mr-3 pt-1">
        <a class="nav-link active" href="{{ route('classroom.show', ['id' => $id]) }}">
            <i class="fas fa-graduation-cap pr-2"></i>
            Strem</a>
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
                                            <a href="{{asset('storage')}}/{{$friends->prf_imgcover}}"><img id="imgOne"  class="card-img-top" src="{{asset('storage')}}/{{$friends->prf_imgcover}}"></a>
                                            @else
                                                <img id="imgOne" class="card-img-top" src="{{asset('images/bg_card/meckl-antal-dqaMpjwnvVA-unsplash.jpg')}}">
                                            @endif
                                            <div class="img_member mx-auto mb-2">
                                                @if($friends->prf_img)
                                                <a href="{{asset('storage')}}/{{$friends->prf_img}}"><img id="imgProflie" src="{{asset('storage')}}/{{$friends->prf_img}}" class="member-pairing"></a>
                                                @else
                                                <img id="imgProflie" src="{{asset('images/user.jpg')}}" class="member-pairing">
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
                                                    <a id="btn" role="button" data-myid="{{Auth::user()->id}}" data-user_id="{{$friends->user_id}}" data-cls_id="{{$friends->cls_id}}" data-status="Like" class="btn btn-primary text-white rounded-0 confirmLike"><i
                                                        class="far fa-thumbs-up"></i> like</a>
                                                    <a id="btn" role="button" data-myid="{{Auth::user()->id}}" data-user_id="{{$friends->user_id}}" data-cls_id="{{$friends->cls_id}}" data-status="Unlike" class="btn btn-danger text-white rounded-0 cancelLike"><i
                                                        class="far fa-thumbs-down"></i> unlike</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
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
            var match_id = $(this).data("user_id");
            $('#success_img'+match_id).remove(".success_img");
        });
    });

    $(document).on('click', '.confirmLike', function () {
            event.preventDefault();
            var $post = {};
            $post.clsid = $(this).data("cls_id");
            $post.myid = $(this).data("myid");
            $post.friendid = $(this).data("user_id");
            $post.status = $(this).data("status");
            $post._token = document.getElementsByName("_token")[0].value
            $.ajax({
                url: '{{ route('pairing.edit') }}',
                type: 'POST',
                data: $post,
                dataType: "JSON",
                cache: false,
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    alert('error handing here');
                    console.log(data);
                }
            });
    });

    $(document).on('click', '.cancelLike', function () {
            // alert('666');
            // var match_id = $(this).data("user_id");
            // $post.species = $('#species').val();
            // $post.ocheck = ($("#ocheck").prop("checked") == true ? '1' : '0');
            event.preventDefault();
            var $post = {};
            $post.clsid = $(this).data("cls_id");
            $post.myid = $(this).data("myid");
            $post.friendid = $(this).data("user_id");
            $post.status = $(this).data("status");
            // TODO ตรงนี้สำคัญมาก เพราะถ้าไม่ทำแบบนี้จะไม่มี Token ติดมาด้วย
            $post._token = document.getElementsByName("_token")[0].value
            $.ajax({
                url: '{{ route('pairing.edit') }}',
                type: 'POST',
                data: $post,
                dataType: "JSON",
                cache: false,
                success: function (data) {
                   // $('#success_img').remove();
                   // return data;
                   // alert(data._token);
                   // console.log(data);
                },
                error: function (data) {
                    alert('error handing here');
                    console.log(data.error);
                }
            });
    });

</script>
