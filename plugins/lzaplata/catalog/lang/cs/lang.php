<?php return [
    'plugin' => [
        'name' => 'Katalog',
        'description' => 'Plugin pro správu produktů a kategorií',
    ],
    'category' => [
        'field' => [
            'title' => [
                'label' => 'Název',
            ],
            'slug' => [
                'label' => 'URL',
            ],
            'parent' => [
                'label' => 'Nadřazená kategorie',
                'prompt' => '--Žádná--',
            ],
            'image' => [
                'label' => 'Obrázek',
            ],
            'text' => [
                'label' => 'Text',
            ],
        ],
        'column' => [
            'title' => 'Název',
            'slug' => 'URL',
            'stachema_id' => 'Interní ID',
            'parent_1' => 'Hlavní kategorie',
            'parent_2' => 'I. podkategorie',
        ],
        'update' => [
            'title' => 'Upravit kategorii',
            'flash' => [
                'save' => 'Kategorie byla úspěšně upravena',
                'delete' => 'Kategorie byla úspěšně smazána',
            ],
        ],
        'reorder' => [
            'title' => 'Seřadit kategorie',
        ],
        'create' => [
            'title' => 'Přidat kategorii',
            'flash' => [
                'save' => 'Kategorie byla úspěšně přidána',
            ],
        ],
        'import' => [
            'title' => 'Import kategorií',
        ],
    ],
    'product' => [
        'field' => [
            'title' => [
                'label' => 'Název',
            ],
            'slug' => [
                'label' => 'URL',
            ],
            'categories' => [
                'label' => 'Kategorie',
            ],
            'stachema' => [
                'label' => 'Interní ID',
            ],
            'files' => [
                'label' => 'Dokumenty',
                'prompt' => 'Přidat dokument',
                'field' => [
                    'title' => [
                        'label' => 'Název',
                    ],
                    'file' => [
                        'label' => 'Soubor',
                    ],
                    'position' => [
                        'label' => 'Pořadí',
                    ],
                ],
            ],
            'visibility' => [
                'label' => 'Zobrazit na webu',
            ],
        ],
        'column' => [
            'title' => 'Název',
            'slug' => 'URL',
            'stachema_id' => 'Interní ID',
            'excerpt' => 'Perex',
            'text' => 'Text',
            'shades' => 'Odstíny',
            'consumption' => 'Spotřeba/vydatnost/dávkování',
            'packages' => 'Balení',
            'key_properties' => 'Klíčové vlastnosti',
            'warning' => 'Upozornění',
            'pictograms' => 'Piktogramy',
            'pictograms_text' => 'Piktogramy text',
            'samples' => 'Vzorkovníky',
            'usage' => 'Použití',
            'application' => 'Aplikace',
            'processing' => 'Zpracování',
            'properties' => 'Vlastnosti',
            'position' => 'Pořadí na webu',
            'pictograms_img' => 'Nechat piktogram',
            'category_1' => 'Kategorie 1. výskyt',
            'category_2' => 'Kategorie 2. výskyt',
            'category_3' => 'Kategorie 3. výskyt',
            'old' => 'ID starého webu',
            'visibility' => 'Zobrazit na webu',
        ],
        'update' => [
            'title' => 'Upravit produkt',
            'flash' => [
                'save' => 'Produkt byl úspěšně upraven',
                'delete' => 'Produkt byl úspěšně smazán',
            ],
        ],
        'create' => [
            'title' => 'Přidat produkt',
            'flash' => [
                'save' => 'Produkt byl úspěšně přidán',
            ],
        ],
        'import' => [
            'title' => 'Import produktů',
        ],
    ],
    'menu' => [
        'categories' => [
            'title' => 'Kategorie',
        ],
        'catalog' => [
            'title' => 'Katalog',
        ],
        'products' => [
            'title' => 'Produkty',
        ],
    ],
    'component' => [
        'categories' => [
            'name' => 'Výpis kategorií',
            'description' => 'Zobrazí výpis kategorií nadřazené kategorie',
            'property' => [
                'parent' => [
                    'title' => 'Nadřazená kategorie',
                    'description' => 'Vyberte kategorii, jejíž podkategorie se mají zobrazit.',
                    'prompt' => '--Žádná--',
                ],
                'page' => [
                    'title' => 'Stránka kategorie',
                    'description' => 'Vyberte stránku která slouží k zobrazení kategorie.',
                ],
            ],
        ],
        'category' => [
            'name' => 'Kategorie',
            'description' => 'Zobrazí kategorii s výpisem jejich dat (titulek, text atd.).',
        ],
        'products' => [
            'name' => 'Výpis produktů',
            'description' => 'Zobrazí výpis produktů vybrané kategorie',
            'property' => [
                'category' => [
                    'title' => 'Kategorie',
                    'description' => 'Vyberte kategorii produktů',
                    'prompt' => '--Žádná--',
                ],
                'page' => [
                    'title' => 'Stránka produktu',
                    'description' => 'Vyberte stránku která slouží k zobrazení produktu.',
                ],
                'category_page' => [
                    'title' => 'Stránka kategorie',
                    'description' => 'Vyberte stránku která slouží k zobrazení kategorie.',
                ],
            ],
        ],
        'product' => [
            'name' => 'Produkt',
            'description' => 'Zobrazí stránku produktu.',
        ],
    ],
    'permissions' => [
        'plugin' => [
            'manage' => [
                'title' => 'Správa pluginu',
            ],
        ],
        'categories' => [
            'manage' => [
                'title' => 'Správa kategorií',
            ],
            'import' => [
                'title' => 'Import kategorií',
            ],
        ],
        'products' => [
            'manage' => [
                'title' => 'Správa produktů',
            ],
            'import' => [
                'title' => 'Import produktů',
            ],
        ],
        'settings' => [
            'manage' => [
                'title' => 'Správa nastavení',
            ],
        ],
    ],
    'filter' => [
        'categories' => [
            'label' => 'Kategorie',
        ],
    ],
    'settings' => [
        'label' => 'Katalog',
        'description' => 'Správa nastavení produktů a kategorií',
        'category' => 'LZaplata',
        'field' => [
            'product_page' => [
                'label' => 'Stránka produktu',
            ],
        ],
        'tab' => [
            'feeds' => [
                'label' => 'Feedy',
            ],
        ],
    ],
];