<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Console\Commands;

use Illuminate\Console\Command;

/**
 * This is the time sensitive action instance generator command class.
 *
 * @author James Brooks <james@alt-three.com>
 */
class TimeSensitiveActionInstanceGeneratorCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cachet:tsaigenerator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates time sensitive action instances.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // todo graham
    }
}
