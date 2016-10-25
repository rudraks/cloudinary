<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {seo} function plugin
 *
 * Type:     function<br>
 * Name:     seo<br>
 * Date:     Dic 05, 2012
 * Purpose:  seo url friendly.<br>
 * Params:
 * <pre>
 * - string - (required) - Title to friendly URL conversion
 * - divider - (required) - return good words separated by dashes
 * </pre>
 * Examples:
 * <pre>
 * {seo string="Lorem Ipsum"}
 * {seo string="Lorem Ipsum" divider="_"}
 * </pre>
 *
 * @version 1.0
 * @author Concetto Vecchio <info@cvsolutions.it>
 * @param array $params parameters
 * @param Smarty_Internal_Template $template template object
 * @return string
 */

function smarty_function_cl_image_upload_tag($params, $template)
{
    global $cors_location;
    return app\service\Cloudinary::image_upload_tag('image_id',
        array(
            "notification_url" => app\service\Cloudinary::get_notification_url($params),
            "callback" => \RudraX\Utils\Webapp::$REMOTE_HOST ."/src/external/components/cloudinary/html",
            "html" => array("multiple" => TRUE)
        ));
}