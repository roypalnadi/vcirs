@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Pilihan</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('pilihanStore')}}">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" type="text" class="form-control" placeholder="xxxx" required>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input name="nilai" type="number" step="0.01" class="form-control" required>
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

