<?php

/*
 * This file is part of the Kickbox Bundle.
 *
 * (c) Abdoul Ndiaye <abdoul.nd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Andi\KickBoxBundle\Tests\DependencyInjection;

use Andi\KickBoxBundle\DependencyInjection\AndiKickBoxExtension;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AndiKickBoxExtension Test
 */
class AndiKickBoxExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AndiKickBoxExtension
     */
    protected $extension;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->extension = new AndiKickBoxExtension();
    }

    /**
     * @return ContainerBuilder
     */
    protected function getContainer()
    {
        return new ContainerBuilder();
    }

    /**
     * @dataProvider getConfigurations
     *
     * @param array $configs
     * @param bool  $hasException
     */
    public function testLoad(array $configs, $hasException = false)
    {
        $container = $this->getContainer();

        if (true === $hasException) {
            $this->setExpectedException(InvalidConfigurationException::class);
        }

        $this->extension->load($configs, $container);

        $this->assertTrue($container->has('kickbox_client.name1'));

        $this->assertEquals('Andi\KickBoxBundle\Http\Client', $container->getParameter('kickbox.http.client.class'));
        $this->assertEquals('GuzzleHttp\Client', $container->getParameter('kickbox.guzzle.client.class'));
        $this->assertEquals(
            'Andi\KickBoxBundle\Factory\ResponseFactory',
            $container->getParameter('kickbox.http.response.factory.class')
        );
    }

    /**
     * @return array
     */
    public function getConfigurations()
    {
        return [
            [
                [],
                true,
            ],
            [
                [
                    'andi_kick_box' => [
                        'api_keys' => [
                            'name1' => [
                                '' => 'my_key'
                            ]
                        ]
                    ]
                ],
                true,
            ],
            [
                [
                    'andi_kick_box' => [
                        'api_keys' => [
                            'name1' => [
                                'key' => ''
                            ]
                        ]
                    ]
                ],
                true,
            ],
            [
                [
                    'andi_kick_box' => [
                        'api_keys' => [
                            'name1' => [
                                'key' => 'my_key'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
