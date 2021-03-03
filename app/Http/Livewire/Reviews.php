<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class Reviews extends Component
{
    public $review;
    public $rating;
    public $bookId;
    public $page = 1;
    public $perPage = 3;

    protected $rules = [
        'review' => 'required'
    ];

    public function render()
    {
        $query = Review::with('user')->latest()->where('book_id', $this->bookId);
        $reviews = $query->take($this->perPage)->get();
        $reviewsCount = $query->count();

        return view('livewire.reviews', compact('reviews', 'reviewsCount'));
    }

    public function load()
    {
        $this->perPage += 3;
    }

    public function submitReview()
    {
        $this->validate();

        auth()->user()->reviews()->create([
            'book_id' => $this->bookId,
            'review' => $this->review,
            'rating' => $this->rating
        ]);

        $this->emit('updateReviewsCount');
        $this->emit('updateRatingCount');

        $this->reset(['review', 'rating']);
    }
}
