<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('can not delete tasks that do not belong to us', function () {
    $user = User::factory()->create();

    $task = Task::factory()->for(User::factory())->create();

    actingAs($user)
        ->delete(route('tasks.destroy', $task))
        ->assertForbidden();
});

it('can not update tasks that do not belong to us', function () {
    $user = User::factory()->create();

    $task = Task::factory()->for(User::factory())->create();

    actingAs($user)
        ->patch(route('tasks.update', $task), [
            'title' => 'New title'
        ])
        ->assertForbidden();
});
