<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Content\Tests\Validation;

use PHPUnit\Framework\TestCase;

class HonorificsTest extends TestCase {

	/**
	 * @dataProvider honorificsDataProvider
	 */
	public function testHonorificsAreNotEmpty( array $honorifics ): void {
		$this->assertGreaterThan( 0, count( $honorifics ) );
	}

	public function honorificsDataProvider(): \Generator {
		yield [ $this->loadHonorificsFromFile( 'de_DE/data/honorifics.json' ) ];
		yield [ $this->loadHonorificsFromFile( 'en_GB/data/honorifics.json' ) ];
	}

	private function loadHonorificsFromFile( string $path ): array {
		$file = file_get_contents( __DIR__ . '/../../i18n/' . $path );
		return json_decode( $file, true );
	}
}
