<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\MigrationRunner;

class MigrateController extends Controller
{
    public function index()
    {
        // Opsional: lindungi dengan key di .env => MIGRATE_KEY = rahasia
        $secret = env('MIGRATE_KEY');
        if ($secret && $this->request->getGet('key') !== $secret) {
            return $this->response->setStatusCode(403)->setBody('Forbidden: key salah.');
        }

        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
            $history = $migrate->getHistory();
            $latest = end($history);
            $version = is_object($latest) ? ($latest->version ?? '-') : ($latest['version'] ?? '-');

            return $this->response->setContentType('text/plain')->setBody(
                "Migrasi selesai. Versi terakhir: " . $version . "\n"
            );
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setContentType('text/plain')->setBody(
                "Migrasi gagal: " . $e->getMessage() . "\n"
            );
        }
    }
}
