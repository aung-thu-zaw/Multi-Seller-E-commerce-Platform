<?php

use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('prevents non-admin from accessing the dashboard page', function () {
    // ==== Act & Assert ====
    actingAsAuthenticatedUser(role: 'user');

    get(route('admin.dashboard'))->assertForbidden();
});

it('allows admin to access the dashboard page and verifies correct props', function () {
    // ==== Act & Assert ====
    actingAsAuthenticatedUser(role: 'admin');

    get(route('admin.dashboard'))
        ->assertOk()
        ->assertInertia(fn(Assert $page) => $page->component('Admin/Dashboard'));
});
