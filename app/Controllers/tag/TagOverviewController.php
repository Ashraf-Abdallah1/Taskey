<?php

namespace App\Controllers\tag;

use App\Repositories\RepositoriesInterfaces\TagsRepositoryInterface;
use Framework\Response;
use Framework\ResponseFactory;

class TagOverviewController
{
    private TagsRepositoryInterface $tagsRepository;
    private ResponseFactory $responseFactory;

    public function __construct(TagsRepositoryInterface $tagsRepository, ResponseFactory $responseFactory)
    {
        $this->tagsRepository = $tagsRepository;
        $this->responseFactory = $responseFactory;
    }

    public function index(): Response
    {
        $tags = $this->tagsRepository->all();
        return $this->responseFactory->view('tags/index.html.twig', [
            'tags' => $tags
        ]);
    }
}
