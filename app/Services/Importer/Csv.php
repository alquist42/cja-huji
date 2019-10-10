<?php

namespace App\Importer;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use League\Csv\Exception;
use League\Csv\Reader;

/**
 * Class Csv
 */
class Csv implements FileReader
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @var array
     */
    private $headers;

    /**
     * Csv constructor.
     * @param  string|null  $path
     * @throws Exception
     */
    public function __construct($path = null)
    {
        $this->reader = Reader::createFromPath($path['path']);

        $this->headers = $this->reader->fetchOne();
        $this->reader->setHeaderOffset(0);
    }

    /**
     * @return Collection
     */
    public function getRecords()
    {
        return collect($this->reader->getRecords($this->headers));
    }

    /**
     * @param  array  $requiredColumns
     * @return bool
     */
    public function hasValidStructure(array $requiredColumns)
    {
        $rules = [];
        foreach ($requiredColumns as $column) {
            $rules["*.{$column}"] = 'present';
        }

        return !Validator::make($this->getRecords()->toArray(), $rules)->fails();
    }
}
