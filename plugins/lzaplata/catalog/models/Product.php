<?php namespace LZaplata\Catalog\Models;

use Cms\Classes\Controller;
use Model;
use October\Rain\Database\Builder;
use October\Rain\Database\Scopes\NestedTreeScope;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'lzaplata_catalog_products';

    /**
     * @var array Validation rules
     */
    public $rules = [
        "title"         => "required",
        "slug"          => ["required", "regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i", "unique:lzaplata_catalog_products,slug,NULL,id,deleted_at,NULL"],
        "categories"    => "required",
        "stachema_id"   => "required",
        "files.*.title" => "required",
//        "files.*.file"  => "required",
    ];

    public $customMessages = [
        "files.*.title.required"    => "Dokumenty - Název pole je povinné.",
//        "files.*.file.required"     => "Dokumenty - Soubor pole je povinné.",
    ];

    public $belongsToMany = [
        "categories" => [
            Category::class,
            "table" => "lzaplata_catalog_products_categories",
        ]
    ];

    public $jsonable = [
        "files",
    ];

    public $fillable = [
        "files",
    ];

    /**
     * @param Builder $query
     * @param array $categories
     * @return Builder
     */
    public function scopeFilterCategories(Builder $query, array $categories): Builder
    {
        return $query->whereHas("categories", function($q) use ($categories) {
            $q->withoutGlobalScope(NestedTreeScope::class)->whereIn("id", $categories);
        });

        return $query;
    }

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
        ];

        return $this->url = $controller->pageUrl($page, $params);
    }
}
