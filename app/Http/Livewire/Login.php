<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => '',
    ];

    protected $rules = [
        'form.email' => 'required|email',
        'form.password' => 'required',
    ];

    public function submit()
    {
        $this->validate();
        
        if (!Auth::attempt($this->form)) {
            session()->flash('auth_error', 'Неверный логин или пароль');
            return redirect()->back();
        }
        return redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.login');
    }
}
