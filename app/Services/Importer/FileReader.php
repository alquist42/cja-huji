<?php

namespace App\Importer;

use Illuminate\Support\Collection;

/**
 * Interface FileReader
 */
interface FileReader
{
    /**
     * @return Collection
     */
    public function getRecords();

    /**
     * @param  array  $requiredColumns
     * @return bool
     */
    public function hasValidStructure(array $requiredColumns);
}
