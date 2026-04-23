<?php

namespace LaravelEnso\Algolia\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'algolia_settings';

    protected $guarded = ['id'];

    protected array $rememberableKeys = ['id'];

    private static $instance;

    public static function current(): self
    {
        return self::$instance
            ??= self::find(Config::get('enso.algolia.settingsId'))
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
