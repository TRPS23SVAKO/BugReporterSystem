<?php

namespace App\Helpers;

use App\Models\Setting;

class GlobalSettings
{
    public const DefaultRole = 'default_role';
    public const MainPageDescriptionImage = 'main_page_desc_image';
    public const MainPageDescriptionText = 'main_page_desc_text';

    private const CACHE_KEY = 'settings.all';
    private const TTL_HOURS = 6;

    public static function get(string $key, mixed $default = null): mixed
    {
        return cache()->remember(
            self::CACHE_KEY,
            now()->addHours(self::TTL_HOURS),
            fn () => Setting::query()->pluck('value', 'key')
        ) ?? $default;
    }

    public static function clearCache(): void
    {
        cache()->forget(self::CACHE_KEY);
    }
}
