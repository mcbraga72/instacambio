<?php

namespace br\com\InstaCambio\Client;

class SlackClient
{

    public static function slack($message, $color = "", $room, $icon = ":slack:") {
        $data = "payload=" . json_encode(array(
                "channel"       =>  "#{$room}",
                "icon_emoji"    =>  $icon,
                "attachments"   =>  array(array(
                    "text"      =>  $message,
                    "color"     =>  $color
                ))
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