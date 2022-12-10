<?php

namespace Api\Service;


use Imagick;

/**
 * Service.
 */
class ImageService
{
    public function cropImage() {
        $image = new Imagick($image_path);
    }
}