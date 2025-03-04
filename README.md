# Twig Extensions Plugin

The **Twig Extensions** plugin is for [Grav CMS](http://github.com/getgrav/grav). It pulls in a subset of the official [Twig Extensions](https://github.com/twigphp/Twig-extensions) and adds some customizations.

This is also the new home of the [abandoned plugin by Aaron Dalton](https://github.com/Perlkonig/grav-plugin-twig-extensions).

## Installation

Installing the Twig Extensions plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install twig-extensions

This will install the Twig Extensions plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/twig-extensions`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `twig-extensions`. You can find these files on [GitHub](https://github.com/Perlkonig/grav-plugin-twig-extensions) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/twig-extensions

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Installation as dependency (skeleton)

If you don't know this method already, check out this [example of a dependecies file](https://github.com/bitstarr/sebastianlaube/blob/main/user/.dependencies). It can hold all (external) plugins and themes you require to run your project (and are not a custom part of your project repository). When running `bin/grav install` all these will get downloaded and correctly placed automatically.

Add the following to your `.dependecies` file:

```
    twig-extensions:
        url: https://github.com/bitstarr/grav-plugin-twig-extensions
        path: user/plugins/twig-extensions
        branch: main
```

## Configuration

Below is the default configuration. An explanation of the various fields follows. To customize, first copy `twig-extensions.yaml` to your `user/config/plugins` folder and edit that copy.

```
enabled: true
modules: [array, intl, date]
in_admin: false
```

* The `enabled` field turns the plugin off and on.
* The `modules` array tells the plugin which modules you want imported. This plugin only imports three of the five modules. These are the only valid options.
* `in_admin` enables the use of the extensions in the Twig templates of the admin and for plugins hooking into it with custom admin templates.

## Usage

Simply enable the plugin to use these Twig filters. There are three modules available:

* The `Intl` module:
  * `localizeddate` formats a date based on the locale.
  * `localizednumber` formats a number based on the locale.
  * `localizedcurrency` formats a number based on a given currency code.

* The `Array` module:
  * `array_push` (custom filter) adds elements onto the end of array.
  * **Note:** This is useful to add multidimensional, associative arrays, since the `merge` filter is not capable of this
  * `shuffle` randomizes an array.
  * **Note:** This code was slightly modified to allow shuffling associative arrays. Simply pass `true` to enable this feature: `{{ myArray | shuffle(true) }}`.

The `Date` module:
  * `time_diff` dispays the delta between two dates in a human readable form (e.g., `2 days ago`).

For more information, read [the documentation of the original extensions](https://github.com/twigphp/Twig-extensions/tree/master/doc).

### Omitted Modules

* The `Text` module is omitted because Grav already has `truncate` built in, and the `wordwrap` provided here is not very helpful.

* The `I18n` module is omitted because Grav already has extensive i18n features.

### A note on `localizeddate`

Since Version 1.2.1 you can use custom date formats. This feature uses the [IntlDateFormatter::setPattern](https://www.php.net/manual/en/intldateformatter.setpattern.php) method. See the [Unicode docs](https://unicode-org.github.io/icu/userguide/format_parse/datetime/) for more information about the formatting.

```
{{ event.start|localizeddate( 'E, d. MMMM y', 'none', site.default_lang ) }}
```

Will for example output `Mo., 12. Februar 2024` in German.