<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Tests\Cachet\Bus\Events\TimedAction;

use CachetHQ\Cachet\Bus\Events\TimedAction\TimedActionWasAddedEvent;
use CachetHQ\Cachet\Models\TimedAction;

/**
 * This is the timed action was added event test.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimedActionWasAddedEventTest extends AbstractTimedActionEventTestCase
{
    protected function objectHasHandlers()
    {
        return false;
    }

    protected function getObjectAndParams()
    {
        $params = ['action' => new TimedAction()];
        $object = new TimedActionWasAddedEvent($params['action']);

        return compact('params', 'object');
    }
}
