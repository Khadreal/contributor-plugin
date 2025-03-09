<?php
namespace Contributor\Tests\Inc;

use Contributor\Frontend\Controller;
use Brain\Monkey\Functions;

/**
 * Test display post contributors
 *
*/
class Test_DisplayPostContributors extends TestCase {

    /**
     * @var $controller
    */
    private $controller;

    public function setUp(): void {
        parent::setUp();

        $this->controller = $this->getMockBuilder(Controller::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['render_view'])
            ->getMock();
    }

    /**
     * @dataProvider configTestData
     */
    public function testShouldReturnAsExpected( $config, $expected ) {
        Functions\when('is_single')->justReturn( $config['is_single'] );

        if( $config['is_single'] ) {
            Functions\when('get_the_ID')->justReturn( $config['post_id'] );
            Functions\when('get_post_meta')->justReturn( $config['contributors'] );
        }

        Functions\when( 'esc_url' )->alias( function( $url ) {
            return str_replace( [ '&amp;', '&' ], '&#038;', $url );
        } );

        $content = $config['content'];
        $unmodified_content = $content;

        if( $expected ) {
            Functions\when('esc_html')->alias(function ($text) {
                return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
            });

            Functions\when('get_userdata')->alias(function ($id) {
                return (object) ['display_name' => "User $id"];
            });

            Functions\when('get_author_posts_url')->alias(function ($id) {
                return "https://example.com/author/$id";
            });

            Functions\when('get_avatar')->alias(function ($id, $size) {
                return "<img src='avatar_$id.png' width='$size' />";
            });

            $this->controller->expects($this->once())
                ->method('render_view')
                ->with('contributors-info-box', $config['args'])
                ->willReturn('<div>Contributors Box</div>');

            $content = $config['modified_content'];
        }
        $expected_content = $this->controller->filter_display_post_contributors( $unmodified_content );

        $this->assertEquals( $content, $expected_content );
    }
}