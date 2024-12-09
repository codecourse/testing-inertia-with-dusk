<?php

use App\Models\User;
use Laravel\Dusk\Browser;

test('basic example', function () {
    User::factory()->create();

    $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->assertSee('Laravel');
    });
});
