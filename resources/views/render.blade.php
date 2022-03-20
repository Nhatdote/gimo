@extends('master')


@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('export')
            @include('list')
        </div>
    </div>
@endsection
