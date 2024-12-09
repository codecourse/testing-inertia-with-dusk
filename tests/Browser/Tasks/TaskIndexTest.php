<?php

use App\Models\Task;
use App\Models\User;
use Laravel\Dusk\Browser;

it('shows the tasks page', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser
                ->loginAs($user)
                ->visit('/tasks')
                ->with('@authenticatedLayoutHeader', function (Browser $browser) {
                    $browser->assertSee('Tasks');
                });
                //->assertSeeIn('@authenticatedLayoutHeader', 'Tasks');
    });
});

it('shows a list of tasks', function () {
    $user = User::factory()->create();

    $tasks = Task::factory()
        ->times(3)
        ->for($user)
        ->create();

    $this->browse(function (Browser $browser) use ($user, $tasks) {
        $browser
            ->loginAs($user)
            ->visit('/tasks');

        $elements = $browser->elements('@taskItem');

        expect($elements)->toHaveCount(3);

        $tasks->each(function (Task $task) use ($browser) {
            $browser->assertSee($task->title);
        });
    });
});
