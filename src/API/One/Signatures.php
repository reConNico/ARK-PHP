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

namespace ArkEcosystem\Ark\API\One;

use ArkEcosystem\Ark\API\AbstractAPI;
use Illuminate\Support\Collection;

class Signatures extends AbstractAPI
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function fee(): Collection
    {
        return $this->get('api/signatures/fee');
    }
}
