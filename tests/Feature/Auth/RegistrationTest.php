<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('registration screen can be rendered', function () {
    Role::create([
        'name' => 'staff',
    ]);

    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $staffRole = Role::create([
        'name' => 'staff',
    ]);

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role_id' => $staffRole->id,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors();

    $this->assertAuthenticated();

    $response->assertRedirect(route('dashboard', absolute: false));

    $this->assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'role_id' => $staffRole->id,
    ]);

    $user = User::where('email', 'test@example.com')->first();

    expect($user)->not->toBeNull();
    expect(Hash::check('password', $user->password))->toBeTrue();
});
