<?php namespace LZaplata\Catalog\Controllers;

use Backend\Behaviors\ImportExportController;
use Backend\Classes\Controller;
use BackendMenu;

class Categories extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController',
        ImportExportController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = [
        "categories",
        "categories.*",
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('LZaplata.Catalog', 'main-menu-item', 'side-menu-categories');
    }
}
