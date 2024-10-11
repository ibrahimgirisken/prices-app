<!DOCTYPE html>
<html lang="en">
@include('frontend.include.head')

<body>
    @include('frontend.include.header')
    @yield('content')
    @include('frontend.include.js')
    @yield('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('css')
</body>

</html>