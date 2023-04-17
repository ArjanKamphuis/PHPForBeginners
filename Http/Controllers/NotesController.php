<?php

namespace Http\Controllers;

class NotesController extends Controller
{
    public function index(): void
    {
        view('notes.index', [
            'heading' => 'My Notes',
            'notes' => $this->db->query('SELECT * FROM notes')->get()
        ]);
    }

    public function show(): void
    {
        view('notes.show', [
            'heading' => 'Note',
            'note' => $this->fetchNote()
        ]);
    }

    public function create(): void
    {
        view('notes.create', [
            'heading' => 'Create Note',
            'form' => $this->form
        ]);
    }

    public function store()
    {
        if (!$this->form->validate(['body' => $_POST['body']])) {
            return $this->failForm('/notes/create');
        }

        $this->db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            ':body' => $_POST['body'],
            ':user_id' => auth()->id()
        ]);

        return redirect("/note?id={$this->db->getLastInsertedId()}");
    }

    public function edit(): void
    {
        view('notes.edit', [
            'heading' => 'Edit Note',
            'note' => $this->fetchNote(),
            'form' => $this->form
        ]);
    }

    public function update()
    {
        $note = $this->fetchNote();

        if (!$this->form->validate(['body' => $note['body']])) {
            return $this->failForm("/note/edit?id={$note['id']}");
        }

        $this->db->query('UPDATE notes SET body=:body WHERE id=:id', [
            ':body' => $_POST['body'],
            ':id' => $note['id']
        ]);

        return redirect("/note?id={$note['id']}");
    }

    public function destroy()
    {
        $note = $this->fetchNote();
        $this->db->query('DELETE from notes WHERE id = :id', [':id' => $note['id']]);
        return redirect('/notes');
    }

    protected function fetchNote(): array
    {
        $id = $_POST['id'] ?? $_GET['id'] ?? abort();
        $note = $this->db->query('SELECT * FROM notes WHERE id = :id', [':id' => $id])->findOrFail();
        
        authorize($note['user_id'] === auth()->id());

        return $note;
    }
}
