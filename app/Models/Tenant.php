<?php


namespace App\Models;


class Tenant
{

    public $project = '';

    protected $projects = [
        'catalogue' => 'Main Catalogue',
        'wpc' => 'WPC Catalogue',
        'slovenia' => 'Slovenia Catalogue',
        'mhs'  => 'MHS Catalogue',
        'sch'  => 'SHC Catalogue',
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

        if (in_array($project, array_keys($this->map))) {
            $this->project = $this->map[$project];
        }
    }

    public function validate($project) {
        return in_array($project, array_keys($this->projects));
    }

    public function projects() {
        return $this->projects;
    }

    public function slug() {
        return strtoupper($this->project);
    }
}
