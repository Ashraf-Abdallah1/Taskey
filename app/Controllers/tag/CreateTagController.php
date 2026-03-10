<?php

namespace App\Controllers\tag;

use _PHPStan_1734058be\Psr\Http\Message\ServerRequestInterface;
use App\Models\Tag;
use App\Repositories\RepositoriesInterfaces\TagsRepositoryInterface;
use Framework\Request;
use Framework\Response;
use Framework\ResponseFactory;

class CreateTagController
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
        return $this->responseFactory->view('tags/create.html.twig');
    }

    public function store(Request $request): Response
    {
        $tag = new Tag();
        $tag->title = $request->get('title');
        $this->tagsRepository->create($tag);
        return $this->responseFactory->redirect('/tags');
    }

}