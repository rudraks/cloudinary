<?php

namespace app\controller {


    use app\RX;
    use app\service\Cloudinary;
    use RudraX\Utils\Webapp;

    class CloudinaryController extends AbstractController
    {
        /**
         * @RequestMapping(url="api/cloudinary/image_upload_callback",type="json")
         * @RequestParams(true)
         */
        public function cloudinary_upload()
        {
            $imageData = Cloudinary::getImageData();
            $CloudinaryClassInstance = RX::handler("cloudinary");
            if (!is_null($CloudinaryClassInstance)) {
                $CloudinaryClassInstance->image_upload_callback($imageData);
            }
            return array();
        }
    }
}
