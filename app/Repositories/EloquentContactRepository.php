<?php

namespace App\Repositories;

use App\Contracts\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentContactRepository implements ContactRepositoryInterface
{
    public function __construct(private Contact $contact)
    {
    }

    /**
     * Search and paginate the contacts based on the request.
     */
    public function search(Request $request): iterable
    {
        $queryBuilder = QueryBuilder::for(Contact::class)
            ->allowedFilters([
                AllowedFilter::partial('first_name'),
                AllowedFilter::partial('last_name'),
                AllowedFilter::partial('email'),
                AllowedFilter::partial('telephone'),
            ]);

        if ($request->has('search')) {
            $queryBuilder->where(function ($query) use ($request) {
                $query->where('first_name', 'like', "%{$request->search}%")
                    ->orWhere('last_name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('telephone', 'like', "%{$request->search}%");
            });
        }

        return $queryBuilder->paginate(10)->withQueryString();
    }

    /**
     * Create a new contact with the given data.
     */
    public function create(array $data): object
    {
        return $this->contact->create($data);
    }
}
