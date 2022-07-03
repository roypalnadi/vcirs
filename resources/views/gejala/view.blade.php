@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Edit Gejala</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('gejalaEdit')}}">
                    @csrf
                    <input name="id" type="hidden" value="{{$model->id ?? null}}">
                    <div class="form-group">
                        <label>Kode</label>
                        <input name="kode" type="text" class="form-control" placeholder="xxxx xxxx" value="{{$model->kode ?? null}}" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input name="deskripsi" type="text" class="form-control" placeholder="xxxx" value="{{$model->deskripsi ?? null}}" required>
                    </div>
                    <div class="form-group">
                        <label>Nilai Pakar</label>
                        <input name="nilai_pakar" type="number" step="0.01" class="form-control" value="{{$model->nilai_pakar ?? null}}" required>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit"><i class="fas fa-save"></i> Update</button>
                        <a href="{{url()->previous()}}" class="btn btn-secondary mr-1" type="submit"><i class="fas fa-angle-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection

