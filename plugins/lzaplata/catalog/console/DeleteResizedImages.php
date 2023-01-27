<?php namespace LZaplata\Catalog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use LZaplata\Catalog\Models\Product;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * DeleteResizedImages Command
 *
 * @link https://docs.octobercms.com/3.x/extend/console-commands.html
 */
class DeleteResizedImages extends Command
{
    /**
     * @var string name is the console command name
     */
    protected $name = 'catalog:deleteresizedimages';

    /**
     * @var string description is the console command description
     */
    protected $description = 'No description provided yet...';

    /**
     * handle executes the console command
     */
    public function handle()
    {
        try {
            Storage::disk("resources")->deleteDirectory("resize");

            $this->info("Resized images has been deleted.");
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * getArguments get the console command arguments
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * getOptions get the console command options
     */
    protected function getOptions()
    {
        return [];
    }
}
