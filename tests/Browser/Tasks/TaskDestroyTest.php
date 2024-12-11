<?php

use App\Models\Task;
use App\Models\User;
use Laravel\Dusk\Browser;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('deletes a task', function () {
    $user = User::factory()->create();

    $tasks = Task::factory()
        ->times(2)
        ->for($user)
        ->create();

    $this->browse(function (Browser $browser) use ($user, $tasks) {
        $browser
                ->loginAs($user)
                ->visit(route('tasks.index'))
                ->press('@taskDeleteButton')
                ->acceptDialog()
                ->waitUntilMissingText($tasks->first()->title);
    });

    assertDatabaseMissing('tasks', [
        'id' => $tasks->first()->id,
    ]);
});

it('can cancel deleting a task', function () {
    $user = User::factory()->create();

    $task = Task::factory()
        ->for($user)
        ->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser
            ->loginAs($user)
            ->visit(route('tasks.index'))
            ->press('@taskDeleteButton')
            ->dismissDialog()
            ->waitForLocation(route('tasks.index'));
    });

    assertDatabaseHas('tasks', [
        'id' => $task->id
    ]);
});
