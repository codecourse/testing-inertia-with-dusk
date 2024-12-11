<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('shows a secret key', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser
                ->loginAs($user)
                ->visit('/dashboard')
                ->assertSee('Secret key: def');
    });
});
