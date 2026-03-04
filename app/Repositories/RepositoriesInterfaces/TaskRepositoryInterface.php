<?php

namespace App\Repositories\RepositoriesInterfaces;

use App\Models\Task;

interface TaskRepositoryInterface
{
    /**
     * @return array<int, mixed>
     */
    public function all(): array;

    public function findById(int $id): ?Task;

    public function create(Task $task): Task | null;

    public function update(Task $task): bool;

    public function delete(Task $task): bool;


}