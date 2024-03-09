<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notes;
use App\Models\Status;
class NoteFixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $noStatus = Status::create([
            'name' => 'No Status',
            'class' => 'badge badge-pill badge-info',

        ]);
        $NullStatusInNotes = Notes::whereNull('status_id')->get();

        foreach ($NullStatusInNotes as $note)
        {
            $note->update(['status_id' => $noStatus->id]);
        }

    }
}
