<div class="card mx-1 mb-4">
        <div class="card-body">
                <dl class="row my-1">
                        @foreach ($item->properties as $property)
                                <dt class="col-sm-3 text-nowrap">{{ $property->verbose_name }}</dt>
                                <dd class="col-sm-9">{!!  $property->pivot->value !!}</dd>
                        @endforeach
                </dl>
       </div>
</div>


