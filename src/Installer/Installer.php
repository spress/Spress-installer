<?php

/*
 * This file is part of the Yosymfony\Spress.
 *
 * (c) YoSymfony <http://github.com/yosymfony>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yosymfony\Spress\Composer\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

/**
 * Installer for Spress 2 add-ons.
 *
 * @author Victor Puertas <vpuertas@gmail.com>
 */
class Installer extends LibraryInstaller
{
    const TYPE_PLUGIN = 'spress-plugin';
    const TYPE_THEME = 'spress-theme';

    const CONFIG_FILE = 'config.yml';
    const PLUGIN_DIR = 'src/plugins';
    const TEMPLATES_DIR_SPRESS_ROOT = 'app/templates';
    const TEMPLATES_DIR = 'spress/spress-templates';
    const CONFIG_DIR = 'app/config';

    /**
     * {@inheritdoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        switch ($package->getType()) {
            case self::TYPE_PLUGIN:
                $dir = $this->getPluginsDir();
            break;

            case self::TYPE_THEME:
                $dir = $this->getThemeDir();
            break;
        }

        $name = $this->getPackageName($package);

        return $dir.'/'.$name;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($packageType)
    {
        return in_array($packageType, [
            self::TYPE_PLUGIN,
            self::TYPE_THEME,
        ], true);
    }

    /**
     * {@inheritdoc}
     */
    public function isInstalled(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if ($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType()) {
            return true;
        }

        return parent::isInstalled($repo, $package);
    }

    /**
     * {@inheritdoc}
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if ($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType()) {
            return;
        }

        parent::install($repo, $package);
    }

    /**
     * {@inheritdoc}
     */
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $package)
    {
        if ($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType()) {
            return;
        }

        parent::update($repo, $initial, $package);
    }

    /**
     * {@inheritdoc}
     */
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        if ($this->isInstallFromSpressRoot() && self::TYPE_PLUGIN === $package->getType()) {
            return;
        }

        parent::uninstall($repo, $package);
    }

    /**
     * Get the theme/plugin name from the package extra info.
     *
     * @param PackageInterface $package
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    protected function getPackageName(PackageInterface $package)
    {
        $extraData = $package->getExtra();
        $name = $package->getName();

        if (isset($extraData['spress_name']) === true) {
            $name = $extraData['spress_name'];
        }

        if (empty($name)) {
            throw new \InvalidArgumentException('The name of the plugin or theme is empty.');
        }

        return $name;
    }

    /**
     * Get the plugins folder.
     *
     * @return string Relative path to composer.json.
     */
    protected function getPluginsDir()
    {
        return self::PLUGIN_DIR;
    }

    /**
     * Get the theme dir.
     *
     * @return string Relative path to composer.json.
     */
    protected function getThemeDir()
    {
        $result = self::TEMPLATES_DIR_SPRESS_ROOT;

        if (false == $this->isInstallFromSpressRoot()) {
            $result = sprintf('%s/%s', $this->vendorDir, self::TEMPLATES_DIR);
        }

        return $result;
    }

    /**
     * Exists the template dir at the Spress installation dir?
     *
     * @return bool
     */
    protected function existsConfigDir()
    {
        return file_exists(self::CONFIG_DIR);
    }

    /**
     * @return bool
     */
    protected function isInstallFromSpressRoot()
    {
        return 'spress/spress' === $this->composer->getPackage()->getName();
    }
}
