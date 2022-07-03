@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Penyakit/Hama</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('penyakitStore')}}">
                    @csrf
                    <input name="id" type="hidden" value="{{$model->id ?? null}}">
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control" placeholder="xxxx xxxx" required>
                    </div>
                    <div class="form-group">
                        <label>Kode</label>
                        <input name="kode" type="text" class="form-control" placeholder="xxx" required>
                    </div>
                    <div class="form-group">
                        <label>Solusi</label>
                        <textarea style="height: 100px" name="solusi" class="form-control" required>{{$model->solusi ?? null}}</textarea>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success mr-1" type="submit"><i class="fas fa-plus"></i> Tambah</button>
                        <a href="{{url()->previous()}}" class="btn btn-secondary mr-1" type="submit"><i class="fas fa-angle-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection

