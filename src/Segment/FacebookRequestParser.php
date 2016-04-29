<?php
/*
 * This file is part of Worker.
 *
 ** (c) 2016 -  Fumikazu FUjiwara
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imomushi\Worker\Segment;

/**
 * Class FacebookRequestParser
 *
 * @package Imomushi\Worker
 */
class FacebookRequestParser
{
    /**
     * @var
     */

    /**
     * Constructer
     */
    public function __construct()
    {
    }

    public function execute($arguments)
    {
        $body = new \stdClass();
        $body -> result =  [new \stdClass()];
        $body -> result[0] -> content = [];
        if (is_object($arguments) && property_exists($arguments, 'body')) {
            $bodyCandidate = json_decode($arguments->body);
            if (is_object($body) &&
                property_exists($body, 'result') &&
                is_array($body -> result) &&
                is_object($body -> result[0]) &&
                property_exists($body -> result[0], 'content')
            ) {
                $body = $bodyCandidate;
            }
        }
        return ['content' => $body->result[0]->content];
    }
}
