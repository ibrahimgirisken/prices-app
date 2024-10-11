@extends("frontend.app")
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <h2 class="text-center mt-5">Departmana Göre Komisyon Oranı Düzenleme</h2>
        <div class="form-group">
            <div class='row'>
                <div class="table-responsive m-5">
                    <form id="updateForm" method="POST">
                        @csrf
                        <table class="table table-striped table-bordered" id="shippingTable">
                            <thead>
                                <tr>
                                    <th scope="col">Departman</th>
                                    <th scope="col">Oran</th>
                                    <th scope="col">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($earning_raties as $data)
                                <tr><td><select class="form-control" name="departmentId[]">
                                            <option value="0">Seçiniz</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{$data->department_id===$department->id ? "selected" :""}} >{{$department->name}}</option>
                                            @endforeach
                                        </select></td>
                                    <td><input type="text" name="rate[]" class="form-control" value="{{$data->rate}}"></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="d-flex justify-content-end gap-1">
                    <button type="button" class="btn btn-success" onclick="addEarningRateRow()">Satır Ekle</button>
                    <button type="button" class="btn btn-primary" id="postEarningRate">Kaydet</button>
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
    var departments = @json($departments);
    var earningRaties = @json($earning_raties);

    function addEarningRateRow() {
        const table = document
            .getElementById("shippingTable")
            .getElementsByTagName("tbody")[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
  <td>
    <select class="form-control" name="departmentId[]">
        <option value="0">Seçiniz</option>
        ${departments.map(d => {
            let selected = earningRaties.some(data => data.department === d.name) ? 'selected' : '0';
            return `<option value="${d.id}" ${selected}>${d.name}</option>`;
        }).join('')}
    </select>
  </td>
  <td><input type="number" name="rate[]" class="form-control" value=""></td>
  <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Sil</button></td>
  `;
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    $("#postEarningRate").click(function() {
        var url = "{{route('department-earning-edit')}}";
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
                    top.location.href = "{{route('department-earning-edit')}}";
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