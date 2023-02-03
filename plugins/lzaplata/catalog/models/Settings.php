<?php

namespace LZaplata\Catalog\Models;

use Cms\Classes\Page;
use October\Rain\Database\Model;
use System\Behaviors\SettingsModel;

class Settings extends Model
{
    public $implement = [
        SettingsModel::class,
    ];

    public $settingsCode = "catalog_settings";

    public $settingsFields = "fields.yaml";

    /**
     * @return array
     */
    public function getProductPageOptions(): array
    {
        return Page::sortBy("baseFileName")->lists("baseFileName", "baseFileName");
    }
}
