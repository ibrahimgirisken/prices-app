@extends("frontend.app")
@section('content')
<div id="xmlUpdateResult" class="alert alert-info mt-3" style="display: none;">
</div>
@endsection
@section("css")
@endsection
@section("js")
<script>
    $(document).ready(function() {
        $('#xmlUpdateMenu').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue != 0) {
                $.ajax({
                    url: '/xml-update',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        menuOption: selectedValue
                    },
                    success: function(response) {
                        $('#xmlUpdateResult').html(response.message).removeClass('alert-info').addClass('alert-success').show();
                    },
                    error: function(xhr) {
                        $('#xmlUpdateResult').html('Bir hata oluştu.').removeClass('alert-info').addClass('alert-danger').show();
                    }
                });
            }
        });
    });
</script>
@endsection