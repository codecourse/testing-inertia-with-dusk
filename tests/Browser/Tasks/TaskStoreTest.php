<?php

use App\Models\User;
use Laravel\Dusk\Browser;
use function Pest\Laravel\assertDatabaseHas;

//it('creates a task', function () {
//    $user = User::factory()->create();
//
//    $this->browse(function (Browser $browser) use ($user) {
//        $browser
//                ->loginAs($user)
//                ->visit('/tasks/create')
//                ->type('title', $title = 'Task 3')
//                ->press('@createTaskButton')
//                ->waitForLocation('/tasks')
//                ->assertSee($title);
//    });
//});

it('creates a task', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser
            ->loginAs($user)
            ->visit('/tasks/create')
            ->type('title', $title = 'Task 3')
            ->press('@createTaskButton')
            ->waitForText('Task created')
            ->assertSee('Task created'); // not needed

        assertDatabaseHas('tasks', [
            'title' => $title
        ]);
    });
});

it('fails if a title is not provided', function () {
    $user = User::factory()->create();

    $this->browse(function (Browser $browser) use ($user) {
        $browser
            ->loginAs($user)
            ->visit(route('tasks.create'))
            ->press('@createTaskButton')
            ->waitFor('@titleValidationError');
            //->waitForText(__('validation.required', ['attribute' => 'title']));
    });
});
