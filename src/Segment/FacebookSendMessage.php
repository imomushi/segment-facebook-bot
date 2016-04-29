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
        $content = (array)$arguments->content;

        $resContent = $content;
        $resContent['text'] = $content['text'];

        $url = 'https://trialbot-api.line.me/v1/events';
        $curl = curl_init($url);
        $options = array(
            // HEADER
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=UTF-8',
                'X-Line-ChannelID: '.$arguments->line_channel_id,
                'X-Line-ChannelSecret: '.$arguments->line_channel_secret,
                'X-Line-Trusted-User-With-ACL: '.$arguments->line_channel_mid
            ),
            // Method
            CURLOPT_POST => true,
            // Body
            CURLOPT_POSTFIELDS => json_encode([
                'to' => [$content['from']],
                'toChannel' => 1383378250, # Fixed value
                'eventType' => '138311608800106203', # Fixed value
                'content' => $resContent,
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
