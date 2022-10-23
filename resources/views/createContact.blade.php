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
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="firstName">First Name:</label>
                                    <input name="firstName" type="email" class="form-control" id="firstName"
                                           placeholder="Albert">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lastName">Last Name:</label>
                                    <input name="lastName" type="text" class="form-control" id="lastName"
                                           placeholder="Einstein">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">Email:</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                           placeholder="albert@einstein.com">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone">Phone No.:</label>
                                    <input name="phone" type="tel" class="form-control" id="phone"
                                           placeholder="09121375102">
                                </div> <span class=" ">
                                    +
                                </span>

                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="1234 Valiasr St">
                            </div>
                            <div class="form-group my-2">
                                <button type="submit" class="btn btn-primary d-block ms-auto w-25">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
