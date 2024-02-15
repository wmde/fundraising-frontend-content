<?php

declare( strict_types=1 );

namespace WMDE\Fundraising\Content\Tests\Validation;

use PHPUnit\Framework\TestCase;

class JsonIsValidTest extends TestCase {

    /**
     * @dataProvider jsonFileDataProvider
     */
    public function testJsonFilesAreValid( string $file ): void {
        json_decode( $file );
        $this->assertTrue( json_last_error() === JSON_ERROR_NONE );
    }

    private function jsonFileDataProvider(): \Generator {
        yield [ $this->loadFile( 'de_DE/data/contact_categories.json' ) ];
        yield [ $this->loadFile( 'de_DE/data/countries.json' ) ];
        yield [ $this->loadFile( 'de_DE/data/faq.json' ) ];
        yield [ $this->loadFile( 'de_DE/data/pages.json' ) ];
        yield [ $this->loadFile( 'de_DE/data/salutations.json' ) ];
        yield [ $this->loadFile( 'de_DE/data/supporters.json' ) ];
        yield [ $this->loadFile( 'de_DE/data/use_of_funds_content.json' ) ];
        yield [ $this->loadFile( 'de_DE/data/validation.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/daysOfTheWeek.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/mail.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/membershipTypes.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/messages.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/pageTitles.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/paymentIntervals.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/paymentProvider.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/paymentStatus.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/paymentTypes.json' ) ];
        yield [ $this->loadFile( 'de_DE/messages/siteMetadata.json' ) ];

        yield [ $this->loadFile( 'en_GB/data/contact_categories.json' ) ];
        yield [ $this->loadFile( 'en_GB/data/countries.json' ) ];
        yield [ $this->loadFile( 'en_GB/data/faq.json' ) ];
        yield [ $this->loadFile( 'en_GB/data/pages.json' ) ];
        yield [ $this->loadFile( 'en_GB/data/salutations.json' ) ];
        yield [ $this->loadFile( 'en_GB/data/supporters.json' ) ];
        yield [ $this->loadFile( 'en_GB/data/use_of_funds_content.json' ) ];
        yield [ $this->loadFile( 'en_GB/data/validation.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/daysOfTheWeek.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/mail.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/membershipTypes.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/messages.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/pageTitles.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/paymentIntervals.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/paymentProvider.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/paymentStatus.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/paymentTypes.json' ) ];
        yield [ $this->loadFile( 'en_GB/messages/siteMetadata.json' ) ];
    }

    private function loadFile( string $path ): string {
        return file_get_contents( __DIR__ . '/../../i18n/' . $path );
    }
}
