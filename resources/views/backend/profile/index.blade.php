@extends('backend.layouts.master')
@section('title','Profilim')
@section('content')

    <div class="row">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <form method="post" action="{{route('admin.profile.update')}}" autocomplete="off">
                @csrf
                <div class="form-group" >
                    <label> İsim</label>
                    <input type="text" name="admin_name" class="form-control" value="{{$admin->name}}" ></input>
                </div>
                <div class="form-group">
                    <label> E-mail</label>
                    <input type="email" name="admin_email" class="form-control" value="{{$admin->email}}" ></input>
                </div>
                <div class="form-group">
                    <label> Mevcut Şifre</label>
                    <input type="password" name="admin_pass" class="form-control" value="" autocomplete="off" ></input>
                </div>
                <div class="form-group">
                    <label> Yeni Şifre</label>
                    <input type="password" name="admin_newPass" class="form-control" value="" autocomplete="off" ></input>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                </div>

            </form>
        </div>
    </div>

@endsection


