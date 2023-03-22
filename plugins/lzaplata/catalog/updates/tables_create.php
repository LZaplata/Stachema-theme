<?php namespace LZaplata\Catalog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class TablesCreate extends Migration
{
    public function up()
    {
        Schema::create('lzaplata_catalog_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('site_id')->nullable()->index();
            $table->integer('site_root_id')->nullable()->index();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('stachema_id', 10)->nullable();
            $table->text('text')->nullable();
            $table->integer('parent_id')->nullable()->unsigned();
            $table->integer('nest_left')->nullable();
            $table->integer('nest_right')->nullable();
            $table->integer('nest_depth')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('lzaplata_catalog_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('site_id')->nullable()->index();
            $table->integer('site_root_id')->nullable()->index();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('stachema_id', 10)->nullable();
            $table->text('excerpt')->nullable();
            $table->text('text')->nullable();
            $table->text('shades')->nullable();
            $table->text('consumption')->nullable();
            $table->text('packages')->nullable();
            $table->text('key_properties')->nullable();
            $table->text('warning')->nullable();
            $table->string('pictograms', 100)->nullable();
            $table->text('pictograms_text')->nullable();
            $table->text('samples')->nullable();
            $table->text('usage')->nullable();
            $table->text('application')->nullable();
            $table->text('processing')->nullable();
            $table->text('properties')->nullable();
            $table->integer('position')->nullable();
            $table->text('pictograms_img')->nullable();
            $table->text('files')->nullable();
            $table->text('old_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('lzaplata_catalog_products_categories', function($table)
    {
        $table->engine = 'InnoDB';
        $table->integer('product_id')->unsigned();
        $table->integer('category_id')->unsigned();
    });
    }

    public function down()
    {
        Schema::dropIfExists('lzaplata_catalog_categories');
        Schema::dropIfExists('lzaplata_catalog_products');
        Schema::dropIfExists('lzaplata_catalog_products_categories');
    }
}
