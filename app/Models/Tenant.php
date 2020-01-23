<?php


namespace App\Models;


class Tenant
{
	public $project = '';

    protected $projects = [
        'catalogue' => [
        	'title' => 'Main Catalogue',
//			'slug' => 'the-bezalel-narkiss-index-of-jewish-art',
			'sub_project' => true,
		],
        'wpc' => [
        	'title' => 'WPC Catalogue',
//			'slug' => 'a-catalogue-of-wall-paintings-in-central-and-east-european-synagogues',
			'sub_project' => true,
		],
        'slovenia' => [
        	'title' => 'Slovenia Catalogue',
//			'slug' => 'slovenia-catalog',
			'sub_project' => false,
		],
        'mhs'  => [
        	'title' => 'MHS Catalogue',
//			'slug '=> 'historic-synagogues-of-europe',
			'sub_project' => true,
		],
        'sch'  => [
        	'title' => 'SCH Catalogue',
//			'slug' => 'ursula-and-kurt-schubert-archives',
			'sub_project' => true,
		],
     //   'prlst'  => 'PRLST Catalogue',
     //   'pln'  => 'PLN Catalogue',
    ];

    protected $map = [
        'catalogue' => 'cja',
    ];

    public function setProject($project) {
        if (!$this->validate($project)) {
            throw new \Exception('Project does not exists');
        }

        $this->project = $project;

        if (isset($this->map[$project])) {
            $this->project = $this->map[$project];
        }
    }

    public function validate($project) {
        return isset($this->projects[$project]);
    }

    public function projects() {
        return $this->projects;
    }

    public function slug() {
        return strtoupper($this->project);
    }
}
