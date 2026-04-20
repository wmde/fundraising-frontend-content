<?php

declare( strict_types = 1 );

namespace WMDE\Fundraising\Content\Tests\Validation;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RegExPatternValidationTest extends TestCase {

	#[DataProvider( 'validStreetNameProvider' )]
	public function testValidStreetNames( string $streetName ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['street'];

		$this->assertMatchesRegularExpression( "/$pattern/", $streetName);
	}

	#[DataProvider( 'invalidStreetNameProvider' )]
	public function testInvalidStreetNames( string $streetName ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['street'];

		$this->assertDoesNotMatchRegularExpression( "/$pattern/", $streetName);
	}

	public static function validStreetNameProvider(): \Generator {
		yield [ 'Hundestraße 2' ];
		yield [ 'Hundestraße ' ];
		yield [ 'Hundestrasse AAA' ];
		yield [ ' Hundestrasse ' ];
		yield [ '2345678Hundestrasse A2AA' ];
		yield [ 'AA' ];
		yield [ ' Hundestr. 17 ' ];
		yield [ 'Пирогова Ул., дом 22/2, кв. 187' ];
		yield [ 'Pirogova Ul., bld. 22/2, appt. 191' ];
		yield [ '40hao Lou 40dan Yuan 1201' ];
	}

	public static function invalidStreetNameProvider(): \Generator {
		yield [ '.' ];
		yield [ ',7' ];
		yield [ '..ß' ];
	}

	#[DataProvider( 'validCityNameProvider' )]
	public function testValidCityNames( string $cityName ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['city'];

		$this->assertMatchesRegularExpression( "/$pattern/u", $cityName);
	}

	#[DataProvider( 'invalidCityNameProvider' )]
	public function testInvalidCityNames( string $cityName ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['city'];

		$this->assertDoesNotMatchRegularExpression( "/$pattern/u", $cityName);
	}

	public static function validCityNameProvider(): \Generator {
		yield [ 'Augsburg' ];
		yield [ 'Augsburg ' ];
		yield [ ' Augsburg' ];
		yield [ 'Bad Saulgau' ];
		yield [ ' Villingen-Schwenningen' ];
		yield [ 'Villingen-Schwenningen' ];
		yield [ 'Villingen-Schwenningen4' ];
		yield [ '4V' ];
		yield [ '市区-崇文区 ' ];
		yield [ 'Ставрополь' ];
	}

	public static function invalidCityNameProvider(): \Generator {
		yield [ '4' ];
		yield [ '---' ];
		yield [ '.,,' ];
		yield [ ',' ];
	}

	#[DataProvider( 'validPostcodeProvider' )]
	public function testValidPostcodes( string $postcode ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['postcode'];

		$this->assertMatchesRegularExpression( "/$pattern/u", $postcode );
	}

	#[DataProvider( 'invalidPostcodeProvider' )]
	public function testInvalidPostcodes( string $postcode ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['postcode'];

		$this->assertDoesNotMatchRegularExpression( "/$pattern/u", $postcode );
	}

	public static function validPostcodeProvider(): \Generator {
		yield [ '2343545646' ];
		yield [ 'abc abc 1' ];
		yield [ 'AB-CD' ];
		yield [ 'ABC-124' ];
		yield [ '123  - ABC' ];
		yield [ '市区-崇文区 123 ' ];
	}

	public static function invalidPostcodeProvider(): \Generator {
		yield [ ' 3 ' ];
		yield [ ' a' ];
		yield [ '/' ];
		yield [ '---' ];
		yield [ '.,,' ];
		yield [ ',3' ];
	}

	#[DataProvider( 'validCountryProvider' )]
	public function testValidCountries( string $country ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['country'];

		$this->assertMatchesRegularExpression( "/$pattern/u", $country );
	}

	#[DataProvider( 'invalidCountryProvider' )]
	public function testInvalidCountries( string $country ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['country'];

		$this->assertDoesNotMatchRegularExpression( "/$pattern/u", $country );
	}

	public static function validCountryProvider(): \Generator {
		yield [ 'Deutschland ' ];
		yield [ ' Süd Korea ' ];
		yield [ 'България	' ];
		yield [ 'កម្ពុជ' ];
		yield [ 'Nord-Korea' ];
		yield [ 'Südl. Inseln' ];
		yield [ '123  - ABC' ];
		yield [ '中国' ];
	}

	public static function invalidCountryProvider(): \Generator {
		yield [ '/' ];
		yield [ '---' ];
		yield [ '.,,' ];
		yield [ ',' ];
		yield [ ',d' ];
	}

	#[DataProvider( 'validEmailProvider' )]
	public function testEmailValidation( string $email ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['email'];

		$this->assertMatchesRegularExpression( "/$pattern/u", $email );
	}

	#[DataProvider( 'invalidEmailProvider' )]
	public function testInvalidEmails( string $email ): void {
		$addressValidationObject_DE =  $this->loadAddressValidationPatternsFromFile( 'de_DE/data/validation.json' );
		$pattern = $addressValidationObject_DE['email'];

		$this->assertDoesNotMatchRegularExpression( "/$pattern/u", $email );
	}

	public static function validEmailProvider(): \Generator {
		yield [ 'abc@gmail.com' ];
		yield [ 'a.nonymous@example.com ' ];
		yield [ 'name+tag@example.com' ];
		yield [ 'name\@tag@example.com' ];
		yield [ 'spaces\ are\ allowed@example.com' ];
		yield [ '"spaces may be quoted"@example.com' ];
		yield [ 'Pelé@example.com' ];
		yield [ 'δοκιμή@παράδειγμα.δοκιμή' ];
	}

	public static function invalidEmailProvider(): \Generator {
		yield [ 'me@' ];
		yield [ '@example.com' ];
		//yield [ 'me.@example.com' ];
		//yield [ 'me\@example.com' ];
		//yield [ 'me@example..com' ];
	}

	private function loadAddressValidationPatternsFromFile( string $path ): array {
		$file = file_get_contents( __DIR__ . '/../../i18n/' . $path );
		$data = json_decode( $file, true );

		return $data['address'];
	}

}