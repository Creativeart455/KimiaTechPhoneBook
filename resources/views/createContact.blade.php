@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p>{{ __('Add A New Contact') }}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('contact.store')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="firstName">First Name:</label>
                                    <input name="firstName" type="text  " class="form-control" id="firstName"
                                           placeholder="eg. Albert">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lastName">Last Name:</label>
                                    <input name="lastName" type="text" class="form-control" id="lastName"
                                           placeholder="eg. Einstein">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email:</label>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div id="mother1">
                                            <input name="email[]" type="email" class="form-control" id="email"
                                                   placeholder="eg. albert@einstein.com">
                                        </div>
                                        <div class="btn btn-primary mx-1 myplusicon"
                                             style="cursor:pointer; font-size: 2rem;" id="plus1">
                                            +
                                            <script>
                                                let plus1 = document.getElementById('plus1');
                                                plus1.addEventListener('click', function () {
                                                    const node1 = document.getElementById("email");
                                                    const clonedElement1 = node1.cloneNode(true);
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
                                            <input name="phone[]" type="tel" class="form-control" id="phone"
                                                   placeholder="eg. 09121375102">
                                        </div>
                                        <div class="btn btn-primary mx-1" id="plus"
                                             style="cursor:pointer; font-size: 2rem;">
                                            +
                                        <script>
                                            let plus = document.getElementById('plus');
                                            plus.addEventListener('click', function () {
                                                const node = document.getElementById("phone");
                                                const clonedPhone = node.cloneNode(true);
                                                document.getElementById("mother").appendChild(clonedPhone);

                                            })
                                        </script>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div id="mother2">
                                        <input name="address[]" type="text" class="form-control" id="address"
                                               placeholder="eg. 1234 Valiasr St">
                                    </div>
                                    <div class="btn btn-primary mx-1 myplusicon"
                                         style="cursor:pointer; font-size: 2rem;" id="plus2">
                                        +
                                        <script>
                                            let plus2 = document.getElementById('plus2');
                                            plus2.addEventListener('click', function () {
                                                const node2 = document.getElementById("address");
                                                const clonedElement2 = node2.cloneNode(true);
                                                document.getElementById("mother2").appendChild(clonedElement2);

                                            })
                                        </script>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group my-2">
                                <button type="submit" class="btn btn-primary d-block ms-auto w-25">Add</button>
                            </div>
                        </form>
                        @dd()
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
