@extends('backend.layouts.master')
@section('title','Tüm Makaleler')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary"><span>{{$articles->count()}} makale bulundu. </span> </h6>
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
                            <td>{!! $article->status == 0 ? "<span class='text-danger'>Pasif</span>" : "<span class='text-succes>Aktif</span>" !!}</td>
                            <td style="white-space: nowrap">
                                <a href="#" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="{{route('makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="#" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
