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

class Transactions extends AbstractAPI
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return $this->get('transactions');
    }

    /**
     * @param array $payload
     *
     * @return \Illuminate\Support\Collection
     */
    public function create(array $payload): Collection
    {
        return $this->post('transactions', $payload);
    }

    /**
     * @param string $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(string $id): Collection
    {
        return $this->get("transactions/{$id}");
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function allUnconfirmed(): Collection
    {
        return $this->get('transactions/unconfirmed');
    }

    /**
     * @param string $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUnconfirmed(string $id): Collection
    {
        return $this->get("transactions/unconfirmed/{$id}");
    }

    /**
     * @param array $payload
     *
     * @return \Illuminate\Support\Collection
     */
    public function search(array $payload): Collection
    {
        return $this->post('transactions/search', $payload);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function types(): Collection
    {
        return $this->get('transactions/types');
    }
}
