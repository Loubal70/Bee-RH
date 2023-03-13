<?php

namespace Themosis\BeeRH\Providers;

use InvalidArgumentException;
use Themosis\Core\Support\Providers\RouteServiceProvider as ServiceProvider;

class SendSlackNotificationServiceProvider extends ServiceProvider
{

    /**
     * @param string $message
     * @param string $mention
     * @return void
     */
    public static function send(string $message, string $mention)
    {
        $mentionValues = [
            'here' => '<!here>',
            'row' => '<!row>',
            'table' => '<!table>'
        ];

        if (!in_array($mention, array_keys($mentionValues))) {
            throw new InvalidArgumentException("Invalid argument layout [$mention].");
        }

        $slack_webhook = get_option('bee-rh-slack');

        if (!empty($slack_webhook)) {
            $message = [
                'text' => $message . ' ' . $mentionValues[$mention],
            ];

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/json\r\n",
                    'method' => 'POST',
                    'content' => json_encode($message)
                )
            );

            $context = stream_context_create($options);
            $result = file_get_contents($slack_webhook, false, $context);
        }
    }
}
