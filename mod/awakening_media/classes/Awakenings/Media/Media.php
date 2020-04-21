<?php

namespace Awakenings\Media;

class Media {
    public static function getDefaultThumbnailURL($entity) {
        if (!$entity instanceof \ElggFile) {
            return null;
        }

        $mapping = [
            'application/excel' => 'excel',
            'application/msword' => 'word',
            'application/ogg' => 'music',
            'application/pdf' => 'pdf',
            'application/powerpoint' => 'ppt',
            'application/vnd.ms-excel' => 'excel',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.oasis.opendocument.text' => 'openoffice',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'word',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'excel',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'ppt',
            'application/x-gzip' => 'archive',
            'application/x-rar-compressed' => 'archive',
            'application/x-stuffit' => 'archive',
            'application/zip' => 'archive',
            'text/directory' => 'vcard',
            'text/v-card' => 'vcard',
            'application' => 'application',
            'audio' => 'music',
            'text' => 'text',
            'video' => 'video',
        ];

        $mime = $entity->getMimeType();

        if ($mime) {
            $base_type = substr($mime, 0, strpos($mime, '/'));
        } else {
            $mime = 'none';
            $base_type = 'none';
        }

        if (isset($mapping[$mime])) {
            $type = $mapping[$mime];
        } elseif (isset($mapping[$base_type])) {
            $type = $mapping[$base_type];
        } else {
            $type = 'general';
        }

        $ext = '_lrg';
    
        $url = elgg_get_simplecache_url("file/icons/{$type}{$ext}.gif");

        return $url;
    }
}