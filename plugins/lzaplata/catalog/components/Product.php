<?php namespace LZaplata\Catalog\Components;

use Cms\Classes\ComponentBase;
use Cms\Facades\Cms;
use Illuminate\Http\RedirectResponse;
use LZaplata\Catalog\Models\Category;
use LZaplata\Catalog\Models\Product as ProductModel;
use October\Rain\Database\Collection;

/**
 * Category Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Product extends ComponentBase
{
    /**
     * @var ProductModel|null
     */
    private $product;

    /**
     * componentDetails
     */
    public function componentDetails()
    {
        return [
            "name"          => "lzaplata.catalog::lang.component.product.name",
            "description"   => "lzaplata.catalog::lang.component.product.description",
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

    /**
     * @return RedirectResponse|null
     */
    public function onRun(): ?RedirectResponse
    {
        if (!$this->product()) {
            return Cms::redirect("homepage");
        }

        return null;
    }

    /**
     * @return ProductModel|null
     */
    public function product(): ?ProductModel
    {
        return $this->product = ProductModel::where("slug", $this->param("slug"))
            ->where("visibility", true)
            ->first();
    }

    /**
     * @return Collection|null
     */
    public function alternativeProducts(): ?Collection
    {
        if ($this->product) {
            $category = Category::whereRelation("products", "id", $this->product->id)
                ->where("stachema_id", "!=", null)
                ->first();

            if ($category) {
                $products = $category
                    ->products
                    ->where("id", "!=", $this->product->id)
                    ->where("visibility", "=", true);

                $products->each(function ($product) {
                    $product->setUrl($this->page->id, $this->controller);
                });
            }
        }

        return $products ?? null;
    }
}
