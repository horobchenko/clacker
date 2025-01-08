<?php

namespace App\Http\Controllers;

use App\Models\Clacker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;

class ClackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        return Inertia::render('Clacker/Index', [
            'clackers' => Clacker::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
         $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->clacker()->create($validated);
 
        return redirect(route('clacker.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Clacker $clacker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clacker $clacker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clacker $clacker):RedirectResponse
    {
        Gate::authorize('update', $clacker);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $clacker->update($validated);
 
        return redirect(route('clacker.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clacker $clacker): RedirectResponse
    {
        //
         Gate::authorize('delete', $clacker);
 
        $clacker->delete();
 
        return redirect(route('clacker.index'));
    }
}
