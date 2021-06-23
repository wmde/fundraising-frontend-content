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
		$this->testCase->assertSame(
			[],
			array_diff( $this->getJsonKeys( $jsonFilePathA ), $this->getJsonKeys( $jsonFilePathB ) ),
			"Array keys do not exists in both files"
		);
	}

	private function getJsonKeys( string $path ): array {
		$file = file_get_contents( $this->basePath . $path );
		$data = json_decode( $file, true );
		$filteredData = array_filter( $data, fn( $value ) => $value !== "" );

		return array_keys( $filteredData );
	}
}
