## Spress add-ons installer

Plugins and themes installer for Composer.

Package type supported:
* spress-plugin
* spress-theme

Spress add-ons installer ignores Spress plugins packages when you install a theme
from your Spress root folder.

### Extra values in *composer.json*

```
"extra": {
        "spress_name": "Plugin-or-theme-name",
        "spress_class": "Your\\Plugin\\Namespace\\Entry-poin",
    }
```

* **spres_name**: The name of your theme/plugin. Don't uses spaces.
* **spress_class**: The namespace of the class of a plugin (the entry-point to a plugins).