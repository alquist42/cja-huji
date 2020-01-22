<?php


namespace App\Models;


class Tenant
{
	public $project = '';

    protected $projects = [
        'catalogue' => [
        	'title' => 'Main Catalogue',
			'sub_project' => false,
		],
        'wpc' => [
        	'title' => 'WPC Catalogue',
			'sub_project' => false,
		],
        'slovenia' => [
        	'title' => 'Slovenia Catalogue',
			'sub_project' => false,
		],
        'mhs'  => [
        	'title' => 'MHS Catalogue',
			'sub_project' => true,
		],
        'sch'  => [
        	'title' => 'SHC Catalogue',
			'sub_project' => false,
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
