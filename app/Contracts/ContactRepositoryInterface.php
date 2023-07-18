<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ContactRepositoryInterface
{
    /**
     * Search and paginate the contacts based on the request.
     */
    public function search(Request $request): iterable;

    /**
     * Create a new contact with the given data.
     */
    public function create(array $data): object;
}
