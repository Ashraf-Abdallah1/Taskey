<?php

namespace App\Models;

use AllowDynamicProperties;

#[AllowDynamicProperties] class Task
{
    public int $id;

    public string $title;

    public string $description;

    public int $priority;

    public int $status;

    public int $created_at;

    public ?int $completed_at;

    public int $progress;

    public function __construct()
    {
        $this->id = 0;
        $this->description = '';
        $this->priority = 0;
        $this->status = 0;
        $this->created_at = time();
        $this->completed_at = null;
        $this->progress = 0;
    }
}