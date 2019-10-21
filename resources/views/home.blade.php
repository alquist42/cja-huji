@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/catalogue/items">Main Catalogue</a>
                    </div>
                </div>
            </div>


            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <a href="/wpc/items">WPC Catalogue</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
