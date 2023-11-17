<?php

use function Pest\Laravel\artisan;

it('successfully run categories delete command', function () {

    artisan('categories:delete')->assertSuccessful();

});
