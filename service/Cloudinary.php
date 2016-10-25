<?php

namespace app\service {

    class Cloudinary extends \Cloudinary
    {
        public static $RX_CONNECTED = false;
        public static $cloud_name;
        public static $notification_url = "api/image_upload";

        public static function rx_setup()
        {
            $config = \Config::get("CLOUDINARY_CONFIG");
            \Cloudinary::config(array(
                "cloud_name" => $config["cloud_name"],
                "api_key" => $config["api_key"],
                "api_secret" => $config["api_secret"]
            ));
            if (isset($config["cloud_name"])) {
                self::$cloud_name = $config["cloud_name"];
            }
            if (isset($config["notification_url"])) {
                self::$notification_url = $config["notification_url"];
            }
        }

        public static function get_notification_url($params)
        {
            return \RudraX\Utils\Webapp::$REMOTE_HOST . "/" . self::$notification_url .
            "?cloud_name=" . self::$cloud_name . "&" . http_build_query($params);
        }

        public static function use_smarty_tags()
        {
            echo("use_smarty_tags");
            return Smarty::addPluginsDir("../plugins");
        }

        public static function js_config()
        {
            return cloudinary_js_config();
        }

        public static function image_upload_tag($field, $options = array())
        {
            return cl_image_upload_tag($field, $options);
        }

        public static function image_tag($source, $options)
        {
            return cl_image_tag($source, $options);
        }

    }

    Cloudinary::rx_setup();
}
