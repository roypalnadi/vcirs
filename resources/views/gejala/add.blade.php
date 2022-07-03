@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Gejala</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('gejalaStore')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kode</label>
                        <input name="kode" type="text" class="form-control" placeholder="xxxx xxxx" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input name="deskripsi" type="text" class="form-control" placeholder="xxxx" required>
                    </div>
                    <div class="form-group">
                        <label>Nilai Pakar</label>
                        <input name="nilai_pakar" type="number" step="0.01" class="form-control" required>
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

