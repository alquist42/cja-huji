<span class="small">
    <cite>
        @if($image->date) {{ $image->date }} @endif
        @if($image->photographer) by {{ $image->photographer->name }} @endif
        @if($image->copyright) &copy; {{ $image->copyright->name }} @endif
    </cite>
</span>

{{--@if($image->negative)--}}
{{--    <p class="small">Negative / Photo. No. {{ $image->negative }}</p>--}}
{{--@endif--}}

{{--@if($image->nli_picname)--}}
{{--    <p class="small">Scan No. {{ $image->nli_picname }}</p>--}}
{{--@endif--}}
