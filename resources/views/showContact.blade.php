@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p>{{ __('Contact Detail') }}</p>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="p-1 m-1 d-flex justify-content-between align-items-center">
                            {{--                        href="{{route('')}}"--}}
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{$contact->first_name}}</td>
                                    <td>{{$contact->last_name}}</td>
                                    <td>
                                        @foreach($contact->phones->all() as $dataModel)
                                             <div>{{$dataModel->phoneNumber ??'not available'}}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($contact->emails->all() as $dataModel)
                                            <div>{{$dataModel->email ??'not available'}}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($contact->addresses->all() as $dataModel)
                                            <div>{{$dataModel->addressString ??'not available'}}</div>
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
