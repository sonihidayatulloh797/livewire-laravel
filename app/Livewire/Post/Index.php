<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function destroy($id)
    {
        Post::destroy($id);

        session()->flash('message','Data berhasil dihapus');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }
}
