<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Tests\Cachet\Api;

/**
 * This is the timed action test class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimedActionTest extends AbstractApiTestCase
{
    public function testGetActionsUnauthorized()
    {
        factory('CachetHQ\Cachet\Models\TimedAction')->create();

        $this->get('/api/v1/actions');
        $this->assertResponseStatus(401);
    }

    public function testGetActions()
    {
        $this->beUser();

        $action = factory('CachetHQ\Cachet\Models\TimedAction')->create();

        $this->get('/api/v1/actions');
        $this->seeJson($action->toArray());
    }

    public function testGetAction()
    {
        $this->beUser();

        $action = factory('CachetHQ\Cachet\Models\TimedAction')->create();

        $this->get('/api/v1/actions/'.$action->id);
        $this->seeJson($action->toArray());
    }

    public function testGetActionInstances()
    {
        $this->beUser();

        $action = factory('CachetHQ\Cachet\Models\TimedAction')->create();
        $instance = factory('CachetHQ\Cachet\Models\TimedActionInstance')->create([
            'timed_action_id' => $action->id,
        ]);

        $this->get('/api/v1/actions/'.$action->id.'/instances');
        $this->seeJson($instance->toArray());
    }

    public function testGetActionInstance()
    {
        $this->beUser();

        $instance = factory('CachetHQ\Cachet\Models\TimedActionInstance')->create();

        $this->get('/api/v1/actions/'.$instance->timed_action_id.'/instances/'.$instance->id);
        $this->seeJson($instance->toArray());
    }

    public function testPostAction()
    {
        $this->beUser();

        $action = factory('CachetHQ\Cachet\Models\TimedAction')->make([
            'timed_action_group_id' => null,
        ]);

        $this->post('/api/v1/actions/', $action->toArray());
        $this->seeJson($action->toArray());
    }

    public function testPostActionInstance()
    {
        $this->beUser();

        $action = factory('CachetHQ\Cachet\Models\TimedAction')->create();
        $instance = factory('CachetHQ\Cachet\Models\TimedActionInstance')->make([
            'timed_action_id' => $action->id,
        ]);

        $this->post('/api/v1/actions/'.$action->id.'/instances', $instance->toArray());
        $this->seeJson($instance->toArray());
    }

    public function testPutAction()
    {
        $this->beUser();

        $action = factory('CachetHQ\Cachet\Models\TimedAction')->create([
            'timed_action_group_id' => null,
        ]);

        $this->put('/api/v1/actions/'.$action->id, [
            'name' => 'Test',
        ]);
        $this->seeJson(['name' => 'Test']);
    }
}
