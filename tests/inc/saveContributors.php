<?php

use Contributor\Admin\Admin;
use Contributor\Frontend\Controller;

class Test_SaveContributors extends TestCase {
    /**
     * Test post ID
     */
    private $post_id;

    private $controller;

    private $user_ids;

    public function setUp(): void {
        parent::setUp();

        $this->controller = new Admin();
    }

    /**
     * Clean up after tests
     */
    public function tearDown(): void {
        wp_delete_post( $this->post_id, true );

        foreach ($this->user_ids as $user_id) {
            wp_delete_user( $user_id );
        }

        $this->user_ids = [];

        parent::tearDown();
    }

    /**
     * @dataProvider configTestData
    */
    public function testShouldReturnAsExpected( $config, $expected) {
        $user_id = $this->factory->user->create([
            'role' => $config['user_role'],
        ]);

        $this->user_ids[] = $user_id;
        wp_set_current_user( $user_id );

        // Create contributor users if needed.
        $contributor_ids = [];
        for ($i = 0; $i < $config['contributor_count']; $i++) {
            $contributor_id = $this->factory->user->create();
            $this->user_ids[] = $contributor_id;
            $contributor_ids[] = $contributor_id;
        }

        if ( ! empty( $contributor_ids ) ) {
            $_POST['rt_contributors'] = $contributor_ids;
        }

        $_POST['rt_contributors_nonce'] = wp_create_nonce( $config['nonce'] );

        $this->post_id = $this->factory->post->create( $config['post'] );

        $this->controller->action_save_contributors( $this->post_id );

        $saved_contributors = get_post_meta( $this->post_id, '_rt_contributors', true );
        $expected_count = $expected['saved_count'];

        if ( $expected['should_save'] ) {
            $this->assertIsArray( $saved_contributors  );
            $this->assertCount( $expected_count, $saved_contributors );

            if ( $expected_count > 0 ) {
                foreach ( $contributor_ids as $contributor_id ) {
                    $this->assertContains( $contributor_id, $saved_contributors );
                }
            }
        } else {
            $this->assertEmpty( $saved_contributors );
        }
    }
}