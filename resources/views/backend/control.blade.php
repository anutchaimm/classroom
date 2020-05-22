@extends('layouts.master')

@section('nav')
            <li class="nav-item mr-3">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#NewClassroom">
                    <i class="fas fa-plus fa-lg pt-2 pr-2"></i>
                    New Classroom</a>
            </li>
            <li class="nav-item mr-3 pt-1">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#JoinClassroom">
                    <i class="fas fa-sign-in-alt fa-lg pr-2"></i>
                    Join Classroom</a>
            </li>
@stop

@section('content')

            <!------------------------- Content ------------------------->
            <div class="container-fluid mt-4 mb-4 pb-4">
                <img class="bg-dashboard" src="images/Rectangle/wave_2.svg" alt="">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">

                {{-- TODO ขั้นตอนแกะ Array 2 ชั้น --}}
                @foreach ($classroom as $class)
                        {{-- @foreach ($item ?? '' as $class) --}}
                        <div class="col mb-4">
                            <a href="{{ route('classroom.show', ['id' => $class->classroomname->cls_id]) }}">
                                <div class="card card-classroom h-100 shadow-theme border-0">

                                        @if($class->imgcover)
                                            <img src="{{asset('storage')}}/{{$class->imgcover}}" class="card-img-top" alt="...">
                                        @else
                                            <img src="{{asset('images/bg_card/etienne-bosiger-WTkUYzNCu-A-unsplash.jpg')}}" class="card-img-top" alt="...">
                                        @endif

                                    <div class="card-body">
                                        <h5 class="card-title">{{$class->classroomname->cls_name}}</h5>
                                            @if($class->imgowner)
                                                <img src="{{asset('storage')}}/{{$class->imgowner}}" class="card_teacher">
                                            @else
                                                <img src="images/img1.jpg" class="card_teacher">
                                            @endif
                                        <p class="card-text">{{$class->classroomname->cls_subject}}</p>
                                    </div>
                                    <div class="card-footer clearfix bg-blue">
                                        <small class="text-white float-left"><i class="fas fa-book"></i> {{$class->classroomname->cls_level}}</small>
                                        <small class="text-white float-right"><i class="fas fa-graduation-cap"></i> {{$class->total}}
                                            students</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- @endforeach --}}
                    @endforeach
                </div>
            </div>
@stop

@section('modal')

    <!------------------------- Modal New Classroom ------------------------->
    <div class="modal fade" id="NewClassroom" tabindex="-1" role="dialog" aria-labelledby="NewClassroom"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="NewClassroom">Create Classroom</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <form action="{{route('control.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row form-group">
                            <div class="col-7">
                                <input type="text" name="name" class="form-control" placeholder="ชื่อห้อง" required>
                            </div>
                            <div class="col-5">
                                <input type="text" name="level" class="form-control" placeholder="ระดับชั้น" required>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-8">
                                <input type="text" name="subject" class="form-control" placeholder="ชื่อวิชา" required>
                            </div>
                            <div class="col-4">
                                <select name="term" class="form-control @error('term') is-invalid @enderror" required>
                                    <option selected disabled>ภาคเรียน</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="0">ไม่กำหนด</option>
                                </select>
                                @error('term')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col-4">
                                <input name="week" type="number" class="form-control" placeholder="สัปดาห์" required>
                            </div>
                            <div class="col-8">
                                <select name="type" class="form-control @error('type') is-invalid @enderror" id="">
                                    <option selected disabled>เลือกรูปแบบการสอน</option>
                                    @foreach ($method as $item)
                                            <option value="{{$item->cls_type}}"
                                                @if($item->clst_status <> "Available" )
                                                disabled
                                                @endif
                                                >
                                                {{$item->clst_name}}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="col-12">
                                <div class="form-check custom-control custom-checkbox ml-1">
                                    <input type="checkbox" class="custom-control-input" id="Checks" name="Checks"
                                        onchange="CheckFunction()">
                                    <label class="custom-control-label" for="Checks">Pretest</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="nick" style="display: none;">
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="customFile" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-theme">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!------------------------- Modal Join Classroom ------------------------->
    <div class="modal fade" id="JoinClassroom" tabindex="-1" role="dialog" aria-labelledby="JoinClassroom"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="JoinClassroom">Join Classroom</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <form action="{{route('control.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row form-group">
                            <div class="col-8">
                                <input type="text" name="code" class="form-control" placeholder="code" required>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-block btn-outline-theme">Join</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('mobile-bar')

        <!------------------------- Moblie-button ------------------------->
        <button class="btn btn-theme moblie-button d-lg-none d-block rounded-circle" data-toggle="modal"
            data-target="#NewClassroom">
            <i class="fas fa-plus"></i>
        </button>
        <!------------------------- Moblie-bar ------------------------->
        <div class="d-block d-lg-none moblie-bar p-2">
            <div class="container-fluid text-center">
                <div class="row row-cols-5">
                    <div class="col">
                        <a class="list-moblie" href="{{ route('control')}}">
                            <i class="fas fa-home"></i>
                            <small class="d-block">Home</small>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('profile.show', ['id' => Auth::user()->id]) }}" class="list-moblie">
                            <i class="fas fa-portrait"></i>
                            <small class="d-block">Proflie</small>
                        </a>
                    </div>
                    <div class="col">
                        <a class="list-moblie"  href="#" data-toggle="modal" data-target="#JoinClassroom" >
                            <i class="fas fa-search"></i>
                            <small class="d-block"> Join</small>
                        </a>
                    </div>
                    <div class="col">
                        <a class="list-moblie" href="{{ route('chat') }}" >
                            <i class="fas fa-user-friends"></i>
                            <small class="d-block"> Pairing</small>
                        </a>
                    </div>
                    <div class="col">
                        <a class="list-moblie" href="{{ route('logout') }}"onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <small class="d-block"> Logout</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
@stop

