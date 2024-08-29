@extends('backend.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Sayfa Adı</th>
                        <th>İçerik</th>
                        <th>Slug</th>
                        <th>Sıra</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td><img src="{{asset($page->image)}}" width="150"></td>
                                <td>{{$page->title}}</td>
                                <td>{{$page->content}}</td>
                                <td>{{$page->slug}}</td>
                                <td>{{$page->order}}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="switch" page-id="{{$page->id}}" data-toggle="toggle" data-onstyle="success" data-on="Aktif"
                                               @if($page->status==1) checked @endif data-offstyle="danger" data-off="Pasif" data-width="80" data-size="normal">
                                    </div>
                                </td>
                                <td style="white-space: nowrap">
                                    <a href="#" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                    <a href="" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
    <script>
        $(function() {
            $('.switch').change(function() {
                var id = $(this).attr('page-id'); // ID'yi burada tanımlayın
                var statu = $(this).prop('checked');

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.page.getdata') }}',
                    data: { id: id },
                    success: function(response) {
                        console.log('GetData yanıtı:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('GetData hatası:', error);
                    }
                });

                $.get("{{ route('admin.page.switch') }}", { id: id, statu: statu }, function(data, status) {
                    console.log('Switch yanıtı:', data);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Switch hatası:', textStatus, errorThrown);
                });
            });
        });

        $('#dataTable').dataTable();

    </script>

@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

