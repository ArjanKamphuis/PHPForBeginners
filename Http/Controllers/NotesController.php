<?php

namespace Http\Controllers;

use Core\Validator;

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
            'errors' => $this->errors
        ]);
    }

    public function store()
    {
        if (!$this->validate()) {
            return $this->create();
        }

        $this->db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            ':body' => $_POST['body'],
            ':user_id' => auth()->id()
        ]);

        redirect("/note?id={$this->db->getLastInsertedId()}");
    }

    public function edit(?array $note = null)
    {
        view('notes.edit', [
            'heading' => 'Edit Note',
            'errors' => $this->errors,
            'note' => $note ?? $this->fetchNote()
        ]);
    }

    public function update()
    {
        $note = $this->fetchNote();

        if (!$this->validate()) {
            return $this->edit($note);
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

    protected function validate(): bool
    {
        $this->errors = [];
        if (!Validator::string($_POST['body'], 1, 1000)) {
            $this->errors['body'] = 'A body of no more than 1,000 characters is required.';
        }
        return empty($this->errors);
    }
}
