<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostLivewire extends Component
{
    public function render() {
        $noticias=Post::latest('id')->paginate(6);
        return view('livewire.post-livewire',compact('noticias'));
    }
}
