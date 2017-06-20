@extends('admin.layouts.layout-basic')
@section('styles')
    <style>

    </style>
    @stop
@section('scripts')
    <script type="text/javascript" src="{{asset('assets/admin/js/demo/rating.js')}}"></script>
    <script>


    </script>

@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Bar Ratings</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Component</a></li>
                <li class="breadcrumb-item active">Bar Ratings</li>
            </ol>
        </div>
        <div class="row bar-rating">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6>1/10 Rating</h6>
                    </div>
                    <div class="card-block">
                        <select id="example-1to10" name="rating" autocomplete="off">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7" selected="selected">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Movie Rating</h6>
                    </div>
                    <div class="card-block">
                        <select id="example-movie" name="rating" autocomplete="off">
                            <option value="Bad">Bad</option>
                            <option value="Mediocre">Mediocre</option>
                            <option value="Good" selected="selected">Good</option>
                            <option value="Awesome">Awesome</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bar-rating">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Square Rating</h6>
                    </div>
                    <div class="card-block">
                        <select id="example-square" name="rating" autocomplete="off">
                            <option value=""></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Pill Rating</h6>
                    </div>
                    <div class="card-block">
                        <select id="example-pill" name="rating" autocomplete="off">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bar-rating">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Reversed Rating</h6>
                    </div>
                    <div class="card-block">
                        <select id="example-reversed" name="rating" autocomplete="off">
                            <option value="Strongly Agree">Strongly Agree</option>
                            <option value="Agree">Agree</option>
                            <option value="Neither Agree or Disagree" selected="selected">Neither Agree or
                                Disagree
                            </option>
                            <option value="Disagree">Disagree</option>
                            <option value="Strongly Disagree">Strongly Disagree</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Horizontal Rating</h6>
                    </div>
                    <div class="card-block">
                        <select id="example-horizontal" name="rating" autocomplete="off">
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1" selected="selected">1</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
