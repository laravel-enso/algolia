<?php

namespace LaravelEnso\Algolia\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Helpers\Casts\Encrypt;
use LaravelEnso\Rememberable\Traits\Rememberable;

class Settings extends Model
{
    use HasFactory, Rememberable;

    protected $table = 'algolia_settings';

    protected $guarded = ['id'];

    protected array $rememberableKeys = ['id'];

    private static $instance;

    public static function current(): self
    {
        return self::$instance
            ??= self::cacheGet(1)
            ?? self::factory()->create();
    }

    public static function enabled(): bool
    {
        return self::current()->enabled;
    }

    protected function casts(): array
    {
        return [
            'enabled' => 'boolean',
        ];
    }
}
