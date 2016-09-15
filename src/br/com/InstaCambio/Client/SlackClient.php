<?php

namespace br\com\InstaCambio\Client;

class SlackClient
{

    public static function slack($message, $room, $icon = ":slack:") {
        $data = "payload=" . json_encode(array(
                "channel"       =>  "#{$room}",
                "text"          =>  $message,
                "icon_emoji"    =>  $icon
            ));

        $ch = curl_init("https://hooks.slack.com/services/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");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}