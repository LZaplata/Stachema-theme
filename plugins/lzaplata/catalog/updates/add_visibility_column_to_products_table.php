<?php namespace LZaplata\Catalog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateLzaplataCatalogProducts extends Migration
{
    public function up()
    {
        Schema::table('lzaplata_catalog_products', function($table)
        {
            $table->smallInteger('visibility')->default(1);
        });
    }
    
    public function down()
    {
        Schema::table('lzaplata_catalog_products', function($table)
        {
            $table->dropColumn('visibility');
        });
    }
}
