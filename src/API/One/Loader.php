<?php

declare(strict_types=1);

/*
 * This file is part of ARK PHP.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Ark\API\One;

use BrianFaust\Ark\API\AbstractAPI;
use Illuminate\Support\Collection;

class Loader extends AbstractAPI
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function status(): Collection
    {
        return $this->get('loader/autoconfigure');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function syncing(): Collection
    {
        return $this->get('loader/status');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function configuration(): Collection
    {
        return $this->get('loader/status/sync');
    }
}
