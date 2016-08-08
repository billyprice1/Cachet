<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use CachetHQ\Cachet\Models\Component;
use CachetHQ\Cachet\Models\ComponentGroup;
use CachetHQ\Cachet\Models\Incident;
use CachetHQ\Cachet\Models\IncidentTemplate;
use CachetHQ\Cachet\Models\Metric;
use CachetHQ\Cachet\Models\MetricPoint;
use CachetHQ\Cachet\Models\Subscriber;
use CachetHQ\Cachet\Models\Subscription;
use CachetHQ\Cachet\Models\TimedAction;
use CachetHQ\Cachet\Models\TimedActionGroup;
use CachetHQ\Cachet\Models\TimedActionInstance;
use CachetHQ\Cachet\Models\User;
use Carbon\Carbon;

$factory->define(Component::class, function ($faker) {
    return [
        'name'        => $faker->sentence(),
        'description' => $faker->paragraph(),
        'link'        => $faker->url(),
        'status'      => random_int(1, 4),
        'order'       => 0,
    ];
});

$factory->define(ComponentGroup::class, function ($faker) {
    return [
        'name'      => $faker->words(2, true),
        'order'     => 0,
        'collapsed' => random_int(0, 3),
    ];
});

$factory->define(Incident::class, function ($faker) {
    return [
        'name'    => $faker->sentence(),
        'message' => $faker->paragraph(),
        'status'  => random_int(1, 4),
        'visible' => 1,
    ];
});

$factory->define(IncidentTemplate::class, function ($faker) {
    return [
        'name'     => 'Test Template',
        'slug'     => 'test-template',
        'template' => "Name: {{ name }},\nMessage: {{ message }}",
    ];
});

$factory->define(Metric::class, function ($faker) {
    return [
        'name'          => $faker->sentence(),
        'suffix'        => $faker->word(),
        'description'   => $faker->paragraph(),
        'default_value' => 1,
        'places'        => 2,
        'calc_type'     => $faker->boolean(),
        'display_chart' => $faker->boolean(),
        'threshold'     => 5,
    ];
});

$factory->define(MetricPoint::class, function ($faker) {
    return [
        'metric_id' => factory(Metric::class)->create()->id,
        'value'     => random_int(1, 100),
        'counter'   => 1,
    ];
});

$factory->define(Subscriber::class, function ($faker) {
    return [
        'email'       => $faker->safeEmail,
        'verify_code' => 'Mqr80r2wJtxHCW5Ep4azkldFfIwHhw98M9HF04dn0z',
        'verified_at' => Carbon::now(),
    ];
});

$factory->define(Subscription::class, function ($faker) {
    return [
        'subscriber_id' => factory(Subscriber::class)->create()->id,
        'component_id'  => factory(Component::class)->create()->id,
    ];
});

$factory->define(TimedActionGroup::class, function ($faker) {
    return [
        'name'  => $faker->sentence,
        'order' => 0,
    ];
});

$factory->define(TimedAction::class, function ($faker) {
    return [
        'name'                  => $faker->sentence(2),
        'timed_action_group_id' => factory(TimedActionGroup::class)->create()->id,
        'description'           => $faker->sentence(),
        'active'                => true,
        'timezone'              => $faker->timezone,
        'window_length'         => 3600,
        'completion_latency'    => 1800,
        'start_at'              => Carbon::now()->addHour(),
    ];
});

$factory->define(TimedActionInstance::class, function ($faker) {
    $startedAt = Carbon::now();
    $completedAt = Carbon::now()->addMinutes(30);

    return [
        'timed_action_id' => factory(TimedAction::class)->create()->id,
        'message'         => $faker->sentence(),
        'status'          => 0,
        'started_at'      => $startedAt,
        'completed_at'    => $completedAt,
    ];
});

$factory->define(User::class, function ($faker) {
    return [
        'username'       => $faker->userName,
        'email'          => $faker->safeEmail,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
        'api_key'        => str_random(20),
        'active'         => true,
        'level'          => 1,
    ];
});
