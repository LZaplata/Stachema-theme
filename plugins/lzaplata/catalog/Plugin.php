<?php namespace LZaplata\Catalog;

use Illuminate\Support\Facades\Storage;
use LZaplata\Catalog\Components\Categories;
use LZaplata\Catalog\Components\Category;
use LZaplata\Catalog\Components\Product;
use LZaplata\Catalog\Components\Products;
use LZaplata\Catalog\Console\DeleteResizedImages;
use LZaplata\Catalog\Console\ImportFiles;
use LZaplata\Catalog\ContentFields\CategoryPicker;
use LZaplata\Catalog\ContentFields\ProductPicker;
use LZaplata\Catalog\Models\Settings;
use Media\Widgets\MediaManager;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            Categories::class   => "categories",
            Category::class     => "category",
            Products::class     => "products",
            Product::class     => "product",
        ];
    }

    public function registerSettings()
    {
        return [
            "settings" => [
                "label"         => "lzaplata.catalog::lang.settings.label",
                "description"   => "lzaplata.catalog::lang.settings.description",
                "category"      => "lzaplata.catalog::lang.settings.category",
                "icon"          => "icon-shopping-cart",
                "class"         => Settings::class,
                "permissions"   => ["settings"],
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerMarkupTags(): array
    {
        return [
            "functions" => [
                "file_exists" => function (string $file, string $disk = "media"): bool {
                    return Storage::disk($disk)->exists($file);
                },
                "preg_match" => function (string $patters, string $subject): array {
                    preg_match($patters, $subject, $matches);

                    return $matches;
                },
            ],
        ];
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerConsoleCommand("catalog.importfiles", ImportFiles::class);
        $this->registerConsoleCommand("catalog.deleteresizesimages", DeleteResizedImages::class);
    }

    /**
     * @return string[]
     */
    public function registerContentFields(): array
    {
        return [
            CategoryPicker::class => "categorypicker",
            ProductPicker::class => "productpicker",
        ];
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        MediaManager::extend(function ($widget) {
            $widget->bindEvent("file.upload", function ($filePath, $uploadedFile) {
                Storage::disk("resources")->deleteDirectory("resize");
            });
        });
    }
}
