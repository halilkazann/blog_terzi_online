@extends('backend.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary"><span>{{$articles->count()}} makale bulundu. </span>
                <a href="{{route('admin.article.trash')}}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm text-black-50">
                    <i class="fas fa-recycle fa-sm text-black-50"></i> Arşiv</a></h6>
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
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
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
                            <td>{{$article->created_at}}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="switch" article-id="{{$article->id}}" data-toggle="toggle" data-onstyle="success" data-on="Aktif" @if($article->status==1) checked @endif  data-offstyle="danger"  data-off="Pasif"     data-width="80" data-size="normal">
                                </div>
                            </td>
                            <td style="white-space: nowrap">
                                <a href="#" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="{{route('makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.article.delete',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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









