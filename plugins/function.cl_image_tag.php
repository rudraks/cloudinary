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

function smarty_function_cl_image_tag($params, $template)
{
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
    return app\service\Cloudinary::image_tag($params["public_name"], $params);
}
