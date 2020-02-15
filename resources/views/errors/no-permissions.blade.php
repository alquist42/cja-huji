@extends('layouts.app')

@section('content')

    <div class="container error">
        <div class="row text-center">
            <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                <div class="row">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1">
                        <h2 class="m-0">Permission denied</h2>
                        <h6>this page is available only for authorized users</h6>
                        <p>Please, <a href="/login">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection