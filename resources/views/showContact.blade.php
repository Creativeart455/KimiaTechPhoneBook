@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p>{{ __('Contact Detail') }}</p>
{{--                        <p>{{ __('You are loged in!') }}</p>--}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="p-1 m-1 d-flex justify-content-between align-items-center">
                            {{--                        href="{{route('')}}"--}}
                            <p>inside show blade</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
