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

/**
 * Installer for Spress 2 add-ons.
 *
 * @author Victor Puertas <vpuertas@gmail.com>
 */
class SpressInstaller extends LibraryInstaller
{
    const TYPE_PLUGIN = 'spress-plugin';
    const TYPE_THEME = 'spress-theme';

    /**
     * {@inheritdoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        if ($package->getType() === self::TYPE_PLUGIN) {
            return 'src/plugins/'.$package->getPrettyName();
        }

        return 'src/themes/'.$package->getPrettyName();
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
}
