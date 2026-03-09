<?php

declare(strict_types=1);

namespace SprykerAcademy\Shared\SearchElasticsearch;

use Pyz\Shared\SearchElasticsearch\SearchElasticsearchConfig as PyzSearchElasticsearchConfig;

class SearchElasticsearchConfig extends PyzSearchElasticsearchConfig
{
    /**
     * @return array<string>
     */
    public function getSupportedSourceIdentifiers(): array
    {
        return array_merge(parent::getSupportedSourceIdentifiers(), [
            'supplier',
        ]);
    }
}
