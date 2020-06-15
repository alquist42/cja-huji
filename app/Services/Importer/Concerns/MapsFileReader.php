<?php

namespace App\Importer\Concerns;

use App\Exceptions\FileNotFoundException;
use App\Exceptions\UnsupportedFileException;
use App\Importer\Csv;
use Illuminate\Support\Str;

/**
 * Trait MapsFileReader
 */
trait MapsFileReader
{
    /**
     * @param  string  $path
     * @return FileReader
     * @throws BindingResolutionException
     * @throws FileNotFoundException
     * @throws UnsupportedFileException
     */
    public function mapReader($path)
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException("File does not exist at path '{$path}'");
        }

        if (Str::endsWith($path, '.csv')) {
            return new Csv(compact('path'));
        }

        $message = sprintf('File type \'%s\' of \'%s\' is not supported.', mime_content_type($path), basename($path));

        throw new UnsupportedFileException($message);
    }
}
