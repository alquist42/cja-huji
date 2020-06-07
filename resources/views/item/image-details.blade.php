<dl class="row my-1">
    @if(array_get($item->images,'0.copyright.name'))
        <dt class="col-sm-3">Copyright</dt>
        <dd class="col-sm-9">{{ array_get($item->images,'0.copyright.name') }}</dd>
    @endif

    @if(array_get($item->images,'0.photographer.id'))
        <dt class="col-sm-3">Photographer</dt>
        <dd class="col-sm-9">
            <a href="/{{ request()->project }}/browse/photographers/{{ array_get($item->images,'0.photographer.id') }}"> {{ array_get($item->images,'0.photographer.name') }}</a>
        </dd>
    @endif

    @if(array_get($item->images,'0.date'))
        <dt class="col-sm-3">Date</dt>
        <dd class="col-sm-9">{{ array_get($item->images,'0.date') }}</dd>
    @endif

    @if(array_get($item->images,'0.negative'))
        <dt class="col-sm-3">Negative / Photo. No.</dt>
        <dd class="col-sm-9">{{ array_get($item->images,'0.negative') }}</dd>
    @endif
</dl>
