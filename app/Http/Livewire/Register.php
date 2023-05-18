<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $form = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    protected $rules = [
        'form.email' => 'required|email',
        'form.name' => 'required',
        'form.password' => 'required|confirmed',
    ];

    public function submit()
    {
        $this->validate();
        User::create($this->form);
        return redirect()->to(route('login'));
    }
    public function render()
    {
        return view('livewire.register');
    }
}
