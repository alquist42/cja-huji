@php
$set = \App\Models\Set::findOrFail($id);
@endphp
<div class="card mb-3" style="max-width: 540px;">
    <a href="/{{ request()->project }}/items/{{ $set->id }}">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="http://cja.huji.ac.il/{{ $set->images()->first()->url() }}" class="card-img" alt="{{ $set->name() }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $set->name() }}</h5>
                </div>
            </div>
        </div>
    </a>
</div>
