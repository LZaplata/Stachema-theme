<?php namespace LZaplata\Catalog\Controllers;

use Backend\Behaviors\ImportExportController;
use Backend\Classes\Controller;
use BackendMenu;

class Products extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        ImportExportController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = [
        "products",
        "products.*",
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('LZaplata.Catalog', 'main-menu-item', 'side-menu-products');
    }
}
