<?php namespace LZaplata\Catalog\Models;

use Backend\Facades\BackendAuth;
use Backend\Models\ImportModel;
use October\Rain\Support\Str;

/**
 * ImportModel
 */
class CategoryImport extends ImportModel
{
    /**
     * @var array Validation rules
     */
    public $rules = [
        "title"   => "required",
        "stachema_id" => "required",
    ];

    public function importData($results, $sessionKey = null)
    {
        if (BackendAuth::userHasAccess("categories.import")) {
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

                    // create root category

                    if ($parent1 = array_get($data, "parent_1")) {
                        $rootCategory = Category::make();
                        $rootCategory = Category::where("title", $parent1)->first() ?: $rootCategory;
                        $rootCategory->title = $parent1;
                        $rootCategory->slug = Str::slug($parent1);
                        $rootCategory->forceSave();

                        $parent = Category::where("title", $parent1)->first();
                    }

                    // create subcategory

                    if ($parent2 = array_get($data, "parent_2")) {
                        $subCategory = Category::make();
                        $subCategory = Category::where("title", $parent2)->first() ?: $subCategory;
                        $subCategory->title = $parent2;
                        $subCategory->slug = Str::slug($parent2);
                        $subCategory->parent_id = isset($parent) && $parent ? $parent->id : null;
                        $subCategory->forceSave();

                        $parent = Category::where("title", $parent2)->first();
                    }

                    // create category - this is lowest level category in the tree

                    $category = Category::make();
                    $category = Category::where("stachema_id", $stachemaId)->first() ?: $category;

                    $categoryExists = $category->exists;

                    $category->title = $title;
                    $category->slug = Str::slug($title);
                    $category->stachema_id = $stachemaId;
                    $category->parent_id = isset($parent) && $parent ? $parent->id : null;
                    $category->forceSave();

                    if (!$categoryExists) {
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
}
