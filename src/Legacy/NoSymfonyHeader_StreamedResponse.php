<?php

namespace App\Legacy;

use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class NoSymfonyHeader_StreamedResponse
 * @package App\Legacy
 *
 * there's no dif between StreamedResponse and NoSymfonyHeader_StreamedResponse, the latter is only
 * a reminder that headers determined by Dolibarr, not Symfony.
 *
 * Techenical details, see php functions:
 *  - `header`: Remember that header() must be called before any actual output is sent, either by normal HTML tags, blank lines in a file
 *  - `headers_sent`
 *
 */
class NoSymfonyHeader_StreamedResponse extends StreamedResponse
{

    public function send()
    {
        // scil
//        $this->sendHeaders();
        $this->sendContent();

        if (\function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        } elseif (!\in_array(\PHP_SAPI, ['cli', 'phpdbg'], true)) {
            static::closeOutputBuffers(0, true);
        }

        return $this;
    }
}