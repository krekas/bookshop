<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class ReviewsCount extends Component
{
    public $count = 0;
    public $bookId;

    protected $listeners = ['updateReviewsCount' => '$refresh'];

    public function updateReviewsCount()
    {
        $this->count++;
    }

    public function render()
    {
        $this->count = Review::with('user')->latest()->where('book_id', $this->bookId)->count();

        return view('livewire.reviews-count', ['count' => $this->count]);
    }
}
