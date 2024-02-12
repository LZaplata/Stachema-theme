<?php namespace LZaplata\Catalog\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use LZaplata\Catalog\Models\Category;
use October\Rain\Database\Collection;

/**
 * Categories Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Categories extends ComponentBase
{
    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            "name"          => "lzaplata.catalog::lang.component.categories.name",
            "description"   => "lzaplata.catalog::lang.component.categories.description",
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
            "parent" => [
                "title"         => "lzaplata.catalog::lang.component.categories.property.parent.title",
                "description"   => "lzaplata.catalog::lang.component.categories.property.parent.description",
                "type"          => "dropdown",
            ],
            "page" => [
                "title"         => "lzaplata.catalog::lang.component.categories.property.page.title",
                "description"   => "lzaplata.catalog::lang.component.categories.property.page.description",
                "type"          => "dropdown",
            ],
        ];
    }

    /**
     * @return array
     */
    public function getParentOptions(): array
    {
        return array_merge(
            [
                null => "lzaplata.catalog::lang.component.categories.property.parent.prompt",
            ],
            Category::orderBy("title", "asc")->lists("title", "slug")
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
     * @return Collection
     */
    public function categories(): Collection
    {
        if ($this->property("parent")) {
            $parent = $this->property("parent");
        } else {
            if ($this->page->id == $this->property("page") && $this->param("slug")) {
                if ($category = Category::where("slug", $this->param("slug"))->first()) {
                    $parent = $category->id;
                } else {
                    $parent = null;
                }
            } else {
                $parent = null;
            }
        }



        if ($this->property("ids")) {
            $categories = Category::whereIn("id", $this->property("ids"))->get();
        } else {
            $categories = Category::where("parent_id", $parent)->get();
        }

        $categories->each(function ($category) {
            $category->setUrl($this->property("page"), $this->controller);
        });

        return $categories;
    }
}
