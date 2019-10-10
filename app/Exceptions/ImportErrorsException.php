<?php

namespace App\Exceptions;

use Throwable;

/**
 * Class ImportErrorsException
 */
class ImportErrorsException extends ImporterException
{
    /**
     * @var array
     */
    private $errors;

    /**
     * ImportErrorsException constructor.
     * @param  string  $message
     * @param  array  $errors
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(string $message, array $errors, $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getErrorsBag(): array
    {
        return $this->errors;
    }
}
