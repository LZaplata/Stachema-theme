<?php namespace LZaplata\Catalog\Components;

use Cms\Classes\ComponentBase;
use LZaplata\Catalog\Models\Category as CategoryModel;

/**
 * Category Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Category extends ComponentBase
{
    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            "name"          => "lzaplata.catalog::lang.component.category.name",
            "description"   => "lzaplata.catalog::lang.component.category.description",
        ];
    }

    /**
     * defineProperties for the component
     *
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->page["category"] = $this->category();
    }

    /**
     * @return CategoryModel|null
     */
    public function category(): ?CategoryModel
    {
        return CategoryModel::where("slug", $this->param("slug"))->first();
    }
}
