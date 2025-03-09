<?php
namespace Contributor\Tests\Inc;

use Contributor\Admin\Admin;
use Brain\Monkey\Functions;

class Test_SaveContributors extends TestCase {
    private $controller;

    public function setUp(): void {
        parent::setUp();

        $this->controller = new Admin();
    }

    /**
     * @dataProvider configTestData
    */
    public function testShouldReturnAsExpected( $config, $expected ) {
        $_POST['rt_contributors_nonce'] = $config['nonce_value'];
        $_POST['rt_contributors'] = $config[ 'contributors' ];

        Functions\expect( 'wp_verify_nonce' )
            ->once()
            ->with( $config['nonce_value'], 'rt_save_contributors' )
            ->andReturn( $config['nonce'] );

        if( $config['nonce'] ) {
            Functions\expect('current_user_can')
                ->once()
                ->with('edit_post', $config['post'] )
                ->andReturn( $config['current_user'] );
        }

        if( $expected ) {
            Functions\expect('update_post_meta')
                ->once()
                ->with($config['post'], '_rt_contributors', $config[ 'contributors' ] );
        } else {
            Functions\expect('update_post_meta')->never();
        }

        $this->controller->action_save_contributors( $config['post'] );

        $this->assertTrue(true);
    }
}