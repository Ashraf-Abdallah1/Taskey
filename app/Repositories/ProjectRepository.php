<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;
use App\Repositories\RepositoriesInterfaces\ProjectRepositoryInterface;
use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
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

    public function insert(Project $project): Project|null
    {
        $stmt = $this->database->run("INSERT INTO Projects (title, description) VALUES (:title, :description)", [
            'title' => $project->title,
            'description' => $project->description
        ])->fetch();
        $project->id = $this->database->getLastId();
        return $project;
    }

    public function update(Project $project): bool
    {
        return false;
    }

    public function delete(Project $project): bool
    {
        $stmt = $this->database->run("DELETE FROM Projects WHERE id = :id", ['id' => $project->id]);
        if ($stmt->rowCount() > 0) {
            return true;
        }
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
