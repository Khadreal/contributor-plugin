<?php
declare(strict_types=1);

namespace Contributor;

use Contributor\Admin\Admin;
use Contributor\Frontend\Controller;

class Loader {
    /**
     * Initialize
     */
    public function init(): void {
        $this->load_components();
    }

    /**
     * Loads all components
     *
     * @return void
     */
    private function load_components(): void {
        ( new Admin() )->register_callbacks();
        ( new Controller() )->register_callbacks();
    }
}
