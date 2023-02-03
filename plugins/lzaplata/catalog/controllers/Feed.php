<?php

namespace LZaplata\Catalog\Controllers;

use Cms\Classes\Page;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use LZaplata\Catalog\Models\Product;
use LZaplata\Catalog\Models\Settings;

class Feed extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function products(): \Illuminate\Http\Response
    {
        $products = Product::all();
        $products->each(function ($product) {
            $product->url = Page::url(Settings::get("product_page"), [
                "slug" => $product->slug,
            ]);
        });

        $xml = View::make("lzaplata.catalog::feeds.products")
            ->with("products", $products);

        return Response::make($xml)->header("Content-Type", "text/xml");
    }
}
