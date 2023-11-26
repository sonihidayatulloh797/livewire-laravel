<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

class Create extends Component
{

    use WithFileUploads;

    // Validasi pada livewire seperti ini
    #[Rule('required', message: 'Masukkan Gambar Post')]
    #[Rule('image', message: 'File Harus Gambar')]
    #[Rule('max:1024', message: 'Ukuran File Maksimal 1MB')]
    public $image;

    #[Rule('required', message: 'Masukan Judul Post')]
    public $title;

    #[Rule('required', message: 'Masukan Isi Post')]
    #[Rule('min:3', message: 'Isi Post Minimal 3 Karakter')]
    public $content;

    public function store()
    {
        $this->validate();

        $this->image->storeAs('public/posts', $this->image->hashName());

        Post::create([
            'image' => $this->image->hashName(),
            'title' => $this->title,
            'content' => $this->content
        ]);

        session()->flash('message','Data berhasil disimpan');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.post.create');
    }
}
