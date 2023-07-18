<?php

namespace App\Http\Controllers;

use App\Contracts\ContactRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class ContactController extends Controller
{
    public function __construct(private ContactRepositoryInterface $contactRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): InertiaResponse
    {
        $contacts = $this->contactRepository->search($request);

        return Inertia::render('Contacts/Index', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Contacts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email:dns|unique:contacts',
            'telephone' => 'nullable|numeric',
        ]);

        $this->contactRepository->create($validatedData);

        return redirect()->route('contacts.index');
    }
}
