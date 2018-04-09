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

namespace BrianFaust\Ark\API\Two;

use BrianFaust\Ark\API\AbstractAPI;
use Illuminate\Support\Collection;

class Blocks extends AbstractAPI
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return $this->get('blocks');
    }

    /**
     * @param string $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(string $id): Collection
    {
        return $this->get("blocks/{$id}");
    }

    /**
     * @param string $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function transactions(string $id): Collection
    {
        return $this->get("blocks/{$id}/transactions");
    }

    /**
     * @param array $payload
     *
     * @return \Illuminate\Support\Collection
     */
    public function search(array $payload): Collection
    {
        return $this->post('blocks/search', $payload);
    }
}
