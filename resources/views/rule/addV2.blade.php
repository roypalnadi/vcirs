@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Rule</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('ruleStore')}}">
                    @csrf
                    <div class="form-group">
                        <label>Penyakit</label>
                        <select name="penyakit_id" class="form-control">
                            @foreach ($modelPenyakit as $penyakit)
                            <option value="{{$penyakit->id}}">{{$penyakit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gejala</label>
                        <div class="selectgroup selectgroup-pills">
                            @foreach ($modelGejala as $gejala)
                            <label class="selectgroup-item">
                                <input type="checkbox" name="gejala[]" value="{{$gejala->id}}" class="selectgroup-input">
                                <span class="selectgroup-button">{{$gejala->kode}} {{$gejala->deskripsi}}</span>
                            </label>
                            @endforeach
                        </div>
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

