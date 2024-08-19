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
                                            <input type="checkbox" class="switch" category-id="{{$category->id}}"
                                                   data-toggle="toggle" data-onstyle="success" data-on="Aktif"
                                                   @if($category->status==1) checked @endif  data-offstyle="danger"
                                                   data-off="Pasif" data-width="80" data-size="normal">
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click"
                                           title="Kategoriyi Düzenle" data-toggle="modal" data-target="#exampleModal"><i
                                                class="fa fa-edit text-white"></i> </a>
                                        <a category-id="{{$category->id}}" class="btn btn-sm btn-danger delete-click"
                                           title="Sil" data-toggle="modal" data-target="#exampleModal2">
                                            <i class="fa fa-times text-white"></i></a>
                                        <a category-id="{{$category->id}}" class="btn btn-sm btn-info forcedelete-click"
                                           title="ForceSil" data-toggle="modal" data-target="#exampleModal3">
                                            <i class="fa-solid fa-filter-circle-xmark"></i></a>
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

<!-- forceDelete Modal -->
<div class="modal fade" id="forcedeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal3LabelLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal3Label">Kategori Sil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('admin.category.forcedelete')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <span>Kategoriyi içeriğinde makale olsa bile silmek istediğine emin misin?</span>
                        <input id="delete_category_id" type="hidden" class="form-control" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-info" data-dismiss="modal">İptal</button>
                    <button type="submit" name="action" value="fulldata" class="btn btn-info">Kategoriyle - makaleleri sil</button>
                    <button type="submit" name="action" value="onlycat" class="btn btn-danger">Sadece Kategoriyi Sil</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal2LabelLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModal2Label">Kategori Sil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('admin.category.delete')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <span>Kategoriyi silmek istediğine emin misin?</span>
                        <input id="delete_category_id" type="hidden" class="form-control" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-danger">Sil</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kategori Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('admin.category.update')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label> Kategori Adı</label>
                        <input id="category" type="text" class="form-control" name="category">
                        <input id="category_id" type="hidden" class="form-control" name="id">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script>
        $(document).ready(function () {
            // Düzenleme tıklama olayını işleyin
            $('.edit-click').click(function () {
                var id = $(this).attr('category-id'); // ID'yi almak için jQuery metodu kullanın

                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.category.getdata') }}', // URL'yi Blade'den dinamik olarak alın
                    data: {id: id},
                    success: function (data) {
                        $('#category').val(data.name);
                        $('#slug').val(data.slug);
                        $('#category_id').val(data.id);
                        $('#editModal').modal('show'); // Modal'ı göster
                    }
                });
            });

            $('.delete-click').click(function () {
                var id = $(this).attr('category-id'); // ID'yi almak için jQuery metodu kullanın
                $('#delete_category_id').val(id)
                $('#deleteModal').modal('show'); // Modal'ı göster
            });

            $('.forcedelete-click').click(function () {
                var id = $(this).attr('category-id'); // ID'yi almak için jQuery metodu kullanın
                $('#delete_category_id').val(id)
                $('#forcedeleteModal').modal('show'); // Modal'ı göster
            });

            // Switch değişimini işleyin
            $('.switch').change(function () {
                var id = $(this).attr('category-id');
                var statu = $(this).prop('checked');
                $.get("{{ route('admin.category.switch') }}", {id: id, statu: statu}, function (data, status) {
                    console.log(status);
                }).fail(function (xhr, status, error) {
                    console.error('AJAX isteğinde hata oluştu:', status, error);
                });
            });

            $('#dataTable').dataTable();
        });

    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
