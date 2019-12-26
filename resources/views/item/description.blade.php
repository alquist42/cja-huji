<div class="card mx-1 mb-4">
    <div class="card-header">
        Description
    </div>
    <div class="card-body">
        {!! preg_replace_callback("/\/\/\/ID\/(\d{1,9})\//", function ($matches) { return view('partials.thumb', [ 'id' => $matches[1]])->render(); }, $item->description) !!}
    </div>
</div>
