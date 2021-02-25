<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Reviews extends Component
{
    public $reviews = [];
    public $review;
    public $rating;
    public $bookId;

    protected $rules = [
        'review' => 'required'
    ];

    public function render()
    {
        return view('livewire.reviews', ['reviews' => $this->reviews]);
    }

    public function submitReview()
    {
        $this->validate();

        auth()->user()->reviews()->create([
            'book_id' => $this->bookId,
            'review' => $this->review,
            'rating' => $this->rating
        ]);

        array_unshift($this->reviews, [
            'user' => ['name' => auth()->user()->name],
            'review' => $this->review
        ]);

        $this->reset(['review', 'rating']);
    }
}
