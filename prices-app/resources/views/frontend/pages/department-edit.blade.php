@extends("frontend.app")
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <h2 class="text-center mt-5">Kur - Iskonto Oran Düzenleme</h2>
        <div class="form-group">
            <div class='row'>
                <div class="table-responsive m-5">
                    <form id="updateForm" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered" id="shippingTable">
                            <thead>
                                <tr>
                                    <th scope="col">Departman</th>
                                    <th scope="col">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $data)
                                <tr>
                                    <td><input type="text" name="department[]" class="form-control" value="{{$data->name}}"></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="d-flex justify-content-end gap-1">
                <button type="button" class="btn btn-success" onclick="addDepartmentRow()">Satır Ekle</button>
                    <button type="button" class="btn btn-primary" id="postDepartment">Kaydet</button>
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

    $("#postDepartment").click(function() {
        var url = "{{route('department-edit')}}";
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
                    top.location.href = "{{route('department-edit')}}";
                } else {
                    toastr.error(response.content, response.title);
                }
            },
            error: function(request, status, error) {
                console.log(request.responseText);
            }
        });
    });

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function addDepartmentRow() {
        const table = document
            .getElementById("shippingTable")
            .getElementsByTagName("tbody")[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
  <td><input type="text" name="department[]" class="form-control" value=""></td>
  <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
  `;
    }
</script>
@endsection