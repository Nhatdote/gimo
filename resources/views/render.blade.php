@extends('master')


@section('content')
    <div class="container-fluid">
        <div class="row h-100">
            @include('export')
            @include('list')
        </div>
    </div>
@endsection
