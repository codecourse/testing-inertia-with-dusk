<?php

use App\Models\Task;
use App\Models\User;
use Laravel\Dusk\Browser;

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
