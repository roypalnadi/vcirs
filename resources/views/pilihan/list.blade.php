@extends('layouts.app')

@section('content')
    <section class="section">

        <div class="card">
            <div class="card-header">
            <h4>Pilihan</h4>
                <div class="card-header-form">
                    <form action="{{route('pilihanList')}}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input name="search" type="text" class="form-control" placeholder="Search" value="{{$search}}">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="pilihan" class="table table-striped">
                    <tbody><tr>
                        <th>Nama</th>
                        <th>Nilai User</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($models as $model)
                    <tr>
                        <td>{{$model->nama}}</td>
                        <td>{{$model->nilai}}</td>
                        <td>
                            <a href="{{route('pilihanView', $model->id)}}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger trigger--fire-modal-7" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="window.location.href = '/pilihan/delete/{{$model->id}}';">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody></table>
                </div>
            </div>
            <div class="card-footer p-10 text-right">
                <div>
                    <a href="{{route('pilihanAdd')}}" class="btn btn-success"><span class="fas fa-plus"></span> Tambah</a>
                </div>
            </div>
        </div>
    </section>
@endsection

