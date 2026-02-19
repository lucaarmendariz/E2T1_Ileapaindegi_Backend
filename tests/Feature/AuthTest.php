<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('protected routes require authentication', function () {
    $response = $this->getJson('/api/students');
    $response->assertStatus(401);
});

test('authenticated user can access protected route', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/students');
    $response->assertStatus(200);
});
