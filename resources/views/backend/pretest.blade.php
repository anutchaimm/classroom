<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Classroom</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Css Style -->
    <link rel="stylesheet" href="{{asset('css/style1.css')}}">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

    <!-- animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

</head>

<body id="dashboard">

    <div class="wrapper">
        <div id="content">

            <!------------------------- Content ------------------------->
            <div class="container mt-4 mb-4 pb-4">
                <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
                <div class="card border-0 shadow-theme mb-3">
                    <div class="card-body ">
                        <h4 class="m-0">
                            {{$pretest->pt_name}}
                        </h4>
                    </div>
                </div>

                <form action="{{route('exam.update', ['id' => $pretest->pt_id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach ($pretest->exam as $key => $item)
                        <div class="card border-0 shadow-theme mb-3">
                            <div class="card-header clearfix bg-white">
                                <h4 class="m-0 float-left">
                                    <span class="badge badge-theme pr-3 pl-3 pt-2 pb-2">
                                        {{$key+1}}
                                    </span>
                                    {{$item->exm_question}}
                                </h4>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-12 card p-3 mb-1">
                                        <div class="row mt-3">
                                            <div class="col-lg-10">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio{{$item->exm_id}}1" name="customRadio[{{$item->exm_id}}]" class="custom-control-input" value="1" checked>
                                                    <label class="custom-control-label" for="customRadio{{$item->exm_id}}1">1. {{$item->exm_choice_1}}</label>
                                                </div>
                                                <div class="custom-control custom-radio mt-3">
                                                    <input type="radio" id="customRadio{{$item->exm_id}}2" name="customRadio[{{$item->exm_id}}]" class="custom-control-input" value="2">
                                                    <label class="custom-control-label" for="customRadio{{$item->exm_id}}2">2. {{$item->exm_choice_2}}</label>
                                                </div>
                                                <div class="custom-control custom-radio mt-3">
                                                    <input type="radio" id="customRadio{{$item->exm_id}}3" name="customRadio[{{$item->exm_id}}]" class="custom-control-input" value="3">
                                                    <label class="custom-control-label" for="customRadio{{$item->exm_id}}3">3. {{$item->exm_choice_3}}</label>
                                                </div>
                                                <div class="custom-control custom-radio mt-3">
                                                    <input type="radio" id="customRadio{{$item->exm_id}}4" name="customRadio[{{$item->exm_id}}]" class="custom-control-input" value="4">
                                                    <label class="custom-control-label" for="customRadio{{$item->exm_id}}4">4. {{$item->exm_choice_4}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="card border-0 shadow-theme mb-4">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Modal edit -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <input type="text" class="form-control" name="" id="" placeholder="...">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-theme">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal del -->
            <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delModalLabel">Delete?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            คุณต้องการลบหัวข้อ <span class="text-danger">" "</span> นี้ใช้หรือไม่?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!------------------------- Footer ------------------------->
            <footer class="p-3 d-none d-xl-block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6">
                            <small> Copyright © 2020 Classroom. </small>
                        </div>
                        <div class="col-xl-6 text-right">
                            <small> Designed by Piyawat Loekthanom </small>
                        </div>
                    </div>
                </div>
            </footer>

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

        </div>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Style core JavaScript -->
    <script src="{{asset('js/main.js')}}"></script>



</body>

</html>
