<?php

namespace Http\Controllers;

use Http\Forms\NotesForm;

class NotesController extends Controller
{
    public function index()
    {
        view('notes.index', [
            'heading' => 'My Notes',
            'notes' => $this->db->query('SELECT * FROM notes')->get()
        ]);
    }

    public function show()
    {
        view('notes.show', [
            'heading' => 'Note',
            'note' => $this->fetchNote()
        ]);
    }

    public function create()
    {
        view('notes.create', [
            'heading' => 'Create Note',
            'form' => NotesForm::resolve()
        ]);
    }

    public function store()
    {
        $form = new NotesForm();
        if (!$form->validate($_POST['body'])) {
            $form->flash();
            return redirect('/notes/create');
        }

        $this->db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            ':body' => $_POST['body'],
            ':user_id' => auth()->id()
        ]);

        redirect("/note?id={$this->db->getLastInsertedId()}");
    }

    public function edit()
    {
        view('notes.edit', [
            'heading' => 'Edit Note',
            'note' => $this->fetchNote(),
            'form' => NotesForm::resolve()
        ]);
    }

    public function update()
    {
        $note = $this->fetchNote();
        $form = new NotesForm();

        if (!$form->validate($note['body'])) {
            $form->flash();
            return redirect("/note/edit?id={$note['id']}");
        }

        $this->db->query('UPDATE notes SET body=:body WHERE id=:id', [
            ':body' => $_POST['body'],
            ':id' => $note['id']
        ]);

        redirect("/note?id={$note['id']}");
    }

    public function destroy()
    {
        $note = $this->fetchNote();
        $this->db->query('DELETE from notes WHERE id = :id', [':id' => $note['id']]);
        redirect('/notes');
    }

    protected function fetchNote(): array
    {
        $id = $_POST['id'] ?? $_GET['id'] ?? abort();
        $note = $this->db->query('SELECT * FROM notes WHERE id = :id', [':id' => $id])->findOrFail();
        
        authorize($note['user_id'] === auth()->id());

        return $note;
    }
}
