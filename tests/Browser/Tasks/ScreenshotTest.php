<?php

use Laravel\Dusk\Browser;

it('creates a screenshot', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/dashboard')
                ->assertSee('Something');
    });
});
