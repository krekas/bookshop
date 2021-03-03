<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class Rating extends Component
{
    public $rating = 0;
    public $bookId;

    protected $listeners = ['updateRatingCount' => 'render'];

    public function render()
    {
        $this->rating = Review::where('book_id', $this->bookId)->avg('rating');

        return view('livewire.rating');
    }

}
