<?php

namespace App\Importer;

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
