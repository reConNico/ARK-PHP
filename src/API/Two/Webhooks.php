<?php

declare(strict_types=1);

/*
 * This file is part of ARK PHP.
 *
 * (c) Ark Ecosystem <info@ark.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ArkEcosystem\Ark\API\Two;

use ArkEcosystem\Ark\API\AbstractAPI;
use Illuminate\Support\Collection;

class Webhooks extends AbstractAPI
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return $this->get('webhooks');
    }

    /**
     * @param array $payload
     *
     * @return \Illuminate\Support\Collection
     */
    public function create(array $payload): Collection
    {
        return $this->post('webhooks', $payload);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(int $id): Collection
    {
        return $this->get("webhooks/{$id}");
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function update(int $id): Collection
    {
        return $this->put("webhooks/{$id}");
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Support\Collection
     */
    public function delete(int $id): Collection
    {
        return $this->delete("webhooks/{$id}");
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function events(): Collection
    {
        return $this->get('webhooks/events');
    }
}
