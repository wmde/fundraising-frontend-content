<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Content\Tests\Validation;

use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Content\Tests\Fixtures\JsonValidator;

class MessagesTest extends TestCase {

	private JsonValidator $jsonValidator;

	protected function setUp(): void {
		$this->jsonValidator = new JsonValidator( $this );
	}

	/** @dataProvider messageKeysDataProvider */
	public function testMessagesKeysMatch( string $jsonFileA, string $jsonFileB): void {
		$this->jsonValidator->assertJsonFilesHaveMatchingKeys( $jsonFileA, $jsonFileB );
	}

	public function messageKeysDataProvider(): array {
		return [
			[ 'i18n/en_GB/messages/messages.json', 'i18n/de_DE/messages/messages.json' ]
		];
	}
}
