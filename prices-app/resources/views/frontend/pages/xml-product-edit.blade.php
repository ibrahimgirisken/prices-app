@extends("frontend.app")
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <h2 class="text-center mt-5">XML Ürün Düzenleme</h2>
        <div class="form-group">
            <div class='row'>
                <div class="table-responsive m-5">
                    <form id="updateForm" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered" id="shippingTable">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Ürün Kodu</th>
                                    <th scope="col">Marka</th>
                                    <th scope="col">Desi</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Fiyat</th>
                                    <th scope="col">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($xmlProducts as $xmlData)
                                <tr>
                                    <td><input type="text" name="code[]" class="form-control" value="{{$xmlData->code}}"></td>
                                    <td><input type="text" name="productcode[]" class="form-control" value="{{$xmlData->productCode}}"></td>
                                    <td><input type="text" name="brand[]" class="form-control" value="{{$xmlData->brand}}"></td>
                                    <td><input type="text" name="desi[]" class="form-control" value="{{$xmlData->desi}}"></td>
                                    <td><input type="text" name="stock[]" class="form-control" value="{{$xmlData->stock}}"></td>
                                    <td><input type="text" name="price[]" class="form-control" value="{{$xmlData->price}}"></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="d-flex justify-content-end gap-1">
                    <button type="button" class="btn btn-success" onclick="addPriceListDesiRow()">Satır Ekle</button>
                    <button type="button" class="btn btn-primary" id="postXmlEdit">Kaydet</button>
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
    function addPriceListDesiRow() {
        const table = document
            .getElementById("shippingTable")
            .getElementsByTagName("tbody")[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
  <td><input type="text" name="code[]" class="form-control" value=""></td>
  <td><input type="text" name="productcode[]" class="form-control" value=""></td>
  <td><input type="text" name="brand[]" class="form-control" value=""></td>
  <td><input type="number" name="desi[]" class="form-control" value=""></td>
  <td><input type="number" name="stock[]" class="form-control" value=""></td>
  <td><input type="number" name="price[]" class="form-control" value=""></td>
  <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
  `;
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    $("#postXmlEdit").click(function() {
        var url = "{{route('xml-edit')}}";
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
                    window.setTimeout( show_popup, 1000 ); 
                    top.location.href = "{{route('xml-edit')}}";
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