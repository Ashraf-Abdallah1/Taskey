<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\RepositoriesInterfaces\TagsRepositoryInterface;
use Framework\Database;

class TagRepository implements TagsRepositoryInterface
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
        $stmt = $this->database->run('SELECT * FROM tags')->fetchAll();

        $tags = [];
        foreach ($stmt as $row) {
            $tag = new Tag();
            $tag->id = $row->id;
            $tag->title = $row->title;
            $tags[] = $tag;
        }
        return $tags;
    }

    public function findById(int $id): ?Tag
    {
        return null;
    }

    public function create(Tag $tag): Tag|null
    {
        $stmt = $this->database->run('INSERT INTO tags (title) VALUES (:title)', ['title' => $tag->title])->fetch();
        return $tag;
    }
}
