<?php

use App\Models\Task;
use App\Models\User;
use Laravel\Dusk\Browser;
use function Pest\Laravel\assertDatabaseHas;

it('toggles the edit state for a task', function () {
    $user = User::factory()->create();

    $task = Task::factory()->for($user)->create();

    $this->browse(function (Browser $browser) use ($user, $task) {
        $browser
                ->loginAs($user)
                ->visit(route('tasks.index'))
                ->press('@taskEditButton')
                ->assertValue('@taskEditInput', $task->title);
    });
});

it('updates a task title', function () {
    $user = User::factory()->create();

    $task = Task::factory()->for($user)->create();

    $this->browse(function (Browser $browser) use ($user, $task) {
        $browser
            ->loginAs($user)
            ->visit(route('tasks.index'))
            ->press('@taskEditButton')
            ->assertValue('@taskEditInput', $task->title)
            ->type('@taskEditInput', 'A new task title') // can use append
            ->keys('@taskEditInput', '{enter}')
            ->waitUntilMissing('@taskEditInput')
            ->assertSee('A new task title');
    });

    assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'A new task title'
    ]);
});
