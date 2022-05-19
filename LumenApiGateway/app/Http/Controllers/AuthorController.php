<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the authors microservice
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return the list of authors
     *
     * @return void
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * create one new author
     *
     * @return void
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all(), Response::HTTP_CREATED));
    }

    /**
     * obtains and show one author
     *
     * @return void
     */
    public function show($author)
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }

    /**
     * update on existing author
     *
     * @return void
     */
    public function update(Request $request, $author)
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * remove an existing author
     *
     * @return void
     */
    public function destroy($author)
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}