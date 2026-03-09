<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Task;
use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
use Framework\Database;
use phpDocumentor\Reflection\Types\This;

class TaskRepository implements TaskRepositoryInterface
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function all(): array
    {
        $stmt = $this->database->run("SELECT * FROM tasks ORDER BY title")->fetchAll();
        $tasks = [];

        foreach ($stmt as $tempTask) {
            $task = $this->prepareTask($tempTask);
            $tasks[] = $task;
        }
        return $tasks;
    }

    public function findById(int $id): ?Task
    {
        $stmt = $this->database->run("SELECT * FROM tasks WHERE id = :id", ["id" => $id])->fetch();
        if ($stmt == null) {
            return null;
        }
        return $this->prepareTask($stmt);
    }

    /**
     * @param int $id
     * @return array<Task>|null
     */
    public function findTasksByProject(int $id): array|null
    {
        $tasks = [];
        $stmt = $this->database->run("SELECT * FROM tasks WHERE project_id = :project_id", [
            "project_id" => $id
        ])->fetchAll();
        foreach ($stmt as $task) {
            $task = $this->prepareTask($task);
            $tasks[] = $task;
        }
        if (!$stmt) {
            return null;
        }
        return $tasks;
    }

    private function prepareTask(mixed $tempTask): Task
    {
        $task = new Task();
        $task->id = $tempTask->id;
        $task->title = $tempTask->title;
        $task->description = $tempTask->description;
        $task->priority = $tempTask->priority;
        $task->status = $tempTask->status;
        $task->progress = $tempTask->progress;
        $task->created_at = $tempTask->created_at;
        $task->completed_at = $tempTask->completed_at;
        $task->project_id = $tempTask->project_id;

        return $task;
    }

    public function create(Task $task): Task|null
    {
        $stmt = $this->database->run('insert into tasks (title, description, priority, status, progress, created_at, project_id)
        values (:title, :description, :priority, :status, :progress, :created_at, :project_id)', [
            "title" => $task->title,
            "description" => $task->description,
            "priority" => $task->priority,
            "status" => $task->status,
            "progress" => $task->progress,
            "created_at" => $task->created_at,
            "project_id" => $task->project_id
        ]);
        if ($stmt->rowCount() === 0) {
            return null;
        }
        $task->id = $this->database->getLastId();
        return $task;
    }

    public function update(Task $task): bool
    {
        $stmt = $this->database->run(
            'UPDATE tasks SET
            title = :title,
            description = :description,
             project_id = :project_id
             WHERE id = :id',
            [
                "title" => $task->title,
                "description" => $task->description,
                "project_id" => $task->project_id,
                "id" => $task->id,
            ]
        );

        return $stmt->rowCount() > 0;
    }

    public function delete(Task $task): bool
    {
        $stmt = $this->database->run(
            'DELETE FROM tasks WHERE id = :id',
            ["id" => $task->id]
        );
        return true;
    }

    public function findProjectByTask(int $project_id): Project
    {
        $stmt = $stmt = $this->database->run("SELECT * FROM projects WHERE id = :id", ['id' => $project_id])->fetch();
        $project = new Project();
        $project->id = $stmt->id;
        $project->title = $stmt->title;
        $project->description = $stmt->description;
        return $project;
    }

}
