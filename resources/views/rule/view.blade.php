@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Edit Rule</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('ruleEdit')}}">
                    @csrf
                    <input name="id" type="hidden" value="{{$model->id}}">
                    <div class="form-group">
                        <label>Penyakit</label>
                        <select name="penyakit_id" class="form-control">
                            @foreach ($modelPenyakit as $penyakit)
                            <option @if ($model->penyakit_id == $penyakit->id)
                                selected
                            @endif value="{{$penyakit->id}}">{{$penyakit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gejala</label>
                        <select name="gejala_id" class="form-control">
                            @foreach ($modelGejala as $gejala)
                            <option <option @if ($model->gejala_id == $gejala->id)
                                selected
                            @endif value="{{$gejala->id}}">{{$gejala->deskripsi}}</option>
                            @endforeach
                        </select>
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
