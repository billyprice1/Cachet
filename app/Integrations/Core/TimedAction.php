<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Integrations\Core;

use CachetHQ\Cachet\Integrations\Contracts\TimedAction as TimedActionContract;
use CachetHQ\Cachet\Models\TimedAction as TimedActionModel;

/**
 * This is the timed action repository class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimedAction implements TimedActionContract
{
    /**
     * The date factory instance.
     *
     * @var \CachetHQ\Cachet\Dates\DateFactory
     */
    protected $dates;

    /**
     * Create a new timed action instance.
     *
     * @param \CachetHQ\Cachet\Dates\DateFactory $dates
     *
     * @return void
     */
    public function __construct(DateFactory $dates)
    {
        $this->dates = $dates;
    }

    /**
     * Get the current instance.
     *
     * @param \CachetHQ\Cachet\Integrations\Contracts\TimedAction $action
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function current(TimedActionModel $action)
    {
        // todo graham
    }

    /**
     * Get the previous instance.
     *
     * @param \CachetHQ\Cachet\Models\TimedAction $action
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function previous(TimedActionModel $action)
    {
        return $action->instances()->where('');
    }

    /**
     * Record an instance.
     *
     * @param \CachetHQ\Cachet\Models\TimedAction $action
     * @param array                               $data
     *
     * @return \CachetHQ\Cachet\Models\TimedActionInstance
     */
    public function record(TimedActionModel $action, array $data)
    {
        return TimedActionModel::create(
            array_merge([
                'timed_action_id' => $action->id,
            ], $data)
        );
    }
}
