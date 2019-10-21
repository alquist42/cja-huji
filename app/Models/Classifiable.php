<?php

namespace App\Models;

use App\Models\Taxonomy\Collection;
use App\Models\Taxonomy\Community;
use App\Models\Taxonomy\Congregation;
use App\Models\Taxonomy\HistoricOrigin;
use App\Models\Taxonomy\Location;
use App\Models\Taxonomy\Maker;
use App\Models\Taxonomy\Object;
use App\Models\Taxonomy\Origin;
use App\Models\Taxonomy\Period;
use App\Models\Taxonomy\School;
use App\Models\Taxonomy\Site;
use App\Models\Taxonomy\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classifiable extends Model
{
    /**
     * @return BelongsToMany
     */
    public function origins()
    {
        return $this->belongsToMany(Origin::class);
    }

    /**
     * @return BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    /**
     * @return BelongsToMany
     */
    public function objects()
    {
        return $this->belongsToMany(Object::class);
    }

    /**
     * @return BelongsToMany
     */
    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    /**
     * @return BelongsToMany
     */
    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    /**
     * @return BelongsToMany
     */
    public function communities()
    {
        return $this->belongsToMany(Community::class);
    }

    /**
     * @return BelongsToMany
     */
    public function congregations()
    {
        return $this->belongsToMany(Congregation::class);
    }

    /**
     * @return BelongsToMany
     */
    public function historical_origins()
    {
        return $this->belongsToMany(HistoricOrigin::class);
    }

    /**
     * @return BelongsToMany
     */
    public function periods()
    {
        return $this->belongsToMany(Period::class);
    }

    /**
     * @return BelongsToMany
     */
    public function schools()
    {
        return $this->belongsToMany(School::class);
    }

    /**
     * @return BelongsToMany
     */
    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

//    public function category()
//    {
//        return $this->morphedByMany(Site::class);
//    }
//
//    public function properties()
//    {
//        return $this->morphedByMany(Site::class);
//    }
}
