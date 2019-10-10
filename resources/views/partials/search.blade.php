<form class="mb-4">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Search</span>
                    </div>
                    <input class="form-control" name="search" id="search" value="{{ request()->get('search') }}" type="text" placeholder="type..."/>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Category</span>
                    </div>
                    <select id="category" name="category[]" class="form-control" multiple></select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Origin</span>
                    </div>
                    <select id="origin" name="origin[]" class="form-control" multiple></select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Community</span>
                    </div>
                    <select id="community" name="community[]" class="form-control" multiple></select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Collection</span>
                    </div>
                    <select id="collection" name="collection[]" class="form-control" multiple></select>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Object</span>
                    </div>
                    <select id="object" name="object[]" class="form-control" multiple></select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Date</span>
                    </div>
                    <select id="dates" name="dates[]" class="form-control" multiple></select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Location</span>
                    </div>
                    <select id="location" name="location[]" class="form-control" multiple></select>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Iconographic subject</span>
                    </div>
                    <select id="subject" name="subject[]" class="form-control" multiple></select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Artist / Maker</span>
                    </div>
                    <select id="artist" name="artist[]" class="form-control" multiple></select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">School / Style</span>
                    </div>
                    <select id="school" name="school[]" class="form-control" multiple></select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

