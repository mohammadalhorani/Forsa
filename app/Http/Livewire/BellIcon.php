<?php

// namespace App\Http\Livewire;

// use Livewire\Component;
// use App\Models\Notes; // Adjust the model namespace as per your application

// class BellIcon extends Component
// {
//     public $lastNewNotes = [];
//     public $unreadCount = 0;
//     public $showContent = false;

//     public function mount()
//     {
//         // Fetch the initial data when the component is mounted
//         $this->lastNewNotes = $this->getLastNewNotes();
//         $this->unreadCount = $this->lastNewNotes->count();
//     }

//     public function render()
//     {
//         return view('livewire.bell-icon');
//     }

//     public function showLastNewNotes()
//     {
//         // Toggle the state
//         $this->showContent = !$this->showContent;

//         // If content is visible, reset unread count
//         if ($this->showContent) {
//             $this->unreadCount = 0;
//         }
//     }

//     protected function getLastNewNotes()
//     {
//         return Notes::latest()->limit(5)->get(); // Adjust the query as per your application
//     }
// }






namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notes;

class BellIcon extends Component
{
    public $lastNotes = [];
    public $unreadCount = 0;
    public $showContent = false;

    public function mount()
    {
      
        $this->lastNotes = $this->getLastNotes(10);


        $this->unreadCount = $this->calculateUnreadCount();


        $this->showContent = $this->unreadCount > 0;
    }

    public function markAsRead($noteId)
    {



          $readNotes=Notes::find($noteId);
          $readNotes->read=true;
          $readNotes->save();

        $this->lastNotes = $this->lastNotes->filter(function ($note) use ($noteId) {
            return $note->id !== $noteId;
        });


        $this->unreadCount = $this->calculateUnreadCount();


        $this->showContent = $this->unreadCount > 0;
    }

    protected function getLastNotes($limit)
    {
        return Notes::latest()->limit($limit)->where('read',false)->get();
    }

    protected function calculateUnreadCount()
    {

        return Notes::where('read', false)->count();
    }

    public function showLastNewNotes()
    {

        $this->showContent = !$this->showContent;
    }

    public function render()
    {
        return view('livewire.bell-icon');
    }
}
