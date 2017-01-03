<?php

namespace app\service {

    class Cloudinary extends \Cloudinary
    {
        public static $RX_CONNECTED = false;
        public static $CLOUD_NAME;
        public static $notification_url = "api/cloudinary/image_upload_callback";
        public static $CLOUD_URL = null;

        public static function rx_setup()
        {
            if(class_exists("\Config")){
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
                if (isset($config["cloud_url"])) {
                    self::$CLOUD_URL = $config["cloud_url"];
                }
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

        public static function image_options_resolve($params){
            if(!isset($params["cloud_name"]) || empty($params["cloud_name"])){
                $params["cloud_name"] = "NO_CLOUDE";
            }
            if(isset($params["use"]) && !empty($params["use"])){
                if($params["use"]=="xs"){
                    $params["crop"] = "thumb";
                    $params["height"] = "50";
                    $params["width"] = "50";
                    $params["quality"] = "30";
                } else if($params["use"]=="sm"){
                    $params["crop"] = "thumb";
                    $params["height"] = "100";
                    $params["width"] = "100";
                    $params["quality"] = "50";
                } else if($params["use"]=="smth"){
                    $params["crop"] = "fill";
                    $params["flags"] = "progressive";
                    $params["height"] = "120";
                    $params["width"] = "200";
                } else if($params["use"]=="mth"){
                    $params["crop"] = "fill";
                    $params["flags"] = "progressive";
                    $params["width"] = "400";
                }
            }
            return $params;
        }

        public static function image_tag($source, $options)
        {
            $options = self::image_options_resolve($options);
            $imageUrl = cl_image_tag($source, $options);
            if(!is_null(self::$CLOUD_URL)){
                $imageUrl = str_replace("res.cloudinary.com",self::$CLOUD_URL,$imageUrl);
            }
            return $imageUrl;
        }

        public static function image_url($source, $options)
        {
            $options = self::image_options_resolve($options);
            $imageUrl = \Cloudinary::cloudinary_url($source, $options);
            if(!is_null(self::$CLOUD_URL)){
                $imageUrl = str_replace("res.cloudinary.com",self::$CLOUD_URL,$imageUrl);
            }
            return $imageUrl;
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
