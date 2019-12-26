<dl class="row my-1">
    @foreach ($item->properties as $property)
        <dt class="col-sm-3">{{ $property->verbose_name }}</dt>
        <dd class="col-sm-9">{{ $property->pivot->value }}</dd>
    @endforeach
</dl>
