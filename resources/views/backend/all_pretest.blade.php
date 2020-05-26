@extends('layouts.master')

@section('nav')
@stop
@section('content')
    <!------------------------- Content ------------------------->
    <div class="container mt-4 mb-4 pb-4">
        <img class="bg-dashboard" src="{{asset('images/Rectangle/wave_2.svg')}}" alt="">
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-lg-8">

                            <a class="m-0" href="{{ route('classroom.show', ['id' => $id]) }}">
                                <i class="fas fa-arrow-left text-white fa-sm pr-2" style="font-size: 24px;"></i>
                            </a>

                        @if (session('status'))
                            <div class="alert alert-success mt-2" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($pretest as $key => $item)
                            <div class="card list-work border-0 mb-3 mt-3 shadow-theme ">
                                <div class="card-body p-0 p-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-7">
                                            <h5 class="m-0 text-uppercase">
                                                <i class="fas fa-clipboard-list mr-1"></i>
                                                {{$key+1}} : {{$item->pt_name}}
                                            </h5>
                                        </div>
                                        <div class="col-6 col-lg-3 mt-2">
                                            <small class="m-0"><i class="far fa-clock"></i> {{$item->create_at}}</small>
                                        </div>
                                        <div class="col-6 col-lg-2 text-left mt-2">
                                            <span class="badge badge-primary">Total: {{$item->score ?? 0}} / {{$item->pt_number_of_exam}}</span>
                                        </div>
                                        <div class="col-12 col-lg-12 text-right mt-2">
                                            {{-- ตรวจสอบว่าทำไปรึยัง --}}
                                            @if(is_null($item->score))
                                                <a href="{{route('exam.show', ['id' => $item->pt_id])}}" role="button" class="btn btn-outline-theme text-primary mr-4">Start</a>
                                            @else
                                                <p class="text-success mr-4">Finish</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-lg-4 d-none d-lg-block">
                        <div class="card border-0 shadow-theme mb-4">
                            <div class="card-header bg-white">
                                <h4 class="m-0 text-theme">คะแนนรวม</h4>
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
                                <div class="card-footer">
                                    <h4 class="text-primary">คะแนน {{($getscore)}} / {{$sumscore}}</h4>
                                </div>
                                    @if($getscore != 0)
                                    <input type="range" id="slider" min="0" max="100" value="{{(($getscore * 100) / $sumscore)}}">
                                    @else
                                    <input type="range" id="slider" min="0" max="100" value="{{0}}">
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('modal')
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

    });
</script>

