<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'aymdev/slim-starter';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'composer/package-versions-deprecated' => '1.11.99.1@7413f0b55a051e89485c5cb9f765fe24bb02a7b6',
  'doctrine/cache' => '1.10.2@13e3381b25847283a91948d04640543941309727',
  'doctrine/dbal' => '3.0.0@ee6d1260d5cc20ec506455a585945d7bdb98662c',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'fig/http-message-util' => '1.1.4@3242caa9da7221a304b8f84eb9eaddae0a7cf422',
  'filp/whoops' => '2.9.1@307fb34a5ab697461ec4c9db865b20ff2fd40771',
  'nikic/fast-route' => 'v1.3.0@181d480e08d9476e61381e04a71b34dc0432e812',
  'opis/closure' => '3.6.1@943b5d70cc5ae7483f6aff6ff43d7e34592ca0f5',
  'php-di/invoker' => '2.2.0@e08a7c87068daeaeef464b95d81643ea530bc535',
  'php-di/php-di' => '6.3.0@955cacea6b0beaba07e8c11b8367f5b3d5abe89f',
  'php-di/phpdoc-reader' => '2.2.1@66daff34cbd2627740ffec9469ffbac9f8c8185c',
  'php-di/slim-bridge' => '3.0.1@e7a568c00ecf6b0128f2a751990e06e77bedec68',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/http-server-handler' => '1.0.1@aff2f80e33b7f026ec96bb42f63242dc50ffcae7',
  'psr/http-server-middleware' => '1.0.1@2296f45510945530b9dceb8bcedb5cb84d40c5f5',
  'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'slim/psr7' => '1.2.0@832912cb3c2a807d472ef0ac392552e85703a667',
  'slim/slim' => '4.6.0@9f6a54f70438655f8c4be63b2b442d34a0c8a142',
  'symfony/polyfill-ctype' => 'v1.20.0@f4ba089a5b6366e453971d3aad5fe8e897b37f41',
  'symfony/polyfill-mbstring' => 'v1.20.0@39d483bdf39be819deabf04ec872eb0b2410b531',
  'twig/twig' => 'v3.1.1@b02fa41f3783a2616eccef7b92fbc2343ffed737',
  'aymdev/slim-starter' => 'dev-master@531955a41a676adcdf80775c88e132e8454ff8f8',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!class_exists(InstalledVersions::class, false) || !InstalledVersions::getRawData()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false) && InstalledVersions::getRawData()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
