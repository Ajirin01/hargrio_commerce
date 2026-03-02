<?php
namespace App\Helpers;

class TylHelper
{
    public static function createExtendedHash(array $params, string $sharedSecret): string
    {
        // Remove empty values
        $params = array_filter($params, fn($v) => $v !== null && $v !== '');

        // Sort keys in ASCII order
        ksort($params);

        // Concatenate values with pipe "|"
        $stringToHash = implode('|', array_values($params));

        // Generate HMAC SHA256 and Base64 encode
        return base64_encode(hash_hmac('sha256', $stringToHash, $sharedSecret, true));
    }
}