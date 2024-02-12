<?php namespace LZaplata\Catalog\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use LZaplata\Catalog\Models\Category;
use LZaplata\Catalog\Models\Product;
use October\Rain\Support\Facades\Input;

/**
 * Products Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Products extends ComponentBase
{
    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            "name"          => "lzaplata.catalog::lang.component.products.name",
            "description"   => "lzaplata.catalog::lang.component.products.description",
        ];
    }

    /**
     * defineProperties for the component
     *
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [
            "category" => [
                "title"         => "lzaplata.catalog::lang.component.products.property.category.title",
                "description"   => "lzaplata.catalog::lang.component.products.property.category.description",
                "type"          => "dropdown"
            ],
            "page" => [
                "title"         => "lzaplata.catalog::lang.component.products.property.page.title",
                "description"   => "lzaplata.catalog::lang.component.products.property.page.description",
                "type"          => "dropdown",
            ],
            "categoryPage" => [
                "title"         => "lzaplata.catalog::lang.component.products.property.category_page.title",
                "description"   => "lzaplata.catalog::lang.component.products.property.category_page.description",
                "type"          => "dropdown",
            ],
        ];
    }

    /**
     * @return array
     */
    public function getCategoryOptions(): array
    {
        return array_merge(
            [
                null => "lzaplata.catalog::lang.component.products.property.category.prompt",
            ],
            Category::orderBy("title", "asc")->lists("title", "slug"),
        );
    }

    /**
     * @return array
     */
    public function getPageOptions(): array
    {
        return Page::sortBy("baseFileName")->lists("baseFileName", "baseFileName");
    }

    /**
     * @return array
     */
    public function getCategoryPageOptions(): array
    {
        return Page::sortBy("baseFileName")->lists("baseFileName", "baseFileName");
    }

    /**
     * @return LengthAwarePaginator
     */
    public function products(): LengthAwarePaginator
    {
        $products = Product::orderBy("position", "asc")
            ->where("visibility", 1);

        if ($this->property("category")) {
            $products->whereRelation("categories", "slug", $this->property("category"));
        } elseif ($this->property("ids")) {
            $products->whereIn("id", $this->property("ids"));
        } else {
            if ($this->page->id == $this->property("categoryPage") && $this->param("slug")) {
                if ($category = Category::where("slug", $this->param("slug"))->first()) {
                    $products->whereRelation("categories", "slug", $category->slug);
                }
            } elseif (Input::get("q")) {
                $products->where(function ($q) {
                    $q->where("title", "like", "%" . Input::get("q") . "%")
                        ->orWhere("excerpt", "like", "%" . Input::get("q") . "%")
                        ->orWhere("text", "like", "%" . Input::get("q") . "%");
                });
            }
        }

        $products = $products
            ->where("visibility", 1)
            ->paginate(24, $this->param("page"));

        $products->each(function ($product) {
            $product->setUrl($this->property("page"), $this->controller);
        });

        return $products;
    }
}
