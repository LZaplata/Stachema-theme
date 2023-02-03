<?php

use LZaplata\Catalog\Controllers\Feed;

Route::any("/feed/products", [\LZaplata\Catalog\Controllers\Feed::class, "products"]);
