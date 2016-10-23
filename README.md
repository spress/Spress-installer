## Spress add-ons installer

[![Build Status](https://travis-ci.org/spress/Spress-installer.png?branch=master)](https://travis-ci.org/spress/Spress-installer)

Plugin and theme installer for Composer.

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

### Extra values

```json
"extra": {
    "spress_class": "Your\\Plugin\\Namespace\\Entry-poin",
}
```

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
