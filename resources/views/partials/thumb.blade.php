@php
$item = \App\Models\Item::where('id', $id)->first();
@endphp
@if(isset($item))
<div class="card mb-3" style="max-width: 540px;">
    <a href="/{{ request()->project }}/items/{{ $item->id }}">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="/images/{{ $item->id }}-{{ $item->images()->first()->id }}-thumb.png" class="card-img" alt="{{ $item->name() }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name() }}</h5>
                </div>
            </div>
        </div>
    </a>
</div>
@endif
