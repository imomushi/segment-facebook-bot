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
        $body = json_decode($arguments->body);
        $message = $body->entry[0]->messaging;
        return ['sender' => $message[0]->sender->id, 'text' => $message[0]->message->text];
    }
}
