@extends('backend.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('admin.category.create')}}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" class="form-control" name="category" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-sm float-right">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)

                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->getArticle()}}</td>

                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="switch" category-id="{{$category->id}}" data-toggle="toggle" data-onstyle="success" data-on="Aktif" @if($category->status==1) checked @endif  data-offstyle="danger"  data-off="Pasif"     data-width="80" data-size="normal">
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <a href="#" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('makaleler.edit',$category->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                        <a href="{{route('admin.article.delete',$category->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('category-id');
                statu = $(this).prop('checked');
                $.get("{{route('admin.category.switch')}}",{id:id,statu:statu}, function (data,status){
                    console.log(status);
                })
            })
        })
    </script>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
