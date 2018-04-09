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

class Delegates extends AbstractAPI
{
  /**
   * @param  string $query
   * @return \Illuminate\Support\Collection
   */
  public function all (string $query): Collection {
    return $this->get('delegates', $query);
  }

  /**
   * @param  string $id
   * @return \Illuminate\Support\Collection
   */
  public function get (string $id): Collection {
    return $this->get('delegates/get', compact('id'));
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function count (): Collection {
    return $this->get('delegates/count');
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function fee (): Collection {
    return $this->get('delegates/fee');
  }

  /**
   * @param  string $generatorPublicKey
   * @return \Illuminate\Support\Collection
   */
  public function forged (string $generatorPublicKey): Collection {
    return $this->get('delegates/forging/getForgedByAccount', compact('generatorPublicKey'));
  }

  /**
   * @param  string $query
   * @return \Illuminate\Support\Collection
   */
  public function search (string $query): Collection {
    return $this->get('delegates/search', $query);
  }

  /**
   * @param  string $publicKey
   * @return \Illuminate\Support\Collection
   */
  public function voters (string $publicKey): Collection {
    return $this->get('delegates/voters', compact('publicKey'))
  }
}
