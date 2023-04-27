<?php

namespace App\Http\Controllers\Api;

use App\Models\Notes;
use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotesResource;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NotesResource::collection(auth()->user()->notes()->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    /* public function create()
    {
        //
    } */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotesRequest $request)
    {
        $note = $request->user()->notes()->create($request->validated());
        return NotesResource::make($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notes $note)
    {
        return NotesResource::make($note);  // stejný jako new NotesResource($note)
    }

    /**
     * Show the form for editing the specified resource.
     */
   /*  public function edit(Notes $notes)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotesRequest $request, Notes $note)
    {
        $note->update($request->validated());
        return NotesResource::make($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $note)
    {
        $note->delete();

        return response()->noContent();
    }
}
