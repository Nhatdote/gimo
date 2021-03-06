@extends('master')


@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <h3 style="font-weight: 100">{{ __('Menus') }}</h3>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="{{ route('users') }}">{{ __('Users') }}</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('departments') }}">{{ __('Departments') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection()
