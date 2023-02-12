<?php

namespace Assently;

use Storage;


class AssentlyDocument
{
    /**
     * Create a new document, will return a compatible DocumentModel
     * used by the case API endpoint. 
     *
     * @param  string  $file
     * @param  array   $options
     * @return array
     */
    public function create($file, $options = [])
    {
        $filesystem = Storage::disk('local');

        $json = [
            'Filename'    => $filesystem->baseName($file),
            'Data'        => base64_encode($filesystem->get($file)),
            'ContentType' => $filesystem->mimeType($file),
            'Size'        => $filesystem->size($file),
            'FormFields'  => [],
        ];

        return array_merge($json, $options);
    }
}