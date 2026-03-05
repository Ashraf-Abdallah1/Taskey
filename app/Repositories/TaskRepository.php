<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\RepositoriesInterfaces\TaskRepositoryInterface;
use Framework\Database;

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

        return $task;
    }

    public function create(Task $task): Task|null
    {
        $stmt = $this->database->run('insert into tasks (title, description, priority, status, progress, created_at)
        values (:title, :description, :priority, :status, :progress, :created_at)', [
            "title" => $task->title,
            "description" => $task->description,
            "priority" => $task->priority,
            "status" => $task->status,
            "progress" => $task->progress,
            "created_at" => $task->created_at,
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
            description = :description
         WHERE id = :id',
            [
                "title" => $task->title,
                "description" => $task->description,
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
}
