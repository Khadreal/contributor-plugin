<?php
namespace Contributor\Tests\Inc;

use Contributor\Admin\Admin;
use Brain\Monkey\Functions;

class Test_AddContributorsMetaBox extends TestCase {
    private $admin;

    public function setUp(): void {
        parent::setUp();

        $this->admin = $this->getMockBuilder(Admin::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['rt_render_contributors_metabox'])
            ->getMock();
    }

    public function testShouldReturnAsExpected() {
        Functions\expect('add_meta_box')
            ->once()
            ->with(
                'rt_contributors_metabox',
                'Contributors',
                [ $this->admin, 'rt_render_contributors_metabox' ],
                'post',
                'side',
                'default'
            );

        $this->admin->action_add_contributors_meta();

        $this->assertTrue( true );
    }
}