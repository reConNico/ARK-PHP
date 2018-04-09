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

class Transactions extends AbstractAPI
{
  /**
   * @param  array $query
   * @return \Illuminate\Support\Collection
   */
  public function all (string $query): Collection {
    return $this->get('transactions', $query);
  }

  /**
   * @param  string $id
   * @return \Illuminate\Support\Collection
   */
  public function get (string $id): Collection {
    return $this->get('transactions/get', compact('id'));
  }

  /**
   * @param  array $query
   * @return \Illuminate\Support\Collection
   */
  public function allUnconfirmed (string $query): Collection {
    return $this->get('transactions/unconfirmed', $query);
  }

  /**
   * @param  string $id
   * @return \Illuminate\Support\Collection
   */
  public function getUnconfirmed (string $id): Collection {
    return $this->get('transactions/unconfirmed/get', compact('id'));
  }
}
