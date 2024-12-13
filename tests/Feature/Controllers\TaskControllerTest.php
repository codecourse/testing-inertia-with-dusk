<?php

it('has controllers\taskcontroller page', function () {
    $response = $this->get('/controllers\taskcontroller');

    $response->assertStatus(200);
});
