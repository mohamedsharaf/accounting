<?php

namespace App\Helpers;
use App\Category;

class CategoryHelper {

    ///getChildrenOfParents
    ///pass all categories to get nested children
    static public function getChildrenOfCategoriesParents($categories)
    {
        foreach ($categories as  $category) {
            if ($category != null) {
                $children = Category::where('category_id', $category->id)->get();
                $category['children'] = $children;
                self::getChildrenOfCategoriesParents($category['children']);
            }
        }
        return $categories;
    }

}
