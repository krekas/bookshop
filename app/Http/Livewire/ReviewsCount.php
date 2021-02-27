<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReviewsCount extends Component
{
    public $count = 0;

    protected $listeners = ['updateReviewsCount'];

    public function updateReviewsCount()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.reviews-count', ['count' => $this->count]);
    }
}
