<?php

namespace Sinclair\Settingable;

trait HasSettings
{
    public function settings()
    {
        return $this->morphMany(Setting::class, 'settingable');
    }
}