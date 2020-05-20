@extends('layouts.master')

@section('nav')
            <li class="nav-item mr-3 pt-1">
                <a class="nav-link active" href="{{ route('classroom.show', ['id' => $id->cls_id]) }}">
                    <i class="fas fa-graduation-cap pr-2"></i>
                    Strem</a>
            </li>
            <li class="nav-item mr-3 pt-1">
                <a class="nav-link" href="{{ route('schedule.show', ['id' => $id->cls_id]) }}">
                    <i class="fas fa-list-ul pr-2"></i>
                    Schedule</a>
            </li>
            <li class="nav-item mr-3 pt-1">
                <a class="nav-link" href="{{ route('leaderboard.show', ['id' => $id->cls_id]) }}">
                    <i class="fas fa-chart-line pr-2"></i>
                    LeaderBoard</a>
            </li>
            <li class="nav-item mr-3 pt-1">
                <a class="nav-link" href="{{ route('pairing.show', ['id' => $id->cls_id]) }}">
                    <i class="far fa-heart pr-2"></i>
                    Paring</a>
            </li>
@stop

@section('content')
    <!------------------------- Content ------------------------->
    <div id="room" class="container-fluid mt-4 mb-4 pb-4">
        <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
        <div class="row">

            <div class="col-xl-1">
            </div>

            <div class="col-lg-8 col-xl-8">
                <div class="card card_heading mb-4 border-0 shadow-theme">

                    @if($id->cls_img)
                        <img class="card_bg" src="{{asset('storage')}}/{{$id->cls_img}}">
                    @else
                        <img class="card_bg" src="{{asset('images/bg_card/etienne-bosiger-WTkUYzNCu-A-unsplash.jpg')}}">
                    @endif

                    <div class="card-body">
                        <h1 class="display-4 font-weight-light">{{$id->cls_name}}</h1>
                        <h4 class="card-text">{{$id->cls_level}}</h4>
                        <h5 class="card-text code">CODE : {{$id->cls_code}}</h5>
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

                @can ('update', $owner->profile)
                    <div class="row">
                        <div class="col owl-carousel owl-theme week_carousel">
                            <div class="card mb-4 list-weeks active">
                                <div class="card-body p-0">
                                    <span class="text-uppercase">
                                        <a class="nav-link edit-classroom" href="#" data-toggle="modal" data-target="#Setting">
                                            <i class="far fa-calendar-alt fa-lg"></i>
                                        Setting</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="row">
                    <div class="col-xl-10 mx-auto">
                        <div class="accordion d-lg-block d-none" id="accordionPost">
                            <div class="card mb-4 border-0 shadow-theme card-radius">
                                <div class="card-header bg-white" id="Postheading">
                                    <h5 class="mb-0">
                                        <a href="#" class="link_post text-uppercase" data-toggle="collapse"
                                            data-target="#Post" aria-expanded="true" aria-controls="Post">
                                            <i class="far fa-edit"></i> Share Content
                                        </a>
                                    </h5>
                                </div>

                                <div id="Post" class="collapse show" aria-labelledby="Postheading"
                                    data-parent="#accordionPost">
                                    <div class="card-body">
                                        <form action="{{route('content.update', ['id' => $id->cls_id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-group">
                                                    <textarea class="form-control"
                                                        placeholder="Share something with your class..."
                                                        name="description"
                                                        id="" rows="4"
                                                        required>
                                                    </textarea>
                                                </div>

                                                <div class="form-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="customfile" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                </div>

                                                <div class="clearfix pt-2">
                                                    <div class="float-right">
                                                        <button type="submit"
                                                            class="btn btn-theme rounded px-5 btn-block text-uppercase"><i
                                                                class="fas fa-pen"></i>
                                                            Post</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($post as $posts)
                        <div class="col-xl-10 mx-auto">
                            <div class="text-right">
                                {{$posts->created_at}}
                            </div>
                            <div class="card mb-4 border-0 shadow-theme card-room card-radius">
                                <div class="card-header clearfix bg-blue">
                                    <div class="float-left post">
                                        @if($posts->prf_img)
                                            <img src="{{asset('storage')}}/{{$posts->prf_img}}" class="avatar-haeding"> <span
                                                class="text-white">{{$posts->prf_firstname}}
                                                {{$posts->prf_lastname}}</span>
                                        @else
                                            <img src="{{asset('images/user.jpg')}}" class="avatar-haeding"> <span
                                                class="text-white">{{$posts->prf_firstname}}
                                                {{$posts->prf_lastname}}</span>
                                        @endif
                                    </div>
                                    <div class="float-right">
                                        <small class="text-white pr-2 d-inline">{{$posts->updated_at}}</small>
                                        <div class="dropdown d-inline dropdown_post">

                                            @can ('update', $posts->user->profile)
                                            {{-- ต้องส่งตาราง Profile เท่านั้น ไม่รู้ทำไหมเหมือนกัน --}}
                                            <a href="#" class="link_icon" id="dropdownPost" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                                <div class="dropdown-menu dropdown-menu-right animate slideIn border-0 shadow"
                                                    aria-labelledby="dropdownPost">
                                                    <a class="dropdown-item edit-modal"
                                                    data-id="{{$posts->con_id}}"
                                                    data-title="{{$posts->con_content}}"
                                                    data-file="{{$posts->con_originalname}}">
                                                    <i class="far fa-edit pr-1"></i>แก้ไข</a>
                                                    <a class="dropdown-item" href="{{route('content.destroy', ['id' => $posts->con_id])}}"><i class="fas fa-trash pr-1"></i>
                                                        ลบ</a>
                                                </div>
                                            @endcan

                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('content.show', ['id' => $posts->con_id])}}">
                                    <div class="card-body mt-3">
                                        <div id="item{{$posts->con_id}}">
                                                <h5>{{$posts->con_content}}</h5>
                                                @if($posts->con_file)
                                                    <a href="{{asset('storage')}}/{{$posts->con_file}}"><i class="far fa-file-archive"></i> Download</a>
                                                @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4 col-xl-3 d-none d-lg-block">
                <div class="card border-0 shadow-theme mb-4">
                    <div class="card-header bg-white">
                        <h4 class="m-0 text-theme">ผลงานชั้นเรียน</h4>
                    </div>
                    <div class="card-body mx-auto">
                        <div id="svgcontainer">
                            <svg height="300" width="300" id="svg">
                                <circle id="progressbg" cx="150" cy="150" r="120" stroke-width="29"
                                    fill="transparent" stroke-dasharray="753.9822368615503" />
                                <circle id="progress" cx="150" cy="150" r="120" stroke-width="30"
                                    fill="transparent" stroke-dasharray="753.9822368615503" />
                            </svg>
                            <div id="slidervalue"></div>
                        </div>
                        <input type="range" id="slider" min="0" max="100" value="100">
                    </div>
                    <div class="d-block">
                        <a href="#" class="btn btn-theme btn-block">ดูทั้งหมด</a>
                    </div>
                </div>

                <div class="card border-0 shadow-theme mb-4" id="list-team">
                    <div class="card-header bg-white">
                        <h4 class="m-0 text-theme">Member</h4>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($member as $item)
                            <li class="list-group-item clearfix border-0 success_img" id="success_img{{$item->user_id}}">
                                    <div class="float-left">
                                        @if(is_null($item->prf_img))
                                            <img src="{{asset('images/user.jpg')}}" class="avatar" alt="Avatar">
                                        @else
                                            <img src="{{asset('storage')}}/{{$item->prf_img}}" class="avatar mr-2">
                                        @endif
                                    <span>{{$item->prf_firstname}} {{$item->prf_lastname}}</span>
                                    </div>
                                    @can ('update', $owner->profile)
                                        @if($item->user_id <> Auth::user()->id)
                                            <div class="float-right">
                                                <span>
                                                    <button class="btn btn-danger btn-sm rounded-circle delete-modal" data-toggle="modal" data-name="{{$item->prf_firstname}} {{$item->prf_lastname}}" data-user_id="{{$item->user_id}}">
                                                        <i class="fas fa-times p-1"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        @else
                                            <div class="float-right">
                                                <span>
                                                    <button class="btn btn-primary btn-sm rounded-circle">
                                                        <i class="fas fa-lock p-1"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        @endif
                                    @endcan
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

    <!-- Modal Edit Post -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
                <div class="modal-content">
                    <form id="change_name" class="form-horizontal" role="form">
                        @csrf
                            <div class="modal-body">
                                    <div class="card-header bg-white" id="Postheading">
                                        <h5 class="mb-0">
                                            <a href="#" class="link_post text-uppercase" data-toggle="collapse"
                                                data-target="#Post" aria-expanded="true" aria-controls="Post">
                                                <i class="far fa-edit"></i> Share Content
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id" class="form-control" id="fid">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control"
                                            placeholder="Share something with your class..."
                                            name="content"
                                            id="t" rows="4"
                                            required>
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="customfile">
                                            <label class="custom-file-label" id="d" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn actionBtn" >
                                            <span id="footer_action_button" class='glyphicon'></span>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                                            <span class='glyphicon glyphicon-remove'></span> Close
                                        </button>
                                    </div>
                            </div>
                    </form>
                </div>
        </div>
    </div>

    <!-- Modal Del Team -->
    <div class="modal fade" id="exampleDelteam" tabindex="-1" role="dialog" aria-labelledby="exampleDelteamLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleDelteamLabel">ตั้งค่าทีม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-plus"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="userid" id="userid" aria-describedby="helpId" placeholder="">
                    </div>
                    คุณต้องการลบสมาชิก <span class="text-danger DimensionList" id="membername">"ชื่อเพือน"</span> ออกจากห้องเรียนใช่หรือไม่
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger deleteMember">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!------------------------- Modal Setting Classroom ------------------------->
    <div class="modal fade" id="Setting" tabindex="-1" role="dialog" aria-labelledby="Setting"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('classroom.update', ['id' => $id->cls_id])}}" method="post" enctype="multipart/form-data" role="form">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="Setting">Setting Classroom</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>

                    <label>
                        @if($id->cls_img)
                            <img id="imgOne" class="card-img-top" src="{{asset('storage')}}/{{$id->cls_img}}">
                        @else
                            <img id="imgOne" class="card-img-top" src="{{asset('images/bg_card/etienne-bosiger-WTkUYzNCu-A-unsplash.jpg')}}">
                        @endif

                        <input  type="file"
                                name="cls_image"
                                class="input-field @error('cls_image') is-invalid @enderror"
                                onchange="readerimg(this);"
                                value="{{ old('cls_image')}}"
                                style="display: none;">
                        <div class="camera mx-auto">
                            <i class="fas fa-camera fa-2x"></i>
                        </div>
                    </label>
                                @error('cls_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <script type="text/javascript">
                        function readerimg(input) {
                            const readerimg = new FileReader();
                            readerimg.onload = function (e) {
                                $('#imgOne').attr('src', e.target.result);
                            };
                            readerimg.readAsDataURL(input.files[0]);
                        }
                    </script>
                    <div class="modal-body">
                        <div class="form-row form-group">
                            <div class="col-7">
                            <input type="text" class="form-control" placeholder="ชื่อห้อง" name="cls_name" value="{{$id->cls_name}}" required>
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control" placeholder="ระดับชั้น" name="cls_level" value="{{$id->cls_level}}" required>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="ชื่อวิชา" name="cls_subject" value="{{$id->cls_subject}}" required>
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="cls_term" required>

                                    @if($id->cls_term)
                                        <option selected>{{$id->cls_term}}</option>
                                    @else
                                        <option selected disabled>ภาคเรียน</option>
                                    @endif
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="0">ไม่กำหนด</option>
                                    </select>

                                </select>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="สัปดาห์" name="cls_week" value="{{$id->cls_duration}}" required>
                            </div>
                            <div class="col-8">
                                <select class="form-control" name="cls_type" required>

                                    @if($id->cls_type)
                                    <option selected value="{{$id->cls_type}}">{{$id->classroomtype->clst_name}}</option>
                                    @else
                                        <option selected disabled>เลือกรูปแบบการสอน</option>
                                    @endif

                                    <option value="2">Traditional</option>
                                    <option value="1">League Learning</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-outline-theme">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        // Edit Data (Modal and function edit data)
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
            $('#t').val($(this).data('title'));
            $('#d').html($(this).data('file'));
            // การกำหนดค่าตัวแปร
            $('#myModal').modal('show');
            // การแสดงค่า
        });

        // เปลี่ยนเนื้อหา
        $('form#change_name').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('cls_id', '{{ $id->cls_id }}');
            $.ajax({
                url:"{{ route('content.edit') }}",
                method: "POST",
                data:formData,
                dataType: "JSON",
                success: function(data){
                    $('#item'+data.id).replaceWith("<div id='item"+data.id +"'><h5>"+data.content+"</h5><a href='#'><i class='far fa-file-archive'></i> Download</a></div>");
                    $('#myModal').modal('toggle');
                },
                error: function(data){
                    $('#danger_name').removeClass('d-none');
                    $('#danger_name').html(data.responseJSON.error);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

            // Delete Member
        $(document).on('click', '.delete-modal', function() {
            // การสั่งให้คลาส แสดงขึ้นมา เพื่อให้มันมา Form ในการส่งข้อมูล// userid
            $('#userid').val($(this).data('user_id'));
            $('.DimensionList').text($(this).data('name'));
            $('#exampleDelteam').modal('show');
        });

        $(document).on('click', '.deleteMember', function () {
            //Get
            var user_id = $('#userid').val();
            //Set
            //$('#txt_name').val(bla);

            event.preventDefault();
            var $post = {};
            $post.user_id = user_id;
            $post._token = document.getElementsByName("_token")[0].value;

            $.ajax({
                url: '{{ route('classroomuser.destroy') }}',
                type: 'POST',
                data: $post,
                dataType: "JSON",
                cache: false,
                success: function (data) {
                    //alert('success handing here');
                    console.log(data);
                    $('#success_img'+data.user_id).remove(".success_img");
                    $('#exampleDelteam').modal('toggle');
                },
                error: function (data) {
                    alert('error handing here');
                    console.log(data);

                }
            });
    });
</script>
