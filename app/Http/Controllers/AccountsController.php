<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts;
use App\Http\Requests\StoreAccountsRequest;
use App\Http\Requests\UpdateAccountsRequest;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $accounts = Accounts::paginate('10');

          return view('accounts.index', compact('accounts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountsRequest $request)
    {
        $validated = $request->validated();

        $validated['password']  =  Hash::make($validated['password']);
        Accounts::create($validated);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($email)
    {
        $account = Accounts::where('email', $email)->first();

        if(!$account) {
            return redirect()->route('accounts.index')->with('error', 'Account not found.');
        }

        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountsRequest $request , string $email)
    {
        $account = Accounts::where('email', $email)->first();
        if(!$account) {
            return redirect()->route('accounts.index')->with('error', 'Account not found.');
        }

        $validated = $request->validated();

        $account->update($validated);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

}
