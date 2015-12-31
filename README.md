## Spress add-ons installer

[![Build Status](https://travis-ci.org/yosymfony/Spress-installer.png?branch=master)](https://travis-ci.org/yosymfony/Spress-installer)

Plugins and themes installer for Composer.

Package type supported:

* spress-plugin
* spress-theme

Spress add-ons installer ignores Spress plugins packages when you install a theme
from your Spress root folder.

If you are using Spress as package, the location of the themes is `vendor/yosymfony/spress-templates`.

### Installation

Adds the following to your Spress plugin or theme `composer.json` file:

```json
"require": {
    "yosymfony/spress-installer": "2.0.*"
}
```

### Extra values in *composer.json*

```json
"extra": {
    "spress_name": "Plugin-or-theme-name",
    "spress_class": "Your\\Plugin\\Namespace\\Entry-poin",
}
```

* **spres_name**: The name of your theme/plugin. Don't uses spaces.
* **spress_class**: The namespace of the class of a plugin (the entry-point to a plugins).
