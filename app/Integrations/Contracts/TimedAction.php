<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Integrations\Contracts;

use CachetHQ\Cachet\Models\TimedAction as TimedActionModel;

/**
 * This is the timed action interface.
 *
 * @author James Brooks <james@alt-three.com>
 */
interface TimedAction
{
    /**
     * Get the current instance.
     *
     * @param \CachetHQ\Cachet\Integrations\Contracts\TimedAction $action;
     *
     * @throws \CachetHQ\Cachet\Integrations\Core\InstanceIsLateException
     * @throws \CachetHQ\Cachet\Integrations\Core\InstanceIsPendingException
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function current(TimedActionModel $action);

    /**
     * Get the previous instance.
     *
     * @throws \CachetHQ\Cachet\Integrations\Exceptions\InstanceIsLateException
     * @throws \CachetHQ\Cachet\Integrations\Exceptions\InstanceIsPendingException
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function previous(TimedActionModel $action);

    /**
     * Record an instance.
     *
     * @param \CachetHQ\Cachet\Models\TimedAction $action
     * @param array                               $data
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function record(TimedActionModel $action, array $data);
}
