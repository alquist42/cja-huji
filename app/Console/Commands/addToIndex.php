<?php

namespace App\Console\Commands;
use App\Services\Search;
use Illuminate\Console\Command;

class addToIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toindex:add {type} {offset?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'adding to index table';

    /**
     * The  service.
     *
     * @var service
     */
    protected $service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Search $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $offset = !empty($this->argument('offset')) ? $this->argument('offset') : 0;

        $this->service->fillIndex($this->argument('type'), $offset);
    }
}
