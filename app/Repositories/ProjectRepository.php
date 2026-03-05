<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use Framework\Database;

class ProjectRepository implements RepositoriesInterfaces\ProjectRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $projects = [];
        $stmtProjects = $this->database->run("SELECT * FROM projects")->fetchAll();
        foreach ($stmtProjects as $stmtProject) {
            $project = $this->prepearProject($stmtProject);
            $projects[] = $project;
        }
        return $projects;
    }

    public function findById(int $id): ?Project
    {
        $stmt = $this->database->run("SELECT * FROM projects WHERE id = :id", ['id' => $id])->fetch();
        //        if (empty($project)) {
//            return null;
//        }
        return $this->prepearProject($stmt);
    }

    public function insert(Project $project): Project
    {
        return new Project();
    }

    public function update(Project $project): bool
    {
        return false;
    }

    public function delete(Project $project): bool
    {
        return false;
    }

    private function prepearProject(mixed $stmtProject): Project
    {
        $project = new Project();
        $project->id = $stmtProject->id;
        $project->title = $stmtProject->title;
        $project->description = $stmtProject->description;
        return $project;
    }
}
