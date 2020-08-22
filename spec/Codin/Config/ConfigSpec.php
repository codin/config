<?php

declare(strict_types=1);

namespace spec\Codin\Config;

use Codin\Config\ConfigAccessInterface;
use PhpSpec\ObjectBehavior;

class ConfigSpec extends ObjectBehavior
{
    public function it_should_check_items(ConfigAccessInterface $loader)
    {
        $this->beConstructedWith($loader);
        $loader->has('foo')->shouldBeCalled()->willReturn(true);
        $this->has('foo')->shouldReturn(true);
    }

    public function it_should_get_items(ConfigAccessInterface $loader)
    {
        $this->beConstructedWith($loader);
        $loader->get('foo', null)->shouldBeCalled()->willReturn('bar');
        $this->get('foo')->shouldReturn('bar');
    }
}
