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

use CachetHQ\Cachet\Models\TimedActionGroup;
use CachetHQ\Tests\Cachet\AbstractTestCase;

/**
 * This is the timed action group model test class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimedActionGroupTest extends AbstractTestCase
{
    public function testValidation()
    {
        $this->assertTrue(property_exists(new TimedActionGroup(), 'rules'));
    }
}
