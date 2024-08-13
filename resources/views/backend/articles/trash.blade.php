@extends('backend.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary"><span>{{$articles->count()}} makale bulundu. </span>
                <a href="{{route('makaleler.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm text-white-50">
                    <i class="fas fa-heart fa-sm text-white-50"></i> Yayındakiler</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Silinme Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)

                        <tr>
                            <td><img src="{{asset('')}}{{$article->image}}" height="200"></td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->getCategory->name}}</td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->deleted_at}}</td>

                            <td style="white-space: nowrap">
                                <a href="{{route('admin.article.harddelete',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                <a href="{{route('admin.article.recycle',$article->id)}}" title="Arşivden Çıkar" class="btn btn-sm btn-success"><i class="fa fa-arrow-up"></i></a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('article-id');
                statu = $(this).prop('checked');
                $.get("{{route('admin.switch')}}",{id:id,statu:statu}, function (data,status){
                    console.log(status);
                })
            })
        })
    </script>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
