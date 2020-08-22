<?php

namespace spec\Codin\Config\Loaders;

use Codin\Config\ConfigAccessInterface;
use PhpSpec\ObjectBehavior;

class ChainedLoaderSpec extends ObjectBehavior
{
    public function it_should_check_items(ConfigAccessInterface $loader)
    {
        $this->beConstructedWith([$loader]);
        $loader->has('foo')->shouldBeCalled()->willReturn(true);
        $this->has('foo')->shouldReturn(true);
    }

    public function it_should_get_items(ConfigAccessInterface $loader)
    {
        $this->beConstructedWith([$loader]);
        $loader->has('foo')->shouldBeCalled()->willReturn(true);
        $loader->get('foo', null)->shouldBeCalled()->willReturn('bar');
        $this->get('foo')->shouldReturn('bar');
    }
}
