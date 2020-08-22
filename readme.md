# Config

Lightweight configuration file loader that supports PHP and JSON files

```shell
$ cat path/to/config/foos.php
<?php return ['foo' => 'bar'];

$ cat path/to/config/bars.json
{"bar":"baz"}
```

```php
$config = Codin\Config\Config::create('path/to/config');
$config->has('foos.foo'); // true
$config->get('foos.foo'); // "bar"
$config->has('bars'); // true
$config->get('bars'); // ['bar' => 'baz']
```
