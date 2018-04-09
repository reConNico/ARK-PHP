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

class Accounts extends AbstractAPI
{
    /**
     * @param array $query
     *
     * @return \Illuminate\Support\Collection
     */
    public function all(string $query): Collection
    {
        return $this->get('accounts/getAllAccounts', $query);
    }

    /**
     * @param string $address
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(string $address): Collection
    {
        return $this->get('accounts', compact('address'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function count(): Collection
    {
        return $this->get('accounts/count');
    }

    /**
     * @param string $address
     *
     * @return \Illuminate\Support\Collection
     */
    public function delegates(string $address): Collection
    {
        return $this->get('accounts/delegates', compact('address'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fee(): Collection
    {
        return $this->get('accounts/delegates/fee');
    }

    /**
     * @param string $address
     *
     * @return \Illuminate\Support\Collection
     */
    public function balance(string $address): Collection
    {
        return $this->get('accounts/getBalance', compact('address'));
    }

    /**
     * @param string $address
     *
     * @return \Illuminate\Support\Collection
     */
    public function publicKey(string $address): Collection
    {
        return $this->get('accounts/getPublicKey', compact('address'));
    }

    /**
     * @param array $query
     *
     * @return \Illuminate\Support\Collection
     */
    public function top(string $query): Collection
    {
        return $this->get('accounts/top', $query);
    }
}
