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

use CachetHQ\Cachet\Bus\Commands\TimedAction\ReportTimedActionInstanceCommand;
use CachetHQ\Cachet\Models\TimedActionInstance;

/**
 * This is the report timed action instance command handler.
 *
 * @author James Brooks <james@alt-three.com>
 */
class ReportTimedActionInstanceCommandHandler
{
    /**
     * Handle the report timed action instance command.
     *
     * @param \CachetHQ\Cachet\Bus\Commands\TimedAction\ReportTimedActionInstanceCommand $command
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function handle(ReportTimedActionInstanceCommand $command)
    {
        $actionInstance = TimedActionInstance::create([
            'timed_action_id' => $command->action->id,
            'message'         => $command->message,
            'started_at'      => $command->started_at,
            'completed_at'    => $command->completed_at,
        ]);

        return $actionInstance;
    }
}
