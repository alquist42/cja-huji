@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-5">

            @foreach($projects as $project => $name)

                <div class="col-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="/{{ $project  }}/items">{{ $name }}</a>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
@endsection
