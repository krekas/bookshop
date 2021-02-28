<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class Reviews extends Component
{
    public $reviews = [];
    public $review;
    public $rating;
    public $bookId;
    public $amount = 3;

    protected $rules = [
        'review' => 'required'
    ];

    public function render()
    {
        $this->reviews = Review::with('user')->latest()->where('book_id', $this->bookId)->take($this->amount)->get()->toArray();

        return view('livewire.reviews', ['reviews' => $this->reviews]);
    }

    public function load()
    {
        $this->amount += 3;
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

        $this->emit('updateReviewsCount');
        $this->emit('updateRatingCount');

        $this->reset(['review', 'rating']);
    }
}
