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
                    <input name="id" type="hidden" value="{{$id}}">
                    <div class="form-group">
                        <label>Penyakit</label>
                        <select name="penyakit_id" class="form-control" disabled>
                            @foreach ($modelPenyakit as $penyakit)
                            <option @if ($id == $penyakit->id)
                                selected
                            @endif value="{{$id}}">{{$penyakit->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gejala</label>
                        <div class="selectgroup selectgroup-pills">
                            @foreach ($modelGejala as $gejala)
                            <label class="selectgroup-item">
                                <input type="checkbox" name="gejala[]" value="{{$gejala->id}}" class="selectgroup-input" @if ($gejala->checked)
                                checked=""
                                @endif>
                                <span class="selectgroup-button">{{$gejala->kode}} {{$gejala->deskripsi}}</span>
                            </label>
                            @endforeach
                        </div>
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
