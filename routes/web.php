<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

Route::get('/crear-admin', function () {

    $role = Role::firstOrCreate([
        'name' => 'admin',
        'guard_name' => 'web',
    ]);

    $user = User::updateOrCreate(
        ['email' => 'admin@admin.com'],
        [
            'name' => 'Administrador',
            'password' => Hash::make('Admin12345'),
        ]
    );

    if (!$user->hasRole('admin')) {
        $user->assignRole($role);
    }

    return 'Administrador creado correctamente';
});