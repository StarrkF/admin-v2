<!-- Validator Errors -->

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="success" :message="$error" />
    @endforeach
@endif


@if (Session::has('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if (Session::has('error'))
    <x-alert type="danger" :message="session('error')" />
@endif

@if (Session::has('info'))
    <x-alert type="info" :message="session('info')" />
@endif
