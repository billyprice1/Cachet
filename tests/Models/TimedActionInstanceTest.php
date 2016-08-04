<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Tests\Cachet\Models;

use CachetHQ\Cachet\Models\TimedActionInstance;
use CachetHQ\Tests\Cachet\AbstractTestCase;

/**
 * This is the timed action instance model test class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimedActionInstanceTest extends AbstractTestCase
{
    public function testValidation()
    {
        $this->assertTrue(property_exists(new TimedActionInstance(), 'rules'));
    }
}
