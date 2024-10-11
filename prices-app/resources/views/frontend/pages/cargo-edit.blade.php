@extends("frontend.app")
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <h2 class="text-center mt-5">Kargo Fiyat Düzenleme</h2>
        <div class="form-group">
            <div class='row'>
                <div class="table-responsive m-5">
                    <form id="updateForm" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered" id="shippingTable">
                            <thead>
                                <tr>
                                    <th scope="col">Min Desi</th>
                                    <th scope="col">Max Desi</th>
                                    <th scope="col">Kargo Fiyat</th>
                                    <th scope="col">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cargoPrices as $data)
                                <tr>
                                    <td><input type="text" name="minDesi[]" class="form-control" value="{{$data->minDesi}}"></td>
                                    <td><input type="text" name="maxDesi[]" class="form-control" value="{{$data->maxDesi}}"></td>
                                    <td><input type="text" name="price[]" class="form-control" value="{{$data->price}}"></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="d-flex justify-content-end gap-1">
                    <button type="button" class="btn btn-success" onclick="addDesiRow()">Satır Ekle</button>
                    <button type="button" class="btn btn-primary" id="postCargo">Kaydet</button>
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
    function addDesiRow() {
        const table = document
            .getElementById("shippingTable")
            .getElementsByTagName("tbody")[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
  <td><input type="number" name="minDesi[]" class="form-control" value=""></td>
  <td><input type="number" name="maxDesi[]" class="form-control" value=""></td>
  <td><input type="number" name="price[]" class="form-control" value=""></td>
  <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
  `;
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    $("#postCargo").click(function() {
        var url = "{{route('cargo-edit')}}";
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
                    top.location.href = "{{route('cargo-edit')}}";
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