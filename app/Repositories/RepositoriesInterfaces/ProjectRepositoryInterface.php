<?php

namespace App\Repositories\RepositoriesInterfaces;

use App\Models\Project;

interface ProjectRepositoryInterface
{
    /**
     * @return array<int, mixed>
     */
    public function all(): array;

    public function findById(int $id): ?Project;

    public function insert(Project $project): Project|null;

    public function update(Project $project): bool;


    public function delete(Project $project): bool;
}
