<?php

namespace app\service {

    class Cloudinary extends \Cloudinary
    {
        public static $RX_CONNECTED = false;
        public static $CLOUD_NAME;
        public static $notification_url = "api/cloudinary/image_upload_callback";

        public static function rx_setup()
        {
            $config = \Config::getSection("CLOUDINARY_CONFIG");

            \Cloudinary::config(array(
                "cloud_name" => $config["cloud_name"],
                "api_key" => $config["api_key"],
                "api_secret" => $config["api_secret"]
            ));
            if (isset($config["cloud_name"])) {
                self::$CLOUD_NAME = $config["cloud_name"];
            }
            if (isset($config["notification_url"])) {
                self::$notification_url = $config["notification_url"];
            }
        }

        public static function get_notification_url($params)
        {
            return \RudraX\Utils\Webapp::$REMOTE_HOST . "/" . self::$notification_url .
            "?cloud_name=" . self::$CLOUD_NAME . "&" . http_build_query($params);
        }

        public static function use_smarty_tags()
        {
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

        public static function image_url($source, $options)
        {
            return \Cloudinary::cloudinary_url($source, $options);
        }


        public static function getImageData (){
            return (array) json_decode(file_get_contents('php://input'), true);
        }

        public static function delete ($public_id){
            return \Cloudinary\Uploader::destroy($public_id);
        }

        public static function upload ($file, $options = array()){
            return \Cloudinary\Uploader::upload($file,$options);
        }

    }

    Cloudinary::rx_setup();
}
