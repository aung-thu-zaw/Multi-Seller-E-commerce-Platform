<?php

use function Pest\Laravel\artisan;

it('successfully run categories delete command', function () {

    artisan('categories:delete')->assertSuccessful();

});

it('successfully run brands delete command', function () {

    artisan('brands:delete')->assertSuccessful();

});
