<?php

namespace App\Importer;

use App\Exceptions\FileNotFoundException;
use App\Exceptions\ImportErrorsException;
use App\Exceptions\MissingFieldsException;
use App\Exceptions\UnsupportedFileException;
use App\Importer\Concerns\MapsFileReader;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Class Importer
 */
class Importer
{
    use MapsFileReader;

    /**
     * @param  string  $path
     * @param  Importable  $importable
     * @throws BindingResolutionException
     * @throws FileNotFoundException
     * @throws MissingFieldsException
     * @throws UnsupportedFileException
     * @throws ImportErrorsException
     */
    public function import($path, Importable $importable)
    {
        $reader = $this->mapReader($path);
        $columns = $importable->requiredColumns();

        if (!$reader->hasValidStructure($columns)) {
            $message = sprintf('The file must have the following fields: %s.', implode(', ', $columns));

            throw new MissingFieldsException($message);
        }

        $importable->import($reader->getRecords());

        if ($importable->hasErrors()) {
            throw new ImportErrorsException('Errors occurred while importing the file.', $importable->getErrors());
        }
    }
}
