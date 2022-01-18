<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\ServiceProvider;

use PrettifyStudio\Twitter\ApiV1\Contract\Twitter as TwitterV1Contract;
use PrettifyStudio\Twitter\ApiV1\Service\Twitter as TwitterV1;
use PrettifyStudio\Twitter\Configuration;
use PrettifyStudio\Twitter\Contract\Configuration as ConfigurationContract;
use PrettifyStudio\Twitter\Contract\Http\ClientFactory;
use PrettifyStudio\Twitter\Contract\Querier as QuerierContract;
use PrettifyStudio\Twitter\Contract\ServiceProvider as ServiceProviderContract;
use PrettifyStudio\Twitter\Contract\Twitter as TwitterV2Contract;
use PrettifyStudio\Twitter\Http\Factory\ClientCreator;
use PrettifyStudio\Twitter\Service\Accessor;
use PrettifyStudio\Twitter\Service\Querier;
use PrettifyStudio\Twitter\Twitter as TwitterContract;
use DI\Container;
use DI\ContainerBuilder;
use DI\Definition\Source\DefinitionSource;
use function DI\get;
use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * @codeCoverageIgnore
 */
final class PhpDiServiceProvider implements ServiceProviderContract
{
    private ?Container $container = null;

    /**
     * @param  string|array|DefinitionSource  ...$additionalDefinitions
     *
     * @throws Exception
     *
     * @see ContainerBuilder::addDefinitions()
     */
    public function initContainer(...$additionalDefinitions): void
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions($this->getDefinitions(), ...$additionalDefinitions);

        $this->container = $containerBuilder->build();
    }

    /**
     * @noinspection PhpIncludeInspection
     */
    public function getDefinitions(): array
    {
        $config = include sprintf('%s/config/twitter.php', self::ASSETS_DIR);

        return [
            self::PACKAGE_ALIAS => get(TwitterContract::class),
            ConfigurationContract::class => static fn (): ConfigurationContract => Configuration::createFromConfig($config),
            ClientFactory::class => get(ClientCreator::class),
            QuerierContract::class => get(Querier::class),
            TwitterV1Contract::class => get(TwitterV1::class),
            TwitterV2Contract::class => static function (Container $container): TwitterV2Contract {
                $querier = $container->get(QuerierContract::class);
                $configuration = $container->get(ConfigurationContract::class)
                    ->forApiV2();

                return new Accessor($querier->usingConfiguration($configuration));
            },
            TwitterContract::class => get(TwitterV2Contract::class),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $name, ...$concrete): void
    {
        $this->container->set($name, $concrete[0]);
    }

    /**
     * @return mixed
     *
     * @throws ContainerExceptionInterface
     */
    public function resolve(string $name)
    {
        return $this->container->get($name);
    }

    public function getContainer(): ?Container
    {
        return $this->container;
    }
}
