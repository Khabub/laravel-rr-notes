<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use App\Models\User;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use Illuminate\Support\Facades\Crypt;

class NoteController extends Controller
{
    /* public function __construct()
    {
        $this->authorizeResource(Note::class);
    } */
    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {
        // ignorovat warning, app funguje jak má, jen VSCode nepozná, že notes() existuje
        $notes = auth()->user()->notes()->get();

        // Decrypt the notes
        $decryptedNotes = $notes->map(function ($note) {
            $note->note = Crypt::decryptString($note->note);
            $note->title = Crypt::decryptString($note->title);
            return $note;
        });

        return NoteResource::collection($decryptedNotes);

        // $decrypted = Crypt::decryptString($decryptedNotes);
        // return NotesResource::collection(auth()->user()->notes()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        // Encrypt the note
        $validatedData = $request->validated();

        $note = $request->user()->notes()->create([
            'title' => Crypt::encryptString($validatedData['title']),
            'note' => Crypt::encryptString($validatedData['note']),
            'importance' => $validatedData['importance'],
        ]);

        /* $request->user()->fill([
        'token' => Crypt::encryptString($request->token),
        ])->save(); */

        // $note = $request->user()->notes()->create($request->validated());

        return NoteResource::make($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return NoteResource::make($note);  // stejný jako new NotesResource($note)
    }  

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {

        $validatedData = $request->validated();

        $note->fill([
            'title' => Crypt::encryptString($validatedData['title']),
            'note' => Crypt::encryptString($validatedData['note']),
            'importance' => $validatedData['importance'],
        ])->save();

        // $note->update($request->validated());

        return NoteResource::make($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->noContent();
    }
}
