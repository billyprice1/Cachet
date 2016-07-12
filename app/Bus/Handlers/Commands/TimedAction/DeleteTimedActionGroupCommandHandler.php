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

/**
 * This is the delete timed action group command handler class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class DeleteTimedActionGroupCommandHandler
{
    /**
     * Handle the delete timed action group command.
     *
     * @param \CachetHQ\Cachet\Bus\Commands\TimedAction\DeleteTimedActionGroupCommand $command
     *
     * @return void
     */
    public function handle(DeleteTimedActionGroupCommand $command)
    {
        $command->group->delete();
    }
}
