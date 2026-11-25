<?php

namespace NextDateExpiryBlock\Tests\Integration;

use WP_UnitTestCase;

class BlockRegistrationTest extends WP_UnitTestCase {
	public function test_block_is_registered(): void {
		$registry = \WP_Block_Type_Registry::get_instance();
		$this->assertTrue( $registry->is_registered( 'next/block-next-date-expiry-block' ) );
	}
}
