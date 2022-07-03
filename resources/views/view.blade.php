@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Edit User</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('userEdit')}}">
                    @csrf
                    <input name="id" type="hidden" value="{{$model->id ?? null}}">
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" type="text" class="form-control" placeholder="xxxx xxxx" value="{{$model->name ?? null}}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" placeholder="xxxx@xxxx" value="{{$model->email ?? null}}" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" required>
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

