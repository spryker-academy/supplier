<?php

declare(strict_types=1);

namespace SprykerAcademy\Glue\GlueApplication;

use Pyz\Glue\GlueApplication\GlueApplicationDependencyProvider as PyzGlueApplicationDependencyProvider;

/**
 * Exercise wiring, not exercise code.
 *
 * API Platform replays the legacy REST plugins of this provider on every request it serves
 * (LegacyPluginBridgeSubscriber). They are Storefront plugins: in the Backend API application they ask
 * for services that only the Storefront API has, and every Backend API Platform request fails.
 * The Backend API has its own plugin stack in GlueBackendApiApplicationDependencyProvider, so here the
 * lists are empty for it.
 */
class GlueApplicationDependencyProvider extends PyzGlueApplicationDependencyProvider
{
    protected const string APPLICATION_GLUE_BACKEND = 'GLUE_BACKEND';

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RestRequestValidatorPluginInterface>
     */
    protected function getRestRequestValidatorPlugins(): array
    {
        return $this->isBackendApi() ? [] : parent::getRestRequestValidatorPlugins();
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RestUserValidatorPluginInterface>
     */
    protected function getRestUserValidatorPlugins(): array
    {
        return $this->isBackendApi() ? [] : parent::getRestUserValidatorPlugins();
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ControllerBeforeActionPluginInterface>
     */
    protected function getControllerBeforeActionPlugins(): array
    {
        return $this->isBackendApi() ? [] : parent::getControllerBeforeActionPlugins();
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ControllerAfterActionPluginInterface>
     */
    protected function getControllerAfterActionPlugins(): array
    {
        return $this->isBackendApi() ? [] : parent::getControllerAfterActionPlugins();
    }

    protected function isBackendApi(): bool
    {
        return defined('APPLICATION') && APPLICATION === static::APPLICATION_GLUE_BACKEND;
    }
}
