<?php

namespace App\Services;

class SHBKEnDeService
{
    private const KEY = 0xFF;

    public function encrypt(string $plaintext): string
    {
        $result = '';

        for ($i = 0; $i < strlen($plaintext); $i++) {
            $result .= strtoupper(
                str_pad(
                    dechex(ord($plaintext[$i]) ^ self::KEY),
                    2,
                    '0',
                    STR_PAD_LEFT
                )
            );
        }

        return $result;
    }

    public function decrypt(string $cipherHex): string
    {
        $result = '';

        for ($i = 0; $i < strlen($cipherHex); $i += 2) {
            $byte = hexdec(substr($cipherHex, $i, 2));
            $result .= chr($byte ^ self::KEY);
        }

        return $result;
    }
}
