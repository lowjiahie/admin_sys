@extends('layouts.masteradmin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-2">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome, {{ $admin->name }}</h1>
    </div>
    <!-- Content Here -->
</main>

    
@endsection