<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Content\Tests\Validation;

use PHPUnit\Framework\TestCase;
use WMDE\Fundraising\Content\Tests\Fixtures\JsonValidator;

class LocaleKeysTest extends TestCase {

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
			[ 'i18n/en_GB/data/contact_categories.json', 'i18n/de_DE/data/contact_categories.json' ],
			[ 'i18n/en_GB/data/countries.json', 'i18n/de_DE/data/countries.json' ],
			[ 'i18n/en_GB/data/faq.json', 'i18n/de_DE/data/faq.json' ],
			[ 'i18n/en_GB/data/pages.json', 'i18n/de_DE/data/pages.json' ],
			[ 'i18n/en_GB/data/salutations.json', 'i18n/de_DE/data/salutations.json' ],
			[ 'i18n/en_GB/data/supporters.json', 'i18n/de_DE/data/supporters.json' ],
			[ 'i18n/en_GB/data/use_of_funds_content.json', 'i18n/de_DE/data/use_of_funds_content.json' ],
			[ 'i18n/en_GB/data/validation.json', 'i18n/de_DE/data/validation.json' ],
			[ 'i18n/en_GB/messages/daysOfTheWeek.json', 'i18n/de_DE/messages/daysOfTheWeek.json' ],
			[ 'i18n/en_GB/messages/mail.json', 'i18n/de_DE/messages/mail.json' ],
			[ 'i18n/en_GB/messages/membershipTypes.json', 'i18n/de_DE/messages/membershipTypes.json' ],
			[ 'i18n/en_GB/messages/messages.json', 'i18n/de_DE/messages/messages.json' ],
			[ 'i18n/en_GB/messages/pageTitles.json', 'i18n/de_DE/messages/pageTitles.json' ],
			[ 'i18n/en_GB/messages/paymentIntervals.json', 'i18n/de_DE/messages/paymentIntervals.json' ],
			[ 'i18n/en_GB/messages/paymentProvider.json', 'i18n/de_DE/messages/paymentProvider.json' ],
			[ 'i18n/en_GB/messages/paymentStatus.json', 'i18n/de_DE/messages/paymentStatus.json' ],
			[ 'i18n/en_GB/messages/paymentTypes.json', 'i18n/de_DE/messages/paymentTypes.json' ],
			[ 'i18n/en_GB/messages/siteMetadata.json', 'i18n/de_DE/messages/siteMetadata.json' ],
			[ 'i18n/en_GB/messages/validations.json', 'i18n/de_DE/messages/validations.json' ],
		];
	}
}
