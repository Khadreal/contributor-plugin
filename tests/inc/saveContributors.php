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

        // Set up current user with edit_post capability
        $user_id = $this->factory->user->create([
            'role' => 'administrator',
        ]);

        wp_set_current_user($user_id);
    }

    /**
     * Clean up after tests
     */
    public function tearDown(): void {
        wp_delete_post($this->post_id, true);

        parent::tearDown();
    }

    public function testShouldReturnAsExpected() {
        $contributor1 = $this->factory->user->create();
        $contributor2 = $this->factory->user->create();

        $_POST['rt_contributors'] = array($contributor1, $contributor2);

        // Create and set nonce
        $_POST['rt_contributors_nonce'] = wp_create_nonce('rt_save_contributors');

        // Call the method
        $this->controller->action_save_contributors( $this->post_id );

        // Get the saved contributors
        $saved_contributors = get_post_meta( $this->post_id, '_rt_contributors', true );

        // Assert that the contributors were saved correctly
        $this->assertIsArray($saved_contributors);
        $this->assertCount(2, $saved_contributors);
        $this->assertContains($contributor1, $saved_contributors);
        $this->assertContains($contributor2, $saved_contributors);
    }
}