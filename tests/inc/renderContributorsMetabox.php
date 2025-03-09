<?php

namespace Contributor\Tests\Inc;

use Contributor\Admin\Admin;
use Brain\Monkey\Functions;
use Brain\Monkey;
use Mockery;

class Test_RenderContributorsMetabox extends TestCase {

    public $editor_id;
    public $admin;

    public function setUp(): void {
        parent::setUp();
        Monkey\setUp();

        $this->admin = Mockery::mock(
            Admin::class . '[render_view]'
        );
    }

    /**
     * @dataProvider configTestData
     */
    public function testShouldReturnAsExpected( $config, $expected ) {
        $users = $config['users'];

        Functions\expect('get_users')
            ->once()
            ->with( [ 'role__in' => ['administrator', 'editor', 'author'] ] )
            ->andReturn( $users );

        Functions\expect( 'get_post_meta' )
            ->once()
            ->with( 123, '_rt_contributors', true )
            ->andReturn( $config['selected_contributors'] );

        Functions\expect( 'wp_nonce_field' )
            ->once()
            ->with( 'rt_save_contributors', 'rt_contributors_nonce' )
            ->andReturnNull();

        if ( ! is_null( $expected ) ) {
            $this->admin->shouldReceive( 'render_view' )
                ->once()
                ->with(
                    'contributors-meta-box',
                    $expected
                )
                ->andReturn('');

            $this->expectOutputString( '' );
        } else {
            $this->admin->shouldReceive( 'render_view' )
                ->never();
        }

        ob_start();
        $this->admin->rt_render_contributors_metabox( $config['post'] );
        ob_get_clean();
    }
}