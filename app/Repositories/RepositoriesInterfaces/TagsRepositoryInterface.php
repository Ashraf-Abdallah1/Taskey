<?php

namespace App\Repositories\RepositoriesInterfaces;


use App\Models\Tag;

interface TagsRepositoryInterface
{
    /**
     * @return array<int, mixed>
     */
    public function all(): array;

    public function findById(int $id): ?Tag;

    public function create(Tag $tag): Tag|null;

}
