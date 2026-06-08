<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Content\Tests\Validation;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HonorificsTest extends TestCase {

	#[DataProvider( 'honorificsDataProvider' )]
	public function testHonorificsAreNotEmpty( array $honorifics ): void {
		$this->assertGreaterThan( 0, count( $honorifics ) );
	}

	public static function honorificsDataProvider(): \Generator {
		yield [ self::loadHonorificsFromFile( 'de_DE/data/honorifics.json' ) ];
		yield [ self::loadHonorificsFromFile( 'en_GB/data/honorifics.json' ) ];
	}

	private static function loadHonorificsFromFile( string $path ): array {
		$file = file_get_contents( __DIR__ . '/../../i18n/' . $path );
		return json_decode( $file, true );
	}
}
