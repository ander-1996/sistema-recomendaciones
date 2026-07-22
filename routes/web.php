<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

Route::get('/crear-admin', function () {

    Role::firstOrCreate(['name' => 'admin']);

    $user = User::updateOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Administrador',
            'password' => Hash::make('Admin12345'),
        ]
    );

    $user->assignRole('admin');

    return 'Administrador creado correctamente';
});