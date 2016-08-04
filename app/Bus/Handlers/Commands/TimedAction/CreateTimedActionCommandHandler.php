<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Bus\Handlers\Commands\TimedAction;

use CachetHQ\Cachet\Bus\Commands\TimedAction\CreateTimedActionCommand;
use CachetHQ\Cachet\Bus\Events\TimedAction\TimedActionWasAddedEvent;
use CachetHQ\Cachet\Models\TimedAction;

/**
 * This is the create timed action command handler.
 *
 * @author James Brooks <james@alt-three.com>
 */
class CreateTimedActionCommandHandler
{
    /**
     * Handle the create timed action command.
     *
     * @param \CachetHQ\Cachet\Bus\Commands\TimedAction\CreateTimedActionCommand $command
     *
     * @return \CachetHQ\Cachet\Models\TimedAction
     */
    public function handle(CreateTimedActionCommand $command)
    {
        $timedAction = TimedAction::create([
            'name'                  => $command->name,
            'description'           => $command->description,
            'active'                => $command->active,
            'timezone'              => $command->timezone,
            'schedule_frequency'    => $command->schedule_frequency,
            'completion_latency'    => $command->completion_latency,
            'timed_action_group_id' => $command->timed_action_group_id,
        ]);

        event(new TimedActionWasAddedEvent($timedAction));

        return $timedAction;
    }
}
