<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    /** Nama kolom sumber slug (diisi di tiap model). */
    abstract public function slugSource(): string;

    protected static function bootHasSlug(): void
    {
        static::saving(function ($model) {
            $src = $model->slugSource();
            if (!empty($model->slug) && !$model->isDirty($src)) {
                return;
            }
            $base = Str::slug((string) $model->{$src}) ?: Str::lower(Str::random(8));
            $slug = $base;
            $i = 2;
            while (static::where('slug', $slug)->where('id', '!=', $model->id ?? 0)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $model->slug = $slug;
        });
    }
}
