<form id="search-form" class="card px-3 py-3 mb-4 mt-4">
    <div class="row">
        <div class=" col-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Search</span>
                    </div>
                    <input class="form-control" name="text" id="text" value="{{ request()->get('text') }}" type="text" placeholder="type..."/>
                </div>

            </div>
        </div>
        </div>
    <div class="row">
        <div class="col-xl-11 col-lg-11 col-md-11 col-sm-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Category</span>
                    </div>
                    <select id="categories" class="form-control" name="categories[]" multiple="multiple" required>
                        @if(!empty($categories))
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" @if($category->selected) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>

                </div>
            </div>
        </div>
        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12">
            <div class="input-group">
                <button id="select_categories" class="btn">Select all</button>
               {{-- <button id="clear_categories" class="btn">Clear</button>--}}
            </div>
        </div>
</div>
    <div class="row">
        {{--<div class="col-12">
            <div class="form-group">

            </div>
        </div>--}}

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name / Title</span>
                    </div>
                    <input class="form-control" name="search" id="search" value="{{ request()->get('search') }}" type="text" placeholder="type..."/>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Origin</span>
                    </div>
                    <select id="origins" name="origins[]" class="form-control" multiple>
                        @if(!empty($filters['origins']))
                            @foreach ($filters['origins'] as $origin)
                                <option value="{{ $origin->id }}" selected>{{ $origin->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Community</span>
                    </div>
                    <select id="communities" name="communities[]" class="form-control" multiple>
                        @if(!empty($filters['communities']))
                            @foreach ($filters['communities'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Object</span>
                    </div>
                    <select id="objects" name="objects[]" class="form-control" multiple>
                        @if(!empty($filters['objects']))
                            @foreach ($filters['objects'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                {{--
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Date</span>
                    </div>
                    <select id="dates" name="dates[]" class="form-control" multiple>
                        @if(!empty($filters['dates']))
                            @foreach ($filters['dates'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                --}}

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Location</span>
                    </div>
                    <select id="locations" name="locations[]" class="form-control" multiple>
                        @if(!empty($filters['locations']))
                            @foreach ($filters['locations'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Collection</span>
                    </div>
                    <select id="collections" name="collections[]" class="form-control" multiple>
                        @if(!empty($filters['collections']))
                            @foreach ($filters['collections'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Iconographic subject</span>
                    </div>
                    <select id="subjects" name="subjects[]" class="form-control" multiple>
                        @if(!empty($filters['subjects']))
                            @foreach ($filters['subjects'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Artist / Maker</span>
                    </div>
                    <select id="artists" name="artists[]" class="form-control" multiple>
                        @if(!empty($filters['artists']))
                            @foreach ($filters['artists'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">School / Style</span>
                    </div>
                    <select id="schools" name="schools[]" class="form-control" multiple>
                        @if(!empty($filters['schools']))
                            @foreach ($filters['schools'] as $curFilter)
                                <option value="{{ $curFilter->id }}" selected>{{ $curFilter->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn" onclick="window.location = location.protocol + '//' + location.host + location.pathname">Clear selected</button>
        </div>
    </div>
</form>

