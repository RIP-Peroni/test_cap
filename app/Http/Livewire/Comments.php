<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use App\Models\Comment;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $newComment;
    public $image;
    public $ticketId = 1;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected' => 'handleTicketSelected'
    ];

    protected $rules = [
        'newComment' => 'required|max:255',
    ];

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function handleTicketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function updated($newComment)
    {
        $this->validateOnly($newComment);
    }

    public function addComment()
    {
        $this->validate(($this->rules));
        $image = $this->storeImage();
        Comment::create([
            'body' => $this->newComment, 'user_id' => 1,
            'image' => $image,
            'support_ticket_id' => $this->ticketId,
        ]);
        $this->newComment = '';
        $this->image = '';
        session()->flash('comment added successfully', 'Comment added successfully 😀');
    }

    public function storeImage()
    {
        if(!$this->image) {
            return null;
        }
        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function removeComment($commentId)
    {
        $commentToDestroy = Comment::find($commentId);
        $commentToDestroy->delete();

        Storage::disk('public')->delete($commentToDestroy->image);
        
        session()->flash('comment removed successfully', 'Comment removed successfully 😔');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2),
        ]);
    }
}
