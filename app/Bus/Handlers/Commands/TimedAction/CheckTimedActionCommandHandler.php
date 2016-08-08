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

use CachetHQ\Cachet\Bus\Commands\TimedAction\CheckTimedActionCommand;

/**
 * This is the check timed action command handler class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class CheckTimedActionCommandHandler
{
    /**
     * Create a new check timed action command handler instance.
     *
     * @param \CachetHQ\Cachet\Bus\Commands\TimedAction\CheckTimedActionCommand $command
     *
     * @return void
     */
    public function handle(CheckTimedActionCommand $command)
    {
        //
    }
}
