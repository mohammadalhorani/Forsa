<?php

namespace App\Http\Controllers;
use App\DataTables\NotesDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notes;
use App\Models\Status;
use App\Notifications\NoteCreated;
use App\Models\User;

use Illuminate\Support\Facades\Notification;





class NotesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $notes = Notes::with('user')->with('status')->paginate( 20 );
    //     return view('dashboard.notes.notesList', ['notes' => $notes]);
    // }

    public function index(NotesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.notes.notesList');
    }

    public function datatables(NotesDataTable $dataTable)
{
    // $data = $dataTable->ajax();
    // dd($data);
    return $dataTable->ajax();
}


    public function create()
    {
        $statuses = Status::all();
        return view('dashboard.notes.create', [ 'statuses' => $statuses ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required',
            'status_id'         => 'required',
            'applies_to_date'   => 'required|date_format:Y-m-d',
            'note_type'         => 'required'
        ]);
        $user = auth()->user();
        $note = new Notes();
        $note->title     = $request->input('title');
        $note->content   = $request->input('content');
        $note->status_id = $request->input('status_id');
        $note->note_type = $request->input('note_type');
        $note->applies_to_date = $request->input('applies_to_date');
        $note->users_id = $user->id;
        $note->save();
        $request->session()->flash('message', 'Successfully created note');


        return redirect()->route('notes.index');
    }


    public function show($id)
    {
        $note = Notes::with('user')->with('status')->find($id);
        return view('dashboard.notes.noteShow', [ 'note' => $note ]);
    }


    public function edit($id)
    {
        $note = Notes::find($id);
        $statuses = Status::all();
        return view('dashboard.notes.edit', [ 'statuses' => $statuses, 'note' => $note ]);
    }


    public function update(Request $request, $id)
    {
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required',
            'status_id'         => 'required',
            'applies_to_date'   => 'required|date_format:Y-m-d',
            'note_type'         => 'required'
        ]);
        $note = Notes::find($id);
        $note->title     = $request->input('title');
        $note->content   = $request->input('content');
        $note->status_id = $request->input('status_id');
        $note->note_type = $request->input('note_type');
        $note->applies_to_date = $request->input('applies_to_date');
        $note->save();
        $request->session()->flash('message', 'Successfully edited note');
        return redirect()->route('notes.index');
    }


    public function destroy($id)
    {
        $note = Notes::find($id);
        if($note){
            $note->delete();
        }
        return redirect()->route('notes.index');
    }
}
