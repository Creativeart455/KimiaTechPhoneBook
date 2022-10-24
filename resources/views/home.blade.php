@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p>{{ __('Dashboard') }}</p>
                        <p>{{ __('You are loged in!') }}</p>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col mx-1">
                            <a href="{{route('contact.create')}}" class="btn btn-primary d-block ms-auto"
                               style="width: 123px; margin-right: 2px">Create</a>
                        </div>
                        @foreach($contacts as $contact)
                            <div class="p-1 m-1 d-flex justify-content-between align-items-center">
                                <a href="{{route('contact.show',['contact'=>$contact->id])}}"
                                   class="d-flex align-items-center text-decoration-none" style="vertical-align:center; margin:0!important;" >
                                    <span style="font-size: 1.5rem;">{{$contact->first_name}} {{$contact->last_name}}</span>
                                    @if(count($contact->phones) > 1)
                                        <span style="font-size: .7rem; margin: 0!important;"> - multiple</span>
                                    @else
                                        <span style="font-size: .7rem; margin: 0!important;">
                                            - {{$contact->phones->first()->phoneNumber??'not available'}}</span>
                                    @endif
                                </a>
                                <div class="d-flex">
                                    <a class="btn btn-warning mx-1"
                                       href="{{route('contact.edit',['contact'=>$contact->id])}}">edit</a>
                                    <form action="{{route('contact.destroy',['contact'=>$contact->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
