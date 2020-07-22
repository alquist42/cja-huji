<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait SearchableByIndex
{
    protected static function bootSearchableByIndex()
    {
        static::saving(function ($model) {
            dd($model->name);
//            $documentSetup = new DocumentSetup();
//            $documentSetup->document_id = $model->id;
//            $documentSetup->is_public = false;
//            $documentSetup->need_verification = true;
//            $documentSetup->save();
        });

       // parent::boot();
    }
}
