@extends("frontend.app")
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <h2 class="text-center mt-5">Ürün Gruplarına Göre Departman Güncelleme</h2>
        <div class="form-group">
            <div class='row'>
                <div class="table-responsive m-5">
                    <form id="updateForm" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered" id="shippingTable">
                            <thead>
                                <tr>
                                    <th scope="col">Ürün Id</th>
                                    <th scope="col">Grup Kodu</th>
                                    <th scope="col">Grup Adı</th>
                                    <th scope="col">Departman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($features as $data)
                                <tr>
                                    <input type="hidden" readonly name="Id[]" class="form-control" value="{{$data->id}}">
                                    <td><input type="text" readonly name="productId[]" class="form-control" value="{{$data->productId}}"></td>
                                    <td><input type="text" readonly name="code[]" class="form-control" value="{{$data->code}}"></td>
                                    <td><input type="text" readonly name="name[]" class="form-control" value="{{$data->name}}"></td>
                                    <td><select class="form-control" name="departmentId[]">
                                            <option value="0">Seçiniz</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$data->department===$department->id ? "selected" :""}}>{{$department->name}}</option>
                                            @endforeach
                                        </select></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="d-flex justify-content-end gap-1">
                    <button type="button" class="btn btn-primary" id="postFeatures">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
@section("js")
<script>
    $("#postFeatures").click(function() {
        var url = "{{route('feature-edit')}}";
        var form = new FormData($("form")[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == "success") {
                    toastr.success(response.content, response.title);
                    top.location.href = "{{route('feature-edit')}}";
                } else {
                    toastr.error(response.content, response.title);
                }
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
        });
    });
</script>
@endsection