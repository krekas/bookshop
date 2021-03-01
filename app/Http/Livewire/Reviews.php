<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class Reviews extends Component
{
    public $review;
    public $rating;
    public $bookId;
    public $page;
    public $perPage = 3;

    protected $rules = [
        'review' => 'required'
    ];

    public function mount($page = 1, $perPage = 3)
    {
        $this->page = $page ? $page : 1;
        $this->perPage = $perPage ? $perPage : 1;
    }

    public function render()
    {
        $reviews = Review::with('user')->latest()->where('book_id', $this->bookId)->paginate($this->perPage, ['*'], null, $this->page);

        return view('livewire.reviews', compact('reviews'));
    }

    public function load()
    {
        $this->perPage += $this->perPage;
    }

    public function submitReview()
    {
        $this->validate();

        auth()->user()->reviews()->create([
            'book_id' => $this->bookId,
            'review' => $this->review,
            'rating' => $this->rating
        ]);

        $this->render();

        $this->emit('updateReviewsCount');
        $this->emit('updateRatingCount');

        $this->reset(['review', 'rating']);
    }
}
