<?php

it('redirects homepage to login page', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('login'));
});

it('can render login page', function () {
    $response = $this->get('/login');

    $response->assertOk();
    $response->assertSee('Telkomsel Inventory');
    $response->assertSee('Email');
    $response->assertSee('Password');
});
