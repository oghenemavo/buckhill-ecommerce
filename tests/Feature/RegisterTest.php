<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has errors if the details are not provided', function() {
    $response = $this->postJson('/api/v1/user/create', []);
    $response->assertStatus(422);

    expect($response->json())->toHaveKeys(['message', 'errors']);
});