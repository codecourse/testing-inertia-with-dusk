<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('creates a task', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser
                ->loginAs($user)
                ->visit('/tasks/create')
                ->type('title', 'Task 3')
                ->press('@createTaskButton')
                ->waitForLocation('/tasks')
                ->assertSee('Task 3');
    });
});
