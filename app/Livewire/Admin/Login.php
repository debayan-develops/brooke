<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Config;
use Livewire\Attributes\Title;
#[Title('Login')]
class Login extends Component
{
    public function render()
    {
        $config = Config::get('livewire');
        return view('livewire.login')->layout($config['adminLayout']);
    }
}
