<?php

namespace App\Http\Controllers\Api;

use App\Models\Notes;
use App\Http\Requests\StoreNotesRequest;
use App\Http\Requests\UpdateNotesRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotesResource;
use Illuminate\Support\Facades\Crypt;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ignorovat warning, app funguje jak má, jen VSCode nepozná, že notes() existuje
        $notes = auth()->user()->notes()->get();

        // Decrypt the notes
        /* $decryptedNotes = $notes->map(function ($note) {
            $note->note = Crypt::decryptString($note->note);
            $note->title = Crypt::decryptString($note->title);
            return $note;
        }); */

        return NotesResource::collection($notes);

        // $decrypted = Crypt::decryptString($decryptedNotes);
        // return NotesResource::collection(auth()->user()->notes()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotesRequest $request)
    {
        // Encrypt the note
        /* $validatedData = $request->validated();

        $note = $request->user()->notes()->create([
            'title' => Crypt::encryptString($validatedData['title']),
            'note' => Crypt::encryptString($validatedData['note']),
            'importance' => $validatedData['importance'],
        ]); */

        /* $request->user()->fill([
        'token' => Crypt::encryptString($request->token),
        ])->save(); */

        $note = Notes::create($request->validated());

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
     * Update the specified resource in storage.
     */
    public function update(UpdateNotesRequest $request, Notes $note)
    {

        /* $validatedData = $request->validated();

        $note->fill([
            'title' => Crypt::encryptString($validatedData['title']),
            'note' => Crypt::encryptString($validatedData['note']),
            'importance' => $validatedData['importance'],
        ])->save(); */

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
