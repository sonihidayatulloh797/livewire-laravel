<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    use WithFileUploads;

    public $postID;
    public $image;

    #[Rule('required', message: 'Masukan Judul Post')]
    public $title;

    #[Rule('required', message: 'Masukan Isi Post')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $content;

    public function mount($id)
    {
        $post = Post::find($id);

        $this->postID   = $post->id;
        $this->title    = $post->title;
        $this->content  = $post->content;
    }

    public function update()
    {
        $this->validate();

        $post = Post::find($this->postID);

        // cek if image
        if ($this->image) {
            $this->image->storeAs('public/posts',$this->image->hashName());

            // update post
            $post->update([
                'image' => $this->image->hashName(),
                'title' => $this->title,
                'content' => $this->content
            ]);
        } else {
            // update post
            $post->update([
                'title' => $this->title,
                'content' => $this->content
            ]);
        }

        session()->flash('message','Data berhasil diubah');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.post.edit');
    }
}
