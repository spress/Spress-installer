<?php

namespace Yosymfony\Spress\Composer\Test\Installer;

//require __DIR__.'/../../../../../vendor/composer/composer/tests/Composer/TestCase.php';

use Composer\TestCase;
use Composer\Composer;
use Composer\Config;
use Composer\Package\Package;
use Composer\Downloader\DownloadManager;
use Composer\IO\IOInterface;
use Yosymfony\Spress\Composer\Installer\SpressInstaller;

class SpressInstallerTest extends TestCase
{
    /** @var Composer $composer */
    protected $composer;

    /** @var IOInterface $io */
    protected $io;

    protected function setUp()
    {
        $this->composer = new Composer();
        $this->composer->setConfig(new Config());

        $downloadManager = $this->getMockBuilder(DownloadManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->composer->setDownloadManager($downloadManager);

        $this->io = $this->getMock(IOInterface::class);
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
