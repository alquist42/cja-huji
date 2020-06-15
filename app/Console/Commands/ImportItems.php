<?php

namespace App\Console\Commands;

use App\Importer\Importer;
use App\Models\Imports\Items;
use Illuminate\Console\Command;

class ImportItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:items {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import items from CSV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Importer $importer)
    {
        $path = $this->argument('file') ?: $this->ask('Please enter valid file path.');

        try {
            $importer->import($path, new Items());
        } catch (ImportErrorsException $e) {
            $this->displayErrors($e->getErrorsBag());
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
        return 0;
    }

    private function displayErrors(array $errors)
    {
        foreach ($errors as $item => $error) {
            $this->table(["Record {$item} has invalid data."], $error);
        }
    }
}
