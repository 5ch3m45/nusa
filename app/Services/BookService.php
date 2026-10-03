<?php

namespace App\Services;

class BookService
{
    /**
     * Returns a ready-to-embed PDF URL if the book can be viewed inline
     * (type=pdf, or a link whose URL points to a .pdf file), null otherwise.
     */
    public static function viewerUrl(array $book): ?string
    {
        $url = trim((string) ($book['url_or_path'] ?? ''));
        if ($url === '') {
            return null;
        }

        $isPdf = ((string) ($book['type'] ?? '')) === 'pdf'
            || (bool) preg_match('/\.pdf(?:[?#]|$)/i', $url);

        if (!$isPdf) {
            return null;
        }

        // local paths get a leading slash, external urls stay as-is
        return strpos($url, '://') === false ? '/' . ltrim($url, '/') : $url;
    }
}
