<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Judul</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar" style="left: 5px">
            @include('layouts.headerV2')

        </nav>
        <!-- Main Content -->
        <div class="main-content" style="padding: 80px 80px 0px 80px">
            <div class="card">
                <div class="card-header">
                    <h4>Diagnosa</h4>
                </div>
                <form action="{{route('save')}}" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Penginput</label>
                        <input name="nama" type="text" class="form-control" required>
                    </div>
                    <div class="table-responsive">
                        @csrf
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Geajal</th>
                                <th scope="col">Pilihan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($modelGejala as $key => $gejala)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$gejala->deskripsi}}</td>
                                <td style="padding: 10px">
                                    <div class="col-sm-9">
                                        @foreach ($modelPilihan as $key1 => $pilihan)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pilihan{{$key}}" id="gridRadios1" value="{{$pilihan->id}}" required>
                                            <label class="form-check-label" for="gridRadios1">
                                                {{$pilihan->nama}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right  ">
                    <button class="btn btn-primary">Proses</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
</html>
