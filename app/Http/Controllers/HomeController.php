<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Taxonomy\Location;
use App\Models\Tenant;

class HomeController extends Controller
{
    /**
     * Header of page
     *
     * @var array
     */
    protected $header = [];

    /**
     * Call another function by project
     *
     * @return mixed
     */
    public function index()
    {
        $project = resolve(Tenant::class);
        $name = $project->project;
        $projectData = $project->getProjectData();

        $this->header = [
            'h1' => $projectData['title'],
            'title' => $projectData['title'],
            'prefix' => $projectData['url'],
            'index_page' => true
        ];

        if (method_exists($this, $name)) {
            return $this->$name();
        } else {
            abort(404);
        }
    }

    /**
     * Show the CJA main page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function cja()
    {
        $categories = Category::select("slug", "name")
            ->where("in_search", 1)
            ->get();

        return view('catalogue.home', ['categories' => $categories, 'header' => $this->header]);
    }

    /**
     * Show the WPC main page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function wpc()
    {
        $countries = Location::select('p.*')
            ->join('taxonomy', function ($join)  {
                $join->on('taxonomy.taxonomy_id', '=', 'locations.id')
                    ->where('taxonomy.taxonomy_type', 'location');

            })
            ->join('sets', function ($join) {
                $join->on('sets.id', '=', 'taxonomy.entity_id');
                //  ->where('taxonomy.entity_type', '=', 'set');
            })
            ->join('projects', function ($join)  {
                $join->on('sets.id', '=', 'projects.taggable_id')
                //    ->where('projects.taggable_type', '=', 'location')
                    ->where('projects.tag_slug', 'WPC');
            })
            ->join('locations as p', function ($join) {
                $join->on([['locations._rgt', '>=', 'p._lft'],
                    ['locations._rgt','<=', 'p._rgt'
                    ]])
                    ->whereNull('p.parent_id');
            })
            // Building does not exist
            ->whereNotIn('locations.id', [758,-1])
            ->distinct()
            ->orderBy('p.name')
            ->get()
            ->map(function ($country) {
                if (strpos($country->name, ' ') !== false) {
                    $country->image = substr($country->name, 0, strpos($country->name, ' ')) . '.jpg';
                } else {
                    $country->image = "$country->name.jpg";
                }
                $country->image = strtolower($country->image);

                return $country;
            });

        return view('wpc.home', ['countries' => $countries, 'header' => $this->header]);
    }

    /**
     * Show the SCH main page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function sch()
    {
        $categories = [
            [
                'title' => 'Bible',
                'search' => 'bible',
                'image' => 'bible.jpg',
            ],
            [
                'title' => 'Biblical Paraphrase',
                'search' => 'biblical paraphrase',
                'image' => 'bib_par.jpg',
            ],
            [
                'title' => 'Haggadah',
                'search' => 'haggadah',
                'image' => 'haggadah.jpg',
            ],
            [
                'title' => 'Evronot',
                'search' => 'evronot',
                'image' => 'evronot.jpg',
            ],
            [
                'title' => 'Esther scroll',
                'search' => 'esther',
                'image' => 'esther.jpg',
            ],
            [
                'title' => 'Halakhic Literature',
                'search' => 'halakhic',
                'image' => 'halkhic.jpg',
            ],
            [
                'title' => 'Siddur',
                'search' => 'siddur',
                'image' => 'prayer.jpg',
            ],
            [
                'title' => 'Medical Literature',
                'search' => 'medical',
                'image' => 'medical.jpg',
            ],
            [
                'title' => 'Miscellany',
                'search' => 'miscellany',
                'image' => 'miscellany.jpg',
            ],
        ];

        return view('sch.home', ['categories' => $categories, 'header' => $this->header]);
    }

    /**
     * Show the Slovenia main page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function slovenia()
    {
        $categories = [
            [
                'name' => 'Jewish Architecture',
                'slug' => 'arc',
                'image' => 'Maribor-Syn.jpg',
            ],
            [
                'name' => 'Jewish Funerary Art',
                'slug' => 'rafa',
                'image' => 'tombstone_fragment.jpg',
            ],
            [
                'name' => 'Sacred and Ritual Objects',
                'slug' => 'sro',
                'image' => 'Kiddush.jpg',
            ],
            [
                'name' => 'Hebrew Manuscripts',
                'slug' => 'ilmb',
                'image' => 'ms.jpg',
            ],
        ];

        return view('slovenia.home', ['categories' => $categories, 'header' => $this->header]);
    }
}
