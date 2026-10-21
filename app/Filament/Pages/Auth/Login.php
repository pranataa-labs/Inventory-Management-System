<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected static string $view = 'filament.pages.auth.login';

    public function getHeading(): string | Htmlable
    {
        return 'Masuk ke Sistem';
    }

    public function getSubHeading(): string | Htmlable | null
    {
        return 'Kelola inventaris dan operasional gudang dengan mudah';
    }

    public function fillDemo(string $role): void
    {
        if ($role === 'admin') {
            $this->form->fill([
                'email' => 'admin@inventory.test',
                'password' => 'password',
                'remember' => true,
            ]);
        } elseif ($role === 'staff') {
            $this->form->fill([
                'email' => 'staff@inventory.test',
                'password' => 'password',
                'remember' => true,
            ]);
        }
    }
}
