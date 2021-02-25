<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Rating extends Component
{
    public $rating;

    public function render()
    {
        return view('livewire.rating', ['rating' => $this->rating]);
    }
}
