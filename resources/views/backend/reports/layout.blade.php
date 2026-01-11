@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">@yield('title')</h5>
        </div>
        <div class="card-body">
            @yield('body')
        </div>
    </div>
</div>
@endsection
