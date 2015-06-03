<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Tests;

use Andi\KickBoxBundle\AndiKickBoxBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * AndiKickBoxBundle Test
 */
class AndiKickBoxBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AndiKickBoxBundle
     */
    protected $bundle;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->bundle = new AndiKickBoxBundle();
    }

    public function testBundle()
    {
        $this->assertTrue($this->bundle instanceof Bundle);
    }
}
