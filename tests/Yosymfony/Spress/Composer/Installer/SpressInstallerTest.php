<?php

namespace Yosymfony\Spress\Composer\Test\Installer;

require __DIR__.'/../../../../../vendor/composer/composer/tests/Composer/TestCase.php';

use Composer\Util\Filesystem;
use Composer\TestCase;
use Composer\Composer;
use Composer\Config;
use Composer\Package\Package;
use Composer\Downloader\DownloadManager;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\IO\IOInterface;
use Mockery as m;
use Yosymfony\Spress\Composer\Installer\SpressInstaller;

class SpressInstallerTest extends TestCase
{
    /** @var Composer $composer */
    protected $composer;

    /** @var Config $config */
    protected $config;

    /** @var string $vendorDir */
    protected $vendorDir;

    /** @var string $binDir */
    protected $binDir;

    /** @var DownloadManager $downloadManager */
    protected $downloadManager;

    /** @var InstalledRepositoryInterface $repository */
    protected $repository;

    /** @var IOInterface $io */
    protected $io;

    /** @var Filesystem $filesystem */
    protected $filesystem;

    /** @var RootPackage $package */
    protected $package;

    protected function setUp()
    {
        $this->filesystem = new Filesystem();

        $this->composer = new Composer();
        $this->config = new Config();
        $this->composer->setConfig($this->config);

        $this->vendorDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR
            .'composer-test-vendor';
        $this->ensureDirectoryExistsAndClear($this->vendorDir);

        $this->binDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR
            .'composer-test-bin';
        $this->ensureDirectoryExistsAndClear($this->binDir);

        $this->config->merge(
            array(
                'config' => array(
                    'vendor-dir' => $this->vendorDir,
                    'bin-dir' => $this->binDir,
                ),
            )
        );

        $this->downloadManager = m::mock('Composer\Downloader\DownloadManager');
        $this->composer->setDownloadManager($this->downloadManager);

        $this->repository = m::mock('Composer\Repository\InstalledRepositoryInterface');
        $this->io = m::mock('Composer\IO\IOInterface');
    }

    protected function tearDown()
    {
        $this->filesystem->removeDirectory($this->vendorDir);
        $this->filesystem->removeDirectory($this->binDir);
    }

    public function testGetInstallPathForThemes()
    {
        $library = new SpressInstaller($this->io, $this->composer);
        $package = $this->createThemePackage('test-theme');

        $this->assertEquals('src/themes/test-theme', $library->getInstallPath($package));
    }

    public function testGetInstallPathForPlugins()
    {
        $library = new SpressInstaller($this->io, $this->composer);
        $package = $this->createPluginPackage('test-plugin');

        $this->assertEquals('src/plugins/test-plugin', $library->getInstallPath($package));
    }

    public function testSupports()
    {
        $library = new SpressInstaller($this->io, $this->composer);

        $this->assertTrue($library->supports('spress-theme'));
        $this->assertTrue($library->supports('spress-plugin'));
    }

    protected function createThemePackage($name = null)
    {
        $package = new Package($name, '1.0.0', $name);
        $package->setType('spress-theme');

        return $package;
    }

    protected function createPluginPackage($name = null)
    {
        $package = new Package($name, '1.0.0', $name);
        $package->setType('spress-plugin');

        return $package;
    }
}
