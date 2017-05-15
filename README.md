# Kirby revUrl plugin

A file revisioning plugin for [Kirby](https://github.com/getkirby/starterkit) that adds a 12 character MD5 hash to any file URL in the `content` directory. The hash is generated from the file’s `$file->modified()` value. So if the file is modified, the hash changes and the browser will download the changed file instead of loading it from cache.

**Example URL:** `http://yoursite.com/content/1-page/image-201cb25f0ed4.svg`

This plugin does not modify the filename itself. Instead, it just adds the hash to the URL. The corresponding rewrite rules make sure that the URL still works.

## Installation
```
site/
  plugins/
    revUrl/
      revUrl.php
```

To make this plugin work, you must add the following lines (with the corresponding file extensions) to your `.htaccess` file, after the RewriteBase definition and before Kirby’s own rewrite rules.

```apacheConf
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(content\/.*)-[a-f0-9]{12}\.(svg|mp4|webm)$ $1.$2 [L]
```

Note: The plugin is intended for cache-busting with far-future `Expires` headers, so remember to also add the corresponding headers in your Apache / Nginx configuration.

## Usage
```php
$file->revUrl();
```

#### Example:
```html
<img src="<?php echo $page->file('myimage.svg')->revUrl() ?>" alt="…">
```
