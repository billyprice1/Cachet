<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Models;

use AltThree\Validator\ValidatingTrait;
use CachetHQ\Cachet\Models\Traits\SearchableTrait;
use CachetHQ\Cachet\Models\Traits\SortableTrait;
use CachetHQ\Cachet\Presenters\TimedActionPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

/**
 * This is the timed action model.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimedAction extends Model implements HasPresenter
{
    use SearchableTrait, SoftDeletes, SortableTrait, ValidatingTrait;

    /**
     * The attributes that should be casted to native types.
     *
     * @var string[]
     */
    protected $casts = [
        'id'                    => 'int',
        'name'                  => 'string',
        'description'           => 'string',
        'active'                => 'bool',
        'start_at'              => 'date',
        'timezone'              => 'string',
        'schedule_frequency'    => 'int',
        'completion_latency'    => 'int',
        'timed_action_group_id' => 'int',
    ];

    /**
     * The fillable properties.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'timed_action_group_id',
        'description',
        'active',
        'start_at',
        'timezone',
        'schedule_frequency',
        'completion_latency',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'                  => 'string|required',
        'timed_action_group_id' => 'int',
        'description'           => 'string',
        'active'                => 'bool',
        'timezone'              => 'string|required',
        'schedule_frequency'    => 'int|required',
        'completion_latency'    => 'int|required',
    ];

    /**
     * The searchable fields.
     *
     * @var string[]
     */
    protected $searchable = [
        'name',
        'timed_action_group_id',
        'description',
        'active',
        'start_at',
        'timezone',
        'schedule_frequency',
        'completion_latency',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The sortable fields.
     *
     * @var string[]
     */
    protected $sortable = [
        'id',
        'name',
        'timed_action_group_id',
        'description',
        'active',
        'start_at',
        'timezone',
        'schedule_frequency',
        'completion_latency',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the instances relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instances()
    {
        return $this->hasMany(TimedActionInstance::class);
    }

    /**
     * Get the group relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(TimedActionGroup::class, 'timed_action_group_id', 'id');
    }

    /**
     * Scope timed actions to active.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope timed actions to inactive.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInactive(Builder $query)
    {
        return $query->where('active', false);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return TimedActionPresenter::class;
    }
}
