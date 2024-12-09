<?php

use App\Models\User;
use Laravel\Dusk\Browser;
use function Pest\Laravel\actingAs;

it('can see the dashboard', function () {
    $user = User::factory()->create([
        'name' => 'Mabel'
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser
            ->loginAs($user)
            ->visit('/dashboard')
            ->assertSee('Hey ' . $user->name);
    });
});
