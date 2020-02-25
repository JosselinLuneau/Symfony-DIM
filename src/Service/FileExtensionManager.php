<?php

namespace App\Service;


class FileExtensionManager
{
    public function isDataFormatValid($ext, $extensionAllowed = null)
    {
        $dataExtension = ["xml", "json", "yaml", "yml"];

        return in_array(strtolower($ext), !empty($extensionAllowed)?$extensionAllowed: $dataExtension) ;
    }
}