<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\Taxonomy\Collection;
use App\Models\Taxonomy\Community;
use App\Models\Taxonomy\HistoricOrigin;
use App\Models\Taxonomy\Location;
use App\Models\Taxonomy\Object as TaxonomyObject;
use App\Models\Taxonomy\Origin;
use App\Models\Taxonomy\Period;
use App\Models\Taxonomy\School;
use App\Models\Taxonomy\Site;
use App\Models\Taxonomy\Artist;
use App\Models\Taxonomy\Subject;
use Illuminate\Console\Command;

class FixTree extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:tree';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix relation trees';

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
    public function handle()
    {
        try {
            Location::fixTree();
            Subject::fixTree();
            TaxonomyObject::fixTree();
            HistoricOrigin::fixTree();
            Origin::fixTree();
            School::fixTree();
            Period::fixTree();
            Community::fixTree();
            Collection::fixTree();
            Site::fixTree();
            Artist::fixTree();
            Item::fixTree();
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
        return 0;
    }
}
