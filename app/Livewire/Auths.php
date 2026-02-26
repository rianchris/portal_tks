<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Auths extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            session()->regenerate();
            $this->reset(['email', 'password']); // clear fields
            return redirect()->intended(route('home'));
        }

        // Clear password on failed login (security)
        $this->reset('password');
        $this->addError('email', 'Email atau password salah.');
    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login'); // atau route apapun
    }
    public function render()
    {
        return view('livewire.auth');
    }
}
