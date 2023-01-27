<?php namespace LZaplata\Catalog\Models;

use Backend\Facades\BackendAuth;
use Backend\Models\ImportModel;
use October\Rain\Support\Str;

/**
 * ImportModel
 */
class ProductImport extends ImportModel
{
    /**
     * @var array Validation rules
     */
    public $rules = [
        "title"   => "required",
        "stachema_id" => "required",
        "category_1" => "required",
    ];

    public function importData($results, $sessionKey = null)
    {
        if (BackendAuth::userHasAccess("products.import")) {
            foreach ($results as $row => $data) {
                try {
                    if (!$title = array_get($data, "title")) {
                        $this->logSkipped($row, "Missing title");

                        continue;
                    }

                    if (!$stachemaId = array_get($data, "stachema_id")) {
                        $this->logSkipped($row, "Missing stachema ID");

                        continue;
                    }

                    if (!$category1 = array_get($data, "category_1")) {
                        $this->logSkipped($row, "Missing category 1");

                        continue;
                    }

                    // create or edit product

                    $product = Product::make();
                    $product = Product::where("stachema_id", $stachemaId)->first() ?: $product;

                    $productExists = $product->exists;

                    $product->title = $title;
                    $product->slug = Str::slug($title);
                    $product->stachema_id = $stachemaId;

                    // set parameters

                    $except = ["category_1", "category_2", "category_3"];

                    foreach (array_except($data, $except) as $attribute => $value) {
                        if (in_array($attribute, $product->getDates()) && empty($value)) {
                            continue;
                        }

                        $product->{$attribute} = $value ?? null;
                    }

                    $product->forceSave();

                    // sync categories

                    $categoryIds = $this->getCategoryIdsForProduct($category1);

                    if ($category2 = array_get($data, "category_2")) {
                        $categoryIds = array_merge($categoryIds, $this->getCategoryIdsForProduct($category2));
                    }

                    if ($category3 = array_get($data, "category_3")) {
                        $categoryIds = array_merge($categoryIds, $this->getCategoryIdsForProduct($category3));
                    }

                    $product->categories()->sync($categoryIds, false);

                    if (!$productExists) {
                        $this->logCreated();
                    } else {
                        $this->logUpdated();
                    }
                } catch (\Exception $exception) {
                    $this->logError($row, $exception->getMessage());
                }
            }
        }
    }

    /**
     * @param string $id
     * @return array
     */
    protected function getCategoryIdsForProduct(string $id): array
    {
        $ids = [];

        $category = Category::where("stachema_id", $id)->first();

        if ($category) {
            $ids[] = $category->id;

            $parents = $category->getParents();

            foreach ($parents as $parent) {
                $ids[] = $parent->id;
            }
        }

        return $ids;
    }
}
