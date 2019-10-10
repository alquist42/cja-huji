<?php

namespace App\Importer;

use Illuminate\Support\Collection;

/**
 * Interface Importable
 */
interface Importable
{
    /**
     * @return array
     */
    public function getErrors();

    /**
     * @return bool
     */
    public function hasErrors();

    /**
     * @param  Collection  $collection
     * @return void
     */
    public function import(Collection $collection);

    /**
     * @return array
     */
    public function requiredColumns();

    /**
     * @param  array  $item
     */
    public function validateItem(array $item);
}
