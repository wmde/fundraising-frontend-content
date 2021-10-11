<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Content\Tests\Fixtures;

use PHPUnit\Framework\TestCase;

class JsonValidator {

	private TestCase $testCase;
	private string $basePath;

	public function __construct( TestCase $testCase ) {
		$this->testCase = $testCase;
		$this->basePath = __DIR__ . '/../../';
	}

	public function assertJsonFilesHaveMatchingKeys( string $jsonFilePathA, $jsonFilePathB ): void {
		$jsonKeysFromA = $this->getJsonKeys( $jsonFilePathA );
		$jsonKeysFromB = $this->getJsonKeys( $jsonFilePathB );
		$this->testCase->assertSame(
			[],
			array_diff( $jsonKeysFromA, $jsonKeysFromB ),
			"$jsonFilePathB has missing keys"
		);
		$this->testCase->assertSame(
			[],
			array_diff( $jsonKeysFromB, $jsonKeysFromA ),
			"$jsonFilePathB has additional keys that don't exist in $jsonFilePathA"
		);
	}

	private function getJsonKeys( string $path ): array {
		$file = file_get_contents( $this->basePath . $path );
		$data = json_decode( $file, true );
		return array_keys( $data );
	}
}
