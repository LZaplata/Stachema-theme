<?php namespace LZaplata\Catalog;

use Illuminate\Support\Facades\Storage;
use LZaplata\Catalog\Components\Categories;
use LZaplata\Catalog\Components\Category;
use LZaplata\Catalog\Components\Product;
use LZaplata\Catalog\Components\Products;
use LZaplata\Catalog\Console\DeleteResizedImages;
use LZaplata\Catalog\Console\ImportFiles;
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
