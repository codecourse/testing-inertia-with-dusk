<?php

use Laravel\Dusk\Browser;

it('can register an account', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/register')
            ->type('#name', 'Mabel')
            ->type('#email', 'mabel@codecourse.com')
            ->type('#password', $password = 'password')
            ->type('#password_confirmation', $password)
            ->press('REGISTER')
            ->waitForLocation('/dashboard')
            ->assertPathIs('/dashboard')
            ->assertAuthenticated();
    });
});
