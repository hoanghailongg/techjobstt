@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            toastr["error"]('{{ $error }}')
        @endforeach
    </script>
@endif

@if (Session::has('error'))
    <script>
        toastr.error('{{ Session::get('error') }}');
    </script>
@endif


@if (Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>
@endif
