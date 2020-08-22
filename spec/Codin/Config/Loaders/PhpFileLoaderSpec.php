<?php

namespace spec\Codin\Config\Loaders;

use PhpSpec\ObjectBehavior;

class PhpFileLoaderSpec extends ObjectBehavior
{
    public function it_should_check_items()
    {
        $path = sys_get_temp_dir();
        $name = sprintf('phpspec-test-%u', random_int(1, PHP_INT_MAX));
        $filepath = sprintf('%s/%s.php', $path, $name);

        file_put_contents($filepath, "<?php return ['foo' => 'bar'];");

        $this->beConstructedWith($path);
        $this->has($name)->shouldReturn(true);
        $this->has(sprintf('%s.%s', $name, 'foo'))->shouldReturn(true);

        unlink($filepath);
    }

    public function it_should_get_items()
    {
        $path = sys_get_temp_dir();
        $name = sprintf('phpspec-test-%u', random_int(1, PHP_INT_MAX));
        $filepath = sprintf('%s/%s.php', $path, $name);

        file_put_contents($filepath, "<?php return ['foo' => 'bar'];");

        $this->beConstructedWith($path);
        $this->get($name)->shouldReturn(['foo' => 'bar']);

        unlink($filepath);
    }
}
