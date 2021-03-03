<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class ReviewsCount extends Component
{
    public $count = 0;
    public $bookId;

    protected $listeners = ['updateReviewsCount' => 'render'];

    public function render()
    {
        $this->count = Review::where('book_id', $this->bookId)->count();

        return view('livewire.reviews-count');
    }
}
