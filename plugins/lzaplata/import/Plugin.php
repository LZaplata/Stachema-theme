<?php

namespace LZaplata\Import;

use System\Classes\PluginBase;
use Tailor\Models\EntryRecord;

class Plugin extends PluginBase
{
    /**
     * @return void
     * @throws \SystemException
     */
    public function boot(): void
    {
        EntryRecord::extendInSection("Campaigns\Item", function ($model) {
            $model->bindEvent("model.afterFetch", function () use ($model): void {
                if ($model->merchandise_places_file) {
                    $handle = fopen($model->merchandise_places_file->getLocalPath(), "r");
                    $row = 1;

                    if ($handle !== false) {
                        $model->merchandise_places = [];
                        $model->save();

                        while (($place = fgetcsv($handle, 100)) !== false) {
                            if ($row > 1) {
                                $model->merchandise_places()->create([
                                    "place" => $place[0],
                                ]);
                            }

                            $row++;
                        }

                        fclose($handle);
                    }

                    $model->merchandise_places_file->delete();
                }
            });
        });
    }
}
