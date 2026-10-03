<?php

namespace App\Services;

class SubmaterialService
{
    /**
     * Normalize a submaterial's raw url into a ready-to-use embed/source URL.
     * Returns null for text items or empty urls.
     */
    public static function embedUrl(array $submaterial): ?string
    {
        $type = (string) ($submaterial['type'] ?? '');
        $url  = trim((string) ($submaterial['url'] ?? ''));

        if ($url === '') {
            return null;
        }

        if ($type === 'youtube') {
            // Accept watch?v=, youtu.be, /embed/, /shorts/, /live/ or a bare video id
            if (preg_match('/(?:youtube\.com\/(?:watch\?[^\s]*v=|embed\/|shorts\/|live\/)|youtu\.be\/)([A-Za-z0-9_-]{6,})/', $url, $m)) {
                return 'https://www.youtube.com/embed/' . $m[1];
            }
            if (strpos($url, '://') === false && strpos($url, '/') === false) {
                return 'https://www.youtube.com/embed/' . $url;
            }

            return $url;
        }

        if ($type === 'slides') {
            if (preg_match('/docs\.google\.com\/presentation\/d\/([A-Za-z0-9_-]+)/', $url, $m)) {
                return 'https://docs.google.com/presentation/d/' . $m[1] . '/embed?start=false&loop=false&delayms=3000';
            }
            if (strpos($url, '://') === false && strpos($url, '/') === false) {
                return 'https://docs.google.com/presentation/d/' . $url . '/embed?start=false&loop=false&delayms=3000';
            }

            return $url;
        }

        // pdf & mp3: local paths get a leading slash, external urls stay as-is
        if (in_array($type, ['pdf', 'mp3'], true)) {
            return strpos($url, '://') === false ? '/' . ltrim($url, '/') : $url;
        }

        return null;
    }
}
