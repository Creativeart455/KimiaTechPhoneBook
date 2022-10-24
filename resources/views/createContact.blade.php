@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{--                                        @dd(isset($contact)?'daniel true':'daniel False')--}}
                    <div class="card-header d-flex justify-content-between">
                        <p>{{ __('Add A New Contact') }}</p>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{!isset($contact)? route('contact.store') : route('contact.update',['contact'=>$contact->id])}}"
                            method="POST">
                            @csrf
                            @if(isset($contact))
                                @method('PUT')
                            @endif
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="firstName">First Name:</label>
                                    <input name="firstName" type="text  " class="form-control my-1" id="firstName"
                                           placeholder="eg. Albert"
                                           value="{{isset($contact)?$contact->first_name : ''}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lastName">Last Name:</label>
                                    <input name="lastName" type="text" class="form-control my-1" id="lastName"
                                           placeholder="eg. Einstein"
                                           value="{{isset($contact)?$contact->last_name : ''}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email:</label>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div id="mother1">
                                            @if(isset($contact))
                                                @foreach($contact->emails as $emailModel)
                                                    <input name="email[]" type="email" class="form-control my-1" id="email"
                                                           placeholder="eg. albert@einstein.com"
                                                           value="{{$emailModel->email}}">
                                                @endforeach
                                            @else
                                                <input name="email[]" type="email" class="form-control my-1" id="email"
                                                       placeholder="eg. albert@einstein.com"
                                                       value="">
                                            @endif
                                        </div>
                                        <div class="btn btn-warning mx-1 myplusicon"
                                             style="cursor:pointer; font-size: 2rem;" id="plus1">
                                            +
                                            <script>
                                                let plus1 = document.getElementById('plus1');
                                                plus1.addEventListener('click', function () {
                                                    const node1 = document.getElementById("email");
                                                    const clonedElement1 = node1.cloneNode(true);
                                                    clonedElement1.value = "";
                                                    document.getElementById("mother1").appendChild(clonedElement1);

                                                })
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone">Phone No.:</label>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div id="mother">
                                            @if(isset($contact))
                                                @foreach($contact->phones as $dataModel)
                                                    <input name="phone[]" type="text" class="form-control my-1" id="phone"
                                                           placeholder="eg. albert@einstein.com"
                                                           value="{{$dataModel->phoneNumber??'not available'}}">
                                                @endforeach
                                            @else
                                                <input name="phone[]" type="text" class="form-control my-1" id="phone"
                                                       placeholder="eg. albert@einstein.com"
                                                       value="">
                                            @endif
                                        </div>
                                        <div class="btn btn-warning mx-1 myplusicon" id="plus"
                                             style="cursor:pointer; font-size: 2rem;">
                                            +
                                            <script>
                                                let plus = document.getElementById('plus');
                                                plus.addEventListener('click', function () {
                                                    const node = document.getElementById("phone");
                                                    const clonedPhone = node.cloneNode(true);
                                                    clonedPhone.value = "";
                                                    document.getElementById("mother").appendChild(clonedPhone);

                                                })
                                            </script>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div id="mother2">
                                        @if(isset($contact))
                                            @foreach($contact->addresses as $dataModel)
                                                <input name="address[]" type="text" class="form-control my-1" id="address"
                                                       placeholder="eg. Los Angeles"
                                                       value="{{$dataModel->addressString??'not available'}}">
                                            @endforeach
                                        @else
                                            <input name="address[]" type="text" class="form-control my-1" id="address"
                                                   placeholder="eg. Los Angeles"
                                                   value="">
                                        @endif
                                    </div>
                                    <div class="btn btn-warning mx-1 myplusicon"
                                         style="cursor:pointer; font-size: 2rem;" id="plus2">
                                        +
                                        <script>
                                            let plus2 = document.getElementById('plus2');
                                            plus2.addEventListener('click', function () {
                                                const node2 = document.getElementById("address");
                                                const clonedElement2 = node2.cloneNode(true);
                                                clonedElement2.value = "";
                                                document.getElementById("mother2").appendChild(clonedElement2);

                                            })
                                        </script>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group my-2">
                                <button type="submit"
                                        class="btn btn-primary d-block ms-auto w-100">{{isset($contact)?'Update':'Insert'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
