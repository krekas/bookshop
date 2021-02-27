<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Rating extends Component
{
    public $rating = 0;

    protected $listeners = ['updateRatingCount' => '$refresh'];

    public function render()
    {
        return view('livewire.rating', ['rating' => $this->rating]);
    }

}
