## Spress add-ons installer

[![Build Status](https://travis-ci.org/spress/Spress-installer.png?branch=master)](https://travis-ci.org/spress/Spress-installer)

Plugins and themes installer for Composer.

Package type supported:

* spress-plugin
* spress-theme

### Installation

Adds the following to your Spress plugin or theme `composer.json` file:

```json
"require": {
    "yosymfony/spress-installer": "~2.1"
}
```

### Extra values in *composer.json*

```json
"extra": {
    "spress_name": "Plugin-or-theme-name",
    "spress_class": "Your\\Plugin\\Namespace\\Entry-poin",
}
```

* **spres_name**: The name of your theme/plugin that will be displayed by Spress. Don't uses spaces.
* **spress_class**: The class name of the plugin (including namespaces).

### An example of `composer.json` file

First, an example of a simple plugin without namespaces:

```json
{
    "name": "myname/my-spress-plugin",
    "type": "spress-plugin",
    "license": "MIT",
    "require": {
        "yosymfony/spress-installer": "~2.1"
    }
}
```
