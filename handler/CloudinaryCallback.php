<?php
/**
 * Created by IntelliJ IDEA.
 * User: lalittanwar
 * Date: 25/10/16
 * Time: 2:04 PM
 */

namespace app\handler;


/**
 * Class CloudinaryCallback
 * @package app\handler
 */
abstract class CloudinaryCallback extends AbstractHandler
{
    /**
     * @param \RedBeanPHP\OODBBean $imageBean
     * @param array $imageData
     * @return \RedBeanPHP\OODBBean
     */
    public function image_upload_callback($imageBean)
    {
        return $imageBean;
    }

} 