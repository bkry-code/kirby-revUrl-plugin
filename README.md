# Kirby fileURL plugin

A plugin for [Kirby](https://github.com/getkirby/starterkit) that adds a 12 character MD5 hash to any file URL in the `content` directory for cache-busting purpose. The hash is generated from the file’s `$image->modified()` value. So if the file is modified, the hash changes and the browser will download the changed file instead of loading it from cache.

This plugin does not modify the filename itself. Instead, it just adds the hash to the URL. The corresponding rewrite rules make sure that the URL still works.

## Installation
```
site/
  plugins/
    fileurl/
      fileurl.php
```

To make this plugin work, you must add the following lines to your `.htaccess` file, after the RewriteBase definition and before Kirby’s own rewrite rules.

```apacheConf
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(content\/.*)-([a-f0-9]{12})\.(jpg|gif|png|svg|ico|tiff|bmp|psd|ai|pdf|doc|docx|xls|xlsx|ppt|csv|rtf|zip|tar|gz|gzip|tgz|js|css|html|xml|json|mov|avi|ogg|ogv|webm|flv|swf|mp4|mv4|mp3|m4a|wav|aiff|midi)$ $1.$3 [L]
```
(File types from https://getkirby.com/docs/cheatsheet/file/type)

Note: The plugin is intended for cache-busting with far-future `Expires` headers, so remember to also add the corresponding headers in your Apache / Nginx configuration.

## Usage
```php
fileURL($file);
```

#### Examples:
```html
<img src="<?php echo fileURL($page->file('myimage.jpg')) ?>" alt="…">

<a href="<?php echo fileURL($page->file('myfile.pdf')) ?>">…</a>
```
