# Progress Bars

[![Version](https://img.shields.io/packagist/v/tfrommen/progress-bars.svg)](https://packagist.org/packages/tfrommen/progress-bars)
[![Status](https://img.shields.io/badge/status-active-brightgreen.svg)](https://github.com/tfrommen/progress-bars)
[![Downloads](https://img.shields.io/packagist/dt/tfrommen/progress-bars.svg)](https://packagist.org/packages/tfrommen/progress-bars)
[![License](https://img.shields.io/packagist/l/tfrommen/progress-bars.svg)](https://packagist.org/packages/tfrommen/progress-bars)

> This plugin registers a configurable shortcode to render HTML5 `<progress>` elements.

## Installation

Install with [Composer](https://getcomposer.org):

```sh
$ composer require tfrommen/progress-bars
```

Or:

1. [Download ZIP](https://github.com/tfrommen/progress-bars/releases).
1. Upload contents to the `/wp-content/plugins/` directory on your web server.
1. Activate the plugin through the _Plugins_ menu in WordPress.
1. Make use of the new `[progress]` shortcode anywhere in your WordPress editor.

### Requirements

This plugin **requires PHP 5.4** or higher, but you really **should be using PHP 7** or higher, as we all know.

## Usage

The following sections will help you get started with Progress Bars.
To be honest, it's no big deal, though.

### Filters

In order to customize certain aspects of the plugin, it provides you with several filters.
For each of these, a short description as well as a code example on how to alter the default behavior is given below.
Just put the according code snippet in your theme's `functions.php` file or your _customization_ plugin, or to some other appropriate place.

#### `\tfrommen\ProgressBars\Shortcode::FILTER_TAG` (`progress_bars.shortcode_tag`)

This filter lets you customize the shortcode tag, which by default is `progress`.

**Usage Example:**

```php
<?php
/**
 * Filters the shortcode tag.
 *
 * @param string $tag The shortcode tag.
 */
add_filter( \tfrommen\ProgressBars\Shortcode::FILTER_TAG, function () {

	return 'progressbar';
} );
```

### Shortcode

The plugin registers a new configurable shortcode, `[progress]`, that you can use to render [HTML5 `<progress>` elements](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/progress).
Below you can find all of the available attributes, each with a short description as well as a usage example.

#### `class`

The `class` shortcode attribute represents the according HTML attribute of the `<progress>` element.

The default value is an empty string, however, the rendered progress bar will always have the HTML class `progress-bar`.

**Usage Example:**

```
[progress class="my-awesome-progress-bar"]
```

The above shortcode results in the following HTML:

```html
<progress class="progress-bar my-awesome-progress-bar" ...></progress>
```

#### `id`

The `id` shortcode attribute represents the according HTML attribute of the `<progress>` element.
If you provide an empty string (or a string of only whitespace characters), the `id` HTML attribute will not be rendered.

The default value is an empty string, which means the HTML attribute will not be included in the generated markup.

**Usage Example:**

```
[progress id="my-awesome-progress-bar"]
```

The above shortcode results in the following HTML:

```html
<progress id="my-awesome-progress-bar" ...></progress>
```

#### `max`

The `max` shortcode attribute represents the according HTML attribute of the `<progress>` element.
This is the **maximum value** of the progress bar, meaning the value at the far right side.
If you provide an empty string (or a string of only whitespace characters), the `max` HTML attribute will not be rendered.

The default value is `100`, which means the progress bar will display the progress of a total of 100 units, or in other words: _per cent_.

**Usage Example:**

```
[progress max="1"]
```

The above shortcode results in the following HTML:

```html
<progress max="1" ...></progress>
```

You now have a progress bar that ranges from 0 to 1.

#### `value`

The `value` shortcode attribute represents the according HTML attribute of the `<progress>` element.
This is the **value** of the progress bar, meaning the current progress.
If you provide an empty string (or a string of only whitespace characters), the `value` HTML attribute will not be rendered.

The default value is `42`.

**Usage Example:**

```
[progress value="0"]
```

The above shortcode results in the following HTML:

```html
<progress value="0" ...></progress>
```

You now have a progress bar showing a progress (value) of 0, so no progress at all.

#### Content

The shortcode can either be used as self-closing one, or as enclosing shortcode around some custom content.
Any provided content will be wrapped in a `<span>` element, and appended to the progress bar markup.

**Usage Example:**

```
[progress max="12" value="5"]May[/progress]
```

The above shortcode results in the following HTML:

```html
<progress max="12" value="5" ...></progress><span class="progress-bar-label">May</span>
```

## License

Copyright (c) 2017 Thorsten Frommen

This code is licensed under the [MIT License](LICENSE).
