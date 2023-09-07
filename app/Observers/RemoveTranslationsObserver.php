<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class RemoveTranslationsObserver
{
    public function deleted(Model $model): void
    {
        $model->translations()->delete();
    }
}
