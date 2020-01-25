<?php


namespace App\Models;


class Tenant
{
	/**
	 * Current project
	 *
	 * @var string
	 */
	public $project = '';

	/**
	 * All projects
	 *
	 * @var array
	 */
    protected $projects = [
        'cja' => [
        	'title' => 'The Bezalel Narkiss Index of Jewish Art',
			'url' => 'the-bezalel-narkiss-index-of-jewish-art',
		],
		'mhs'  => [
			'title' => 'Historic Synagogues of Europe',
			'url'=> 'historic-synagogues-of-europe',
		],
        'wpc' => [
        	'title' => 'A Catalogue of Wall Paintings in Central and East European Synagogues',
			'url' => 'a-catalogue-of-wall-paintings-in-central-and-east-european-synagogues',
		],
		'sch'  => [
			'title' => 'Ursula and Kurt Schubert Archive',
			'url' => 'ursula-and-kurt-schubert-archives',
		],
        'slovenia' => [
        	'title' => 'Slovenian Jewish Heritage',
			'url' => 'slovenian-jewish-heritage',
		],
     //   'prlst'  => 'PRLST Catalogue',
     //   'pln'  => 'PLN Catalogue',
    ];

	/**
	 * Set project by key
	 *
	 * @param $project
	 * @throws \Exception
	 */
	public function setProject($project) {
		if (!$this->validate($project)) {
			throw new \Exception('Project does not exists');
		}

		$this->project = $project;
	}

	/**
	 * Set project by URL
	 *
	 * @param $url
	 * @throws \Exception
	 */
	public function setProjectByURL($url) {
		$key = collect($this->projects)->search(function ($project) use ($url) {
			return $url === $project['url'];
		});

		$this->setProject($key);
	}

	/**
	 * Validate project
	 *
	 * @param $project
	 * @return bool
	 */
    public function validate($project) {
        return isset($this->projects[$project]);
    }

	/**
	 * Get all projects
	 *
	 * @return array
	 */
    public function projects() {
        return $this->projects;
    }

	/**
	 * Get project's slug in DB
	 *
	 * @return string
	 */
    public function slug() {
        return strtoupper($this->project);
    }

	/**
	 * Get project's title and url
	 *
	 * @return array
	 */
	public function getProjectData()
	{
		return $this->projects[$this->project];
	}
}
