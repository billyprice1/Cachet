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

use CachetHQ\Cachet\Bus\Commands\TimedAction\CreateTimedActionInstanceCommand;
use CachetHQ\Cachet\Models\TimedActionInstance;

/**
 * This is the create timed action instance command handler.
 *
 * @author James Brooks <james@alt-three.com>
 */
class CreateTimedActionInstanceCommandHandler
{
    /**
     * Handle the create timed action instance command.
     *
     * @param \CachetHQ\Cachet\Bus\Commands\TimedAction\CreateTimedActionInstanceCommand $command
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function handle(CreateTimedActionInstanceCommand $command)
    {
        // Only we should be overriding the status, so assume successful.
        $instanceStatus = $command->status ? $command->status : TimedActionInstance::SUCCESSFUL;

        $instance = TimedActionInstance::create([
            'timed_action_id' => $command->action->id,
            'message'         => $command->message,
            'status'          => $instanceStatus,
            'started_at'      => $command->started_at,
            'completed_at'    => $command->completed_at,
        ]);

        return $instance;
    }
}
