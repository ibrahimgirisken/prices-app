@extends("frontend.app")
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <h2 class="text-center mt-5">XML Ürün Düzenleme</h2>
        <div class="form-group">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Group Name</th>
                        <th>Title</th>
                        <th>Platform</th>
                        <th>Seller</th>
                        <th>Price</th>
                        <th>Ownership</th>
                        <th>Link</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prices as $price)
                    <tr>
                        <td>{{$price['id']}}</td>
                        <td>{{$price['code']}}</td>
                        <td>{{$price['group_name']}}</td>
                        <td>{{$price['title']}}</td>
                        <td>{{$price['platform']}}</td>
                        <td>{{$price['seller']}}</td>
                        <td>{{$price['price']}}</td>
                        <td>{{$price['ownership']==="0"?"RAKİP":"FİRMA"}}</td>
                        <td>{{$price['link']}}</td>
                        <td><button class='btn btn-success btn-sm m-1 getFeatures' data-id='{{$price["id"]}}'><i class='bi bi-pencil-square' style='font-size: 1em; color: white;'></i></button></td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('frontend.include.modal')
@endsection
@section("css")
<style>
    .table-responsive {
        max-height: 50rem;
        overflow-y: auto;
    }

    thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #fff;
    }
</style>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            bAutoWidth: false,
            aoColumns: [{
                    sWidth: "10%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "10%"
                },
                {
                    sWidth: "20%"
                },
            ],
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            },
            fixedColumns: {
                start: 1,
                end: 1,
            },
            scrollY: 1000,
            scrollX: true,
            scrollCollapse: true,
            lengthChange: true,
            order: [
                [0, "asc"]
            ],
            columnDefs: [{
                targets: [6], // Sütun index'i
                render: $.fn.dataTable.render.number(",", ".", 2),
            }, ],
            responsive: true,
            destroy: true,
            iDisplayLength: 1000,
            searching: true,
            ordering: true,
            paging: true,
            info: true,
            autoWidth: true,
            dom: "lfBrtip",
            aLengthMenu: [
                [-1, 10, 50, 100],
                ["Tümü", 10, 50, 100],
            ],
        });
    });



    $(document).on('click', '.getFeatures', function() {
        var prop = $(this).data('prop');
        var id = $(this).data('id');

        $.ajax({
            url: "{{ route('product-feature-edit') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                prop: prop,
                id: id,
            },
            success: function(response) {
                $('#exampleModal .modal-title').html('Ürün Sahiplik Durumu');
                $('#exampleModal .modal-body').html(`
                    <form id="updateForm">
                        <div class="form-group">
                            <label>Id</label>
                            <input type="text" class="form-control" value="${response.productId}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Grup Kodu</label>
                            <input type="text" class="form-control" value="${response.code}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Grup ismi</label>
                            <input type="text" class="form-control" value="${response.type}">
                        </div>
                        <div class="form-group">
                            <label>Departman</label>
                            <input type="text" class="form-control" value="${response.department}">
                        </div>
                    </form>
                `);
                $('#exampleModal').modal('show');
            },
            error: function() {
                alert('Veri alımı başarısız oldu. Lütfen daha sonra tekrar deneyin.');
            }
        });
    });
</script>
@endsection