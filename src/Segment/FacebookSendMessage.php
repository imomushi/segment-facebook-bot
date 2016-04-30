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
 * Class FacebookSendMessage
 *
 * @package Imomushi\Worker
 */
class FacebookSendMessage
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
        $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$arguments->access_token;
        $curl = curl_init($url);
        $options = array(
            // HEADER
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=UTF-8',
            ),
            // Method
            CURLOPT_POST => true,
            // Body
            CURLOPT_POSTFIELDS => json_encode([
                'recipient' => ['id' => $arguments->sender],
                'message' => ['text' => $arguments->text]
            ]),
        );
        curl_setopt_array($curl, $options);

        // Call API
        try {
            curl_exec($curl);
        } catch (Exception $e) {
            error_log($e->getMessage());
            curl_close($curl);
            return ['status' => false];
        }
        curl_close($curl);

        return ['status' => true];
    }
}
