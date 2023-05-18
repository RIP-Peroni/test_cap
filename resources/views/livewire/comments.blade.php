<div>
    <h1 class="text-3xl">Comments</h1>
    @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    <div>
        @if (session()->has('comment added successfully'))
            <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                {{ session('comment added successfully') }}
            </div>
        @endif
        @if (session()->has('comment removed successfully'))
            <div class="p-3 bg-red-300 text-red-800 rounded shadow-sm">
                {{ session('comment removed successfully') }}
            </div>
        @endif
    </div>

    <section>
        @if($image)
        <img src="{{ $image }}" width="200" alt="">
        @endif
        
        <input type="file" id="image" wire:change="$emit('fileChosen')">
    </section>

    <form class="my-4 flex" wire:submit.prevent="addComment">
        <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's in your mind."
        wire:model.debounce.500ms='newComment'>
        <div class="py-2">
            <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
        </div>
    </form>
    @foreach($comments as $comment)
    <div class="rounded border shadow p-3 my-2">
        <div class="flex justify-between my-2">
            <div class="flex">
                <p class="font-bold text-lg">{{ $comment->creator->name }}</p>
                <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">
                    {{ $comment->created_at->diffForHumans() }}
                </p>
            </div>
            <span class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer"
                wire:click="removeComment({{ $comment->id }})"></span>
        </div>
        <p class="text-gray-800">{{ $comment->body }}</p>
        @if($comment->image)
        <img src="{{ asset('storage/' . $comment->image) }}" alt="">
        @endif
    </div>
    @endforeach

    {{ $comments->links('pagination-links') }}

    <script>
        window.Livewire.on('fileChosen', () => {
            const inputfield = document.getElementById('image');
            const file = inputfield.files[0];
            const reader = new FileReader();
            reader.onloadend = () => {
                window.Livewire.emit('fileUpload', reader.result)
            };
            reader.readAsDataURL(file);
        });
    </script>
</div>
