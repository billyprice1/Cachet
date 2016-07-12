<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Presenters;

use CachetHQ\Cachet\Dates\DateFactory;
use CachetHQ\Cachet\Presenters\Traits\TimestampsTrait;
use DateInterval;
use Illuminate\Contracts\Support\Arrayable;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * This is the timed action presenter class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimedActionPresenter extends BasePresenter implements Arrayable
{
    use TimestampsTrait;

    /**
     * Calculate the next schedule time, using the timezone and schedule frequency.
     *
     * @return string
     */
    public function next_schedule_time()
    {
        $date = app(DateFactory::class)->make($this->wrappedObject->start_at)->setTimezone($this->wrappedObject->timezone);
        $date->add(new DateInterval('PT'.$this->wrappedObject->schedule_frequency.'S'));

        return $date->toDateTimeString();
    }

    /**
     * Get the group name.
     *
     * @return string|null
     */
    public function group_name()
    {
        return isset($this->wrappedObject->group->name) ? $this->wrappedObject->group->name : null;
    }

    /**
     * Convert the presenter instance to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return array_merge($this->wrappedObject->toArray(), [
            'group_name'         => $this->group_name(),
            'next_schedule_time' => $this->next_schedule_time(),
            'created_at'         => $this->created_at(),
            'updated_at'         => $this->updated_at(),
        ]);
    }
}
