<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

    /**
     * The base uri to consumer books service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consumer books service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Obtain the full list of book from the book service
     * @return String
     */
    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    /**
     * create book from the book service
     * @return string
     */
    public function createBook($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * obtain one single book from the autherService
     * @return String
     */
    public function obtainBook($book)
    {
        return $this->performRequest('GET', "/books/{$book}");
    }

    /**
     * Update an instance of book using the book service
     * @return [type] [description]
     */
    public function editBook($data, $book)
    {
        return $this->performRequest('PUT', "/books/{$book}", $data);
    }

    /**
     * remove a single book using the book service
     * @return String
     */
    public function deleteBook($book)
    {
        return $this->performRequest('DELETE', "/books/{$book}");
    }
}