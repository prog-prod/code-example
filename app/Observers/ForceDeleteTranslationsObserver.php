<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ForceDeleteTranslationsObserver
{
    public function created(Model $model): void
    {
    }

    public function forceDeleted(Model $model): void
    {
        $model->translations()->delete();
    }

}
