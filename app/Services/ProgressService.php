<?php

namespace App\Services;

use App\Models\StudentMaterialProgressModel;

class ProgressService
{
    public function getTheLatestProgressByUserId($userId)
    {
        $progress = (new StudentMaterialProgressModel())->getLatestInProgress((int) $userId);

        if (!$progress) {
            return null;
        }

        return [
            'material_id' => (int) $progress['material_id'],
            'material'    => [
                'id'      => (int) $progress['material_id'],
                'chapter' => $progress['chapter'],
                'title'   => $progress['title'],
                'subject' => $progress['subject'],
            ],
            'is_done'    => (bool) $progress['is_done'],
            'started_at' => $progress['started_at'],
            'done_at'    => $progress['done_at'],
            'score'      => $progress['score'],
        ];
    }
}
