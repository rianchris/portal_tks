<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class Home extends Component
{

    // public $title = "Home";

    public function render()
    {
        return view('livewire.home');
    }
}
