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

namespace ArkEcosystem\Ark\Utils;

use ArkEcosystem\Ark\Builder\TransactionBuilder;
use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Crypto\EcAdapter\Impl\PhpEcc\Key\PrivateKey;
use BitWasp\Bitcoin\Crypto\Hash;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Key\PublicKeyFactory;
use BitWasp\Bitcoin\Network\NetworkFactory;
use BitWasp\Bitcoin\Network\NetworkInterface;
use BitWasp\Bitcoin\Signature\SignatureFactory;
use BitWasp\Buffertools\Buffer;

class Crypto
{
    /**
     * Compute an ARK Address from the given public key.
     *
     * @param string $publicKey
     * @param int $version
     * @return string
     * @internal param string $secret
     */
    public static function address(string $publicKey, int $version = 0x17): string
    {
        // Public Key
        $ripemd160 = hash('ripemd160', hex2bin($publicKey), true);

        // Seed
        $seed = pack('C*', $version).$ripemd160;

        // Encode
        return Base58::encodeCheck($seed);
    }

    /**
     * Validate an ARK Address.
     *
     * @param string $address
     * @param string $networkVersion
     *
     * @return bool
     * @throws \Exception
     */
    public static function validateAddress(string $address, string $networkVersion = '17'): bool
    {
        // Base58 decode the address
        $address = new Buffer(Base58::decode($address));

        // Get the network version
        $prefixByte = $address->slice(0, 1)->getHex();

        // Compare address' network version with given $networkVersion
        return $prefixByte === $networkVersion;
    }

    /**
     * Compute an WIF address from the given secret.
     *
     * @param string $secret
     * @param int    $wif
     *
     * @return string
     */
    public static function wif(string $secret, int $wif = 0xaa): string
    {
        // Hash the secret
        $secret = hash('sha256', $secret, true);

        // Seed
        $seed = pack('C*', $wif).$secret.pack('C*', 0x01);

        // Encode
        return Base58::encodeCheck($seed);
    }

    /**
     * @param string $secret
     *
     * @return \BitWasp\Bitcoin\Crypto\EcAdapter\Key\PrivateKeyInterface
     */
    public static function getKeys(string $secret): \BitWasp\Bitcoin\Crypto\EcAdapter\Key\PrivateKeyInterface
    {
        $seed = self::bchexdec(hash('sha256', $secret));

        return PrivateKeyFactory::fromInt($seed, true);
    }

    /**
     * @param PrivateKey $privateKey
     * @param NetworkInterface|null $network
     *
     * @return string
     */
    public static function getAddress(PrivateKey $privateKey, NetworkInterface $network = null)
    {
        $publicKey = $privateKey->getPublicKey();
        $digest = Hash::ripemd160(new Buffer($publicKey->getBinary()));
        if (!$network) {
            $network = NetworkFactory::create('17', '00', '00');
        }

        return (new PayToPubKeyHashAddress($digest))->getAddress($network);
    }

    /**
     * @param string $message
     * @param string $passphrase
     *
     * @return array
     * @throws \Exception
     */
    public static function signMessage(string $message, string $passphrase): array
    {
        $keys = self::getKeys($passphrase);

        return [
            'publicKey' => $keys->getPublicKey()->getHex(),
            'signature' => $keys->sign(Hash::sha256(new Buffer($message)))->getBuffer()->getHex(),
        ] + compact('message');
    }

    /**
     * @param string $message
     * @param string $publicKey
     * @param string $signature
     *
     * @return bool
     * @throws \Exception
     */
    public static function verifyMessage(string $message, string $publicKey, string $signature): bool
    {
        return PublicKeyFactory::fromHex($publicKey)->verify(
            new Buffer(hash('sha256', $message, true)),
            SignatureFactory::fromHex($signature)
        );
    }

    /**
     * @param object $transaction
     *
     * @return bool
     * @throws \Exception
     */
    public static function verify(object $transaction): bool
    {
        $publicKey = PublicKeyFactory::fromHex($transaction->senderPublicKey);
        $bytes = TransactionBuilder::getBytes($transaction);

        return $publicKey->verify(
            new Buffer(hash('sha256', $bytes, true)),
            SignatureFactory::fromHex($transaction->signature)
        );
    }

    /**
     * @param object $transaction
     * @param string $secondPublicKeyHex
     *
     * @return bool
     * @throws \Exception
     */
    public static function secondVerify(object $transaction, string $secondPublicKeyHex): bool
    {
        $secondPublicKeys = PublicKeyFactory::fromHex($secondPublicKeyHex);
        $bytes = TransactionBuilder::getBytes($transaction, false);

        return $secondPublicKeys->verify(
            new Buffer(hash('sha256', $bytes, true)),
            SignatureFactory::fromHex($transaction->signSignature)
        );
    }

    /**
     * hexdec but for integers that are bigger than the largest PHP integer
     * https://stackoverflow.com/questions/1273484/large-hex-values-with-php-hexdec.
     *
     * @param $hex
     *
     * @return int|string
     */
    private static function bchexdec(string $hex)
    {
        $dec = '0';
        $len = strlen($hex);
        for ($i = 1; $i <= $len; $i++) {
            $dec = bcadd($dec, bcmul((string)hexdec($hex[$i - 1]), bcpow('16', (string)($len - $i))));
        }

        return $dec;
    }
}
