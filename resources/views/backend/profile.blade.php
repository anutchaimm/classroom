@extends('layouts.master')

@section('content')
        <!------------------------- Content ------------------------->
        <div id="profile" class="container mt-4 mb-4 pb-4">
            <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12 mb-4 card-profile">
                    <div class="card h-100 shadow-theme border-0  mb-4">
                        <form action="{{route('profile.update', ['id' => $data->user_id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                                <label>
                                    @if($data->prf_imgcover)
                                    <img id="imgOne"  class="card-img-top" src="{{asset('storage')}}/{{$data->prf_imgcover}}">
                                    @else
                                    <img id="imgOne" class="card-img-top" src="{{asset('images/bg_card/meckl-antal-dqaMpjwnvVA-unsplash.jpg')}}">
                                    @endif
                                    <input  type="file"
                                            name="imgcover"
                                            class="input-field @error('imgcover') is-invalid @enderror"
                                            onchange="readerimg(this);"
                                            value="{{ old('imgcover') ?? $data->prf_imgcover }}"
                                            style="display: none;">
                                    <div class="camera">
                                        <i class="fas fa-camera fa-2x"></i>
                                    </div>
                                </label>
                                            @error('imgcover')
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

                                <div class="card-body">
                                    <label>
                                        @if($data->prf_img)
                                        <img id="imgProflie" src="{{asset('storage')}}/{{$data->prf_img}}" class="img_profile">
                                        @else

                                        <img id="imgProflie" src="{{asset('images/user.jpg')}}" class="img_profile">
                                        @endif
                                        <input type="file"
                                                name="imgprofile"
                                                class="input-field"
                                                onchange="imgproflie(this);"
                                                value="{{ old('imgprofile') ?? $data->prf_img }}"
                                                style="display: none;">
                                        <div class="camera-profile ">
                                            <i class="fas fa-camera fa-2x"></i>
                                        </div>
                                    </label>
                                                @error('imgprofile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                    <script type="text/javascript">
                                        function imgproflie(input) {
                                            const imgproflie = new FileReader();
                                            imgproflie.onload = function (e) {
                                                $('#imgProflie').attr('src', e.target.result);
                                            };
                                            imgproflie.readAsDataURL(input.files[0]);
                                        }
                                    </script>
                                    <div class="form-profile">
                                        <div class="form-row">
                                            <div class="col-md-4 col-lg-2 form-group">
                                                <label>คำนำหน้า</label>
                                                <select class="form-control @error('title') is-invalid @enderror" name="title">
                                                @if($data->prf_title)
                                                <option selected>{{$data->prf_title}}</option>
                                                @else
                                                <option selected disabled>คำนำหน้า</option>
                                                @endif
                                                    <option>นาย</option>
                                                    <option>นางสาว</option>
                                                    <option>นาง</option>
                                                </select>
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 col-lg-5 form-group">
                                                <label>ชื่อ *</label>
                                                <input type="text"
                                                class="form-control @error('firstname') is-invalid @enderror"
                                                name="firstname"
                                                placeholder="สมชาย..."
                                                value="{{$data->prf_firstname ?? ''}} ">

                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-lg-5 form-group">
                                                <label>นามสกุล *</label>
                                                <input type="text"
                                                class="form-control @error('lastname') is-invalid @enderror"
                                                name="lastname"
                                                placeholder="รักไทย..."
                                                value="{{$data->prf_lastname  ?? ''}}">

                                                @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            {{-- <div class="col-md-3 col-lg-2 form-group">
                                                <label>เพศ</label>
                                                <select class="form-control">
                                                    <option selected disabled>เพศ</option>
                                                    <option>ชาย</option>
                                                    <option>หญิง</option>
                                                </select>
                                            </div> --}}
                                            <div class="col-md-4 col-lg-4 form-group">
                                                <label>วันเกิด</label>
                                                <input type="date"
                                                        class="form-control @error('birthday') is-invalid @enderror"
                                                        value="{{$data->prf_birthday}}"
                                                        name="birthday">
                                                        @error('birthday')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-6 form-group">
                                                <label>ประเทศ</label>
                                                <input type="text"
                                                        class="form-control @error('country') is-invalid @enderror"
                                                        name="country"
                                                        placeholder="ไทย..."
                                                        value="{{$data->cty_code ?? ''}} ">
                                                        @error('country')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 col-lg-3 form-group">
                                                <label>อาชีพ</label>
                                                <input type="text"
                                                        class="form-control @error('job') is-invalid @enderror"
                                                        value="{{$data->crr_id ?? ''}} "
                                                        name="job"
                                                        placeholder="นักศึกษา...">
                                                        @error('job')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                            </div>
                                            <div class="col-md-4 col-lg-3 form-group">
                                                <label>วุฒิการศึกษา</label>
                                                <select class="form-control @error('graduated') is-invalid @enderror" name="graduated">
                                                    @if($data->grd_id)
                                                    <option selected>{{$data->grd_id}}</option>
                                                    @else
                                                    <option selected disabled>ระดับการศึกษา</option>
                                                    @endif
                                                    <option>มัธยมศึกษาตอนต้น</option>
                                                    <option>มัธยมศึกษาตอนต้นปลาย</option>
                                                    <option>ประกาศนียบัตรวิชาชีพ</option>
                                                    <option>ประกาศนียบัตรวิชาชีพชั้นสูง</option>
                                                    <option>ปริญญาตรี</option>
                                                    <option>ปริญญาโท</option>
                                                    <option>ปริญญาเอก</option>
                                                </select>
                                                @error('graduated')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 col-lg-6 form-group">
                                                <label>สถานศึกษา/ทำงาน</label>
                                                <input type="text"
                                                        class="form-control @error('workplace') is-invalid @enderror"
                                                        name="workplace"
                                                        placeholder="โรงเรียนวัด..."
                                                        value="{{$data->prf_workaddress ?? ''}}">
                                                        @error('workplace')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-5 col-lg-4 form-group">
                                                <label>เบอร์โทร</label>
                                                <input type="text"
                                                        class="form-control @error('telephone') is-invalid @enderror"
                                                        name="telephone"
                                                        placeholder="000-0000000"
                                                        value="{{$data->prf_tel ?? ''}}">
                                                        @error('telephone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                            </div>
                                            <div class="col-md-5 col-lg-4 form-group">
                                                <label>อีเมล</label>
                                                <input type="email" class="form-control" placeholder="email@..." value="{{Auth::user()->email}}" disabled>
                                            </div>
                                            <div class="col-md-5 col-lg-4 form-group">
                                                <label>ช่องทางติดต่ออื่น ๆ</label>
                                                <input type="text"
                                                        class="form-control @error('contact') is-invalid @enderror"
                                                        name="contact"
                                                        placeholder="Facebook ,ID line"
                                                        value=" {{$data->prf_contact ?? ''}}">
                                                        @error('contact')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-right">
                                    <button type="submit" class="btn btn-theme px-5">บันทึก</button>
                                </div>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('mobile-bar')
        <!------------------------- Moblie-bar ------------------------->
        <div class="d-block d-lg-none moblie-bar p-2">
            <div class="container-fluid text-center">
                <div class="row row-cols-4">
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
