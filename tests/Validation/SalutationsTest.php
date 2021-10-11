<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Content\Tests\Validation;

use PHPUnit\Framework\TestCase;

class SalutationsTest extends TestCase {
	/**
	 * @dataProvider salutationsDataProvider
	 */
	public function testSalutationsHaveRequiredStructure( array $salutation ): void {
		$this->assertArrayHasKey( 'label', $salutation );
		$this->assertArrayHasKey( 'value', $salutation );
		$this->assertArrayHasKey( 'export_value', $salutation );
		$this->assertArrayHasKey( 'display', $salutation );
		$this->assertArrayHasKey( 'greetings', $salutation );
		$this->assertArrayHasKey( 'formal', $salutation['greetings'] );
		$this->assertArrayHasKey( 'informal', $salutation['greetings'] );
		$this->assertArrayHasKey( 'last_name_informal', $salutation['greetings'] );
	}

	/**
	 * @dataProvider salutationsDataProvider
	 */
	public function testSalutationsValuesAreStrings( array $salutation ): void {
		$this->assertIsString( $salutation['label'] );
		$this->assertIsString( $salutation['value'] );
		$this->assertIsString( $salutation['export_value'] );
		$this->assertIsString( $salutation['display'] );
		$this->assertIsString( $salutation['greetings']['formal'] );
		$this->assertIsString( $salutation['greetings']['informal'] );
		$this->assertIsString( $salutation['greetings']['last_name_informal'] );
	}

	/**
	 * @dataProvider salutationsDataProvider
	 */
	public function testGreetingsItemsExist( array $salutation, string $locale ): void {
		$file = file_get_contents( __DIR__ . "/../../i18n/{$locale}/messages/mail.json" );
		$mailData = json_decode( $file, true );

		$this->assertArrayHasKey( $salutation['greetings']['formal'], $mailData );
		$this->assertArrayHasKey( $salutation['greetings']['informal'], $mailData );
		$this->assertArrayHasKey( $salutation['greetings']['last_name_informal'], $mailData );
	}

	public function salutationsDataProvider(): \Generator {
		foreach ( $this->loadSalutationsFromFile( 'de_DE/data/salutations.json' ) as $salutation ) {
			yield [ $salutation, 'de_DE' ];
		}
		foreach ( $this->loadSalutationsFromFile( 'en_GB/data/salutations.json' ) as $salutation ) {
			yield [ $salutation, 'en_GB' ];
		}
	}

	private function loadSalutationsFromFile( string $path ): array {
		$file = file_get_contents( __DIR__ . '/../../i18n/' . $path );
		$data = json_decode( $file, true );
		return $data['salutations'];
	}
}
