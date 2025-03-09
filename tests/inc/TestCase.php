<?php
namespace Contributor\Tests\Inc;

use PHPUnit\Framework\TestCase as BaseTest;
use Brain\Monkey;
use ReflectionObject;

abstract class TestCase extends BaseTest {
    protected function setUp(): void {
        parent::setUp();

        Monkey\setUp();
    }

    public function configTestData() {
        $obj      = new ReflectionObject( $this );
        $filename = $obj->getFileName();

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