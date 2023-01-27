<?php namespace LZaplata\Catalog\Console;

use Illuminate\Console\Command;
use LZaplata\Catalog\Models\Product;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * ImportFiles Command
 *
 * @link https://docs.octobercms.com/3.x/extend/console-commands.html
 */
class ImportFiles extends Command
{
    /**
     * @var string name is the console command name
     */
    protected $name = 'catalog:importfiles';

    /**
     * @var string description is the console command description
     */
    protected $description = 'No description provided yet...';

    /**
     * handle executes the console command
     */
    public function handle()
    {
        if (file_exists($file = $this->argument("file"))) {
            $pathinfo = pathinfo($file);

            if ($pathinfo["extension"] == "csv") {
                $handle = fopen($file, "r");

                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    $product = Product::where("old_id", $data[1])->first();

                    if ($product) {
                        $files = $product->files;
                        $files[] = [
                            "title"     => $data[3],
                            "file"      => "/documents/" . $data[2],
                            "position"  => $data[4],
                        ];

                        $product->update([
                            "files" => $files,
                        ]);
                    }
                }

                fclose($handle);
            } else {
                $this->error("Soubor musí být .csv");
            }
        } else {
            $this->error("Soubor neexistuje!");
        }
    }

    /**
     * getArguments get the console command arguments
     */
    protected function getArguments()
    {
        return [
            ["file", InputArgument::REQUIRED, "Uveďte celou cestu souboru."]
        ];
    }

    /**
     * getOptions get the console command options
     */
    protected function getOptions()
    {
        return [];
    }
}
