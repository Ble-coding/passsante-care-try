<?php

namespace App\Http\Livewire;

use Livewire\Component;



class LiveZoom extends Component
{

    public $consultation_title;
    public $consultation_date;
    public $duration_in_minute;
    public $staff_list;
    public $host_video;
    public $participant_video;
    public $description;


    public function render()
    {
        return view('livewire.live-zoom');
    }

    public function createMeeting()
    {
        $validatedData = $this->validate([
            'consultation_title' => 'required|string|max:255',
     'consultation_date' => 'required|date_format:Y-m-d H:i',
            'duration_in_minute' => 'required|integer|min:0|max:720',
            'staff_list' => 'required|array',
            'host_video' => 'required|boolean',
            'participant_video' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

      // Process your form data and create the meeting
      LiveZoom::create($validatedData);

      // Optionally, you can add a success message or redirect the user
      session()->flash('message', 'Meeting created successfully.');

      // Reset form fields
      $this->reset();
    }

}
