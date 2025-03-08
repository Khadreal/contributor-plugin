<?php

use Contributor\Admin\Admin;
use Contributor\Frontend\Controller;

class Test_SaveContributors extends WP_UnitTestCase {
    /**
     * Test post ID
     */
    private $post_id;

    private $controller;

    public function setUp(): void {
        parent::setUp();

        $this->controller = new Admin();

        $this->post_id = $this->factory->post->create([
            'post_title' => 'Test Post',
            'post_status' => 'publish'
        ]);
    }

    /**
     * Clean up after tests
     */
    public function tearDown(): void {
        wp_delete_post($this->post_id, true);

        parent::tearDown();
    }

    /**
     * @dataProvider configTestData
    */
    public function testShouldReturnAsExpected( $config, $expected) {
        $user_id = $this->factory->user->create([
            'role' => $config['user_role'],
        ]);

        $this->test_user_ids[] = $user_id;
        wp_set_current_user($user_id);

        // Create contributor users if needed.
        $contributor_ids = [];
        for ($i = 0; $i < $config['contributor_count']; $i++) {
            $contributor_id = $this->factory->user->create();
            $this->test_user_ids[] = $contributor_id;
            $contributor_ids[] = $contributor_id;
        }

        if ( ! empty( $contributor_ids ) ) {
            $_POST['rt_contributors'] = $contributor_ids;
        }

        $_POST['rt_contributors_nonce'] = 'invalid_nonce';
        if ( $config['valid_nonce'] ) {
            $_POST['rt_contributors_nonce'] = wp_create_nonce('rt_save_contributors');
        }

        $this->controller->action_save_contributors( $this->post_id );

        $saved_contributors = get_post_meta( $this->post_id, '_rt_contributors', true );
        $expected_count = $expected['saved_count'] ?? count( $contributor_ids );
        if ( $expected['should_save'] ) {
            $this->assertIsArray( $saved_contributors  );
            $this->assertCount( $expected_count, $saved_contributors );


            if ( $expected_count > 0 ) {
                foreach ($contributor_ids as $contributor_id) {
                    $this->assertContains( $contributor_id, $saved_contributors );
                }
            }
        } else {
            $this->assertEmpty( $saved_contributors );
        }
    }

    public function configTestData() {
        $filename = __FILE__;

        return $this->getTestData( dirname( $filename ), basename( $filename, '.php' ) );
    }

    /**
     * @param string $dir Test directory
     * @param string $filename Filename
     *
    */
    private function getTestData( $dir, $filename ) {
        if ( empty( $dir ) || empty( $filename ) ) {
            return [];
        }

        $dir = str_replace( 'inc', 'data', $dir );
        $dir = rtrim( $dir, '\\/' );
        $test_data = "$dir/{$filename}.php";

        return is_readable( $test_data )
            ? require $test_data
            : [];
    }
}