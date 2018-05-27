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

namespace BrianFaust\Tests\Ark\API\One;

use BrianFaust\Tests\Ark\TestCase;

/**
 * @coversNothing
 */
class PeerTest extends TestCase
{
    /** @test */
    public function can_get_peers()
    {
        // Act...
        $response = $this->getClient()->api('Peers')->all();

        // Assert...
        $this->assertInstanceOf('Illuminate\Support\Collection', $response);
    }

    /** @test */
    public function can_get_version()
    {
        // Act...
        $response = $this->getClient()->api('Peers')->version();

        // Assert...
        $this->assertInstanceOf('Illuminate\Support\Collection', $response);
    }

    /** @test */
    public function can_get_peer()
    {
        // Arrange...
        $ip = '167.114.29.33';
        $port = 4001;

        // Act...
        $response = $this->getClient()->api('Peers')->show($ip, $port);

        // Assert...
        $this->assertInstanceOf('Illuminate\Support\Collection', $response);
    }
}
