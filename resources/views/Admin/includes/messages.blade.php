<!-- Validator Errors -->

@if ($errors->any())
<div class="alert alert-danger alert-dismissible show fade">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@if (Session::has('success'))
<div class="alert alert-success alert-dismissible show fade">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible show fade">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
