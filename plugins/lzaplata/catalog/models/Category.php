<?php namespace LZaplata\Catalog\Models;

use Cms\Classes\Controller;
use Model;
use October\Rain\Database\Traits\NestedTree;
use System\Models\File;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    use NestedTree;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'lzaplata_catalog_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        "title" => "required",
        "slug" => ["required", "regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i", "unique:lzaplata_catalog_categories,slug,NULL,id,deleted_at,NULL"]
    ];

    /**
     * @var array
     */
    public $belongsTo = [
        "parent" => Category::class,
    ];

    public $attachOne = [
        "image" => File::class,
    ];

    public $belongsToMany = [
        "products" => [
            Product::class,
            "table" => "lzaplata_catalog_products_categories",
        ]
    ];

    /**
     * @param string $page
     * @param Controller $controller
     *
     * @return string
     */
    public function setUrl(string $page, Controller $controller): string
    {
        $params = [
            "slug"  => $this->slug,
            "page"  => null,
        ];

        return $this->url = $controller->pageUrl($page, $params);
    }
}
