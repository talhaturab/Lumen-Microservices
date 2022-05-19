<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * The base uri to consumer authors service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consumer authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        // the above translate to
        // $this->baseUri = 'localhost:8000';
        $this->secret = config('services.authors.secret');
    }

    /**
     * Obtain the full list of author from the author service
     * @return String
     */
    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    /**
     * create author from the author service
     * @return string
     */
    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * obtain one single author from the autherService
     * @return String
     */
    public function obtainAuthor($author)
    {
        return $this->performRequest('GET', "/authors/{$author}");
    }

    /**
     * Update an instance of author using the author service
     * @return [type] [description]
     */
    public function editAuthor($data, $author)
    {
        return $this->performRequest('PUT', "/authors/{$author}", $data);
    }

    /**
     * remove a single author using the author service
     * @return String
     */
    public function deleteAuthor($author)
    {
        return $this->performRequest('DELETE', "/authors/{$author}");
    }
}