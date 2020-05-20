@extends('layouts.master')

@section('nav')
@stop
@section('content')
<!------------------------- Content ------------------------->
<div class="container mt-4 mb-4 pb-4">
    <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
    <div class="row">

        <div class="col-lg-12">
            <a href="#">
                <a class="m-0" href="{{ route('classroom.show', ['id' => $content->cls_id]) }}">
                    <i class="fas fa-arrow-left text-white fa-sm pr-2" style="font-size: 24px;"></i>
                </a>
            </a>
            <div class="text-right text-white">
                {{$createdates ?? ''}}
            </div>
            <div class="card mb-4 border-0 shadow-theme">
                <div class="card-header clearfix bg-blue">
                    <div class="float-left post">

                        @if($content->profile->prf_img)
                        <img src="{{asset('storage')}}/{{$content->profile->prf_img}}" class="avatar-haeding"> <span class="text-white">{{$content->profile->prf_firstname}} {{$content->profile->prf_lastname}}</span>
                        @else
                        <img src="{{asset('images/user.jpg')}}" class="avatar-haeding"> <span class="text-white">{{$content->profile->prf_firstname}}
                            {{$content->profile->prf_lastname}}</span>
                        @endif

                    </div>
                    <div class="float-right">
                        <small class="text-white pr-2 d-inline">{{$updatedates ?? ''}}</small>
                        <div class="dropdown d-inline dropdown_post">

                        </div>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <h3>{{$content->con_content}}</h3>
                    <h6 class="m-0 mt-4">ความคิดเห็นทั้งหมด ({{$content->classroomcomment->count()}})</h6>
                </div>
                @foreach ($comment as $comments)
                <div class="card-footer bg-white pl-4 pr-4">
                    <div class="d-flex mb-4">
                        <div class="mr-3">
                            @if($comments->prf_img)
                            <img src="{{asset('storage')}}/{{$comments->prf_img}}" class="avatar-comment">
                            @else
                            <img src="{{asset('images/user.jpg')}}" class="avatar" alt="Avatar">
                            @endif
                        </div>
                        <div class="d-inline w-100">
                            <span class="d-block font-weight-bold">
                                {{$comments->prf_firstname}} {{$comments->prf_lastname}}
                            </span>
                            <span class="d-block">
                                {{$comments->cmt_message}}
                            </span>
                            <span class="d-block">
                                <small class="text-muted">
                                    {{$comments->updated_at}}
                                </small>
                            </span>
                        </div>
                        @can ('delete', $comments->user->profile)
                        <div class="d-inline">
                            <a href="{{route('comment.destroy', ['id' => $comments->cmt_id])}}" class="delete-comment">
                                <small>
                                    <i class="fas fa-trash"></i>
                                </small>
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
                @endforeach

                <div id="cardcomment"></div>

                <div class="card-footer bg-white pl-4 pr-4">
                    <div class="d-flex">
                        <div class="mr-3">
                            @if(Auth::user()->profile->prf_img)
                            <img src="{{asset('storage')}}/{{Auth::user()->profile->prf_img}}" class="avatar" alt="Avatar">
                            @else
                            <img src="{{asset('images/user.jpg')}}" class="avatar" alt="Avatar">
                            @endif
                        </div>
                        <form id="change_name" class="d-block w-100">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" id="txt_comment" name="comment" class="form-control rounded-pill" placeholder="comment..." aria-label="comment..." aria-describedby="button-comment" required>
                            </div>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success" id="button-comment"> <i class="fas fa-pen"></i> ส่งข้อความ</button>
                            </div>
                        </form>
                    </div>
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

    $(document).ready(function() {
        $('#change_name').submit(function(e) {

            e.preventDefault();
            var formData = new FormData(this);
            formData.append('user_id', '{{Auth::user()->profile->user_id}}');
            formData.append('con_id', '{{$content->con_id}}');
            $.ajax({
                url: "{{ route('comment.store') }}",
                method: "POST",
                data: formData,
                dataType: "JSON",
                success: function(data) {
                    var image = "{{asset('storage')}}/{{Auth::user()->profile->prf_img}}";
                    var fullname = "{{Auth::user()->profile->prf_firstname}}" + " {{Auth::user()->profile->prf_lastname}}";
                    var link = ""
                    $('#cardcomment').append("<div class='card-footer bg-white pl-4 pr-4' id='cardcomment'><div class='d-flex mb-4'><div class='mr-3'><img src='" + image + "' class='avatar-comment'></div><div class='d-inline w-100'><span class='d-block font-weight-bold'>" + fullname + "</span><span class='d-block'>" + data.comment + "</span><span class='d-block'><small class='text-muted'>" + "1 seconds ago" + "</small></span></div><div class='d-inline'><a href='#' class='delete-comment'><small><i class='fas fa-trash'></i></small></a></div></div></div>");
                    //alert(fullname);
                    $('#txt_comment').val('');
                },
                error: function(data) {
                    $('#danger_img').removeClass('d-none');
                    $('#danger_img').html(data.responseJSON.error);
                },
                cache: false,
                contentType: false,
                processData: false
            });

        });
    });
</script>


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
