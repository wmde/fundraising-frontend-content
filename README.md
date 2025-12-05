# Fundraising frontend content repository

[![Build Status](https://travis-ci.org/wmde/fundraising-frontend-content.svg?branch=master)](https://travis-ci.org/wmde/fundraising-frontend-content)

This is a repository for the textual content of the fundraising application.

## Content Organization
* `data`: Language-independent content that is used internally. Currently it's the black- and whitelists for address fields and comments.
* `i18n`: Language-dependent content. 
	* `de_DE`: Sub folders named by language/locale identifier. Each language has a dedicated subdirectory.
		* `data`: Language-dependent configuration options, like the list of allowed page URLs.
		* `mail`: Mail template snippets. For mail templates that consist of multiple snippets, the templates are placed in a subdirectory. The files must not contain HTML!
		* `messages`: JSON files with translations.
		* `shared`: Content that is used both for E-Mails and in the web application.
		* `web`: Content that is used in the web application. This content may contain simple, valid HTML.
			* `pages`: Content for pages defined in `data/pages.json`
* `resources`: Web resources that will be available through the web server, like images or PDFs.
	* `...`: Language-independent resources (e.g. logos).
	* `de_DE`: Sub folders named by language/locale identifier. Each language has a dedicated subdirectory.
		* `...`: Language-dependent resources (e.g. documents containing text).

## Extracting "Use of funds" content for banners

> [!Note]
> Banners in [`wikipedia.de`](https://github.com/wmde/wikipedia.de-banners/) currently include the JSON directly.

Banners on `wikipedia.org` (managed with 'CentralNotice') need the "Use of funds" content as data attributes in an HTML tag.

First, make sure the source JSON files in `i18n/de_DE/data` and `i18n/en_GB/data` folder contain the latest changes. The source JSON files use the following filename convention: <br>
`use_of_funds_content[_YYYY].json ` <br>
e.g. `use_of_funds_content.json` or `use_of_funds_content_2025.json`

Here, `_YYYY` is optional

The source JSON file without the `_YYYY` suffix will always exist. Sometimes, we are in a transition phase, where we have an *additional* source file with the suffix, with new and improved content. 
During this transition phase, the [fundraising-application](https://github.com/wmde/fundraising-application/blob/6df3f6261981f0fd2582961f87db042eed6298cb/src/Factories/FunFunFactory.php#L438) links to either the file with or without the suffix. During that time, the content repository needs to contain both files, to support the content deployment independent of application deployment. 
See section "[Clean up UoF source JSON file](#clean-up-uof-source-json-file)" to see what happens after the transition phase.

The following text explains how to generate the “Use of Funds” text for MediaWiki for both German and English language
(using `bin/extract_to_mediawiki` script and `Composer` command).

#### Composer command

- Default (no year): `composer mediawiki`
- With year: `composer mediawiki -- [YYYY]`
  -  e.g. `composer mediawiki -- 2026`

**Note**: The `--` ensures Composer forwards `YYYY` to each script entry

#### File‑naming conventions

| JSON source file               | Output file                                                     |
|--------------------------------|-----------------------------------------------------------------|
| use_of_funds_content.json      | 	use-of-funds-de_DE.txt /<br/> use-of-funds-en_GB.txt           |
| use_of_funds_content_2025.json | 	use-of-funds-de_DE-2025.txt /<br/> use-of-funds-de_DE-2025.txt |
| thank_you_content.json         | 	thank-you-de_DE.txt /<br/> thank-you-en_GB.txt                 |
| thank_you_content_2025.json    | 	thank-you-de_DE-2025.txt /<br/> thank-you-de_DE-en_GB-2025.txt |

The [Composer command](#composer-command) will only generate the files with the suffix `_YYYY` when you pass a year (`YYYY`) in.
> [!TIP]
> If you don't want to open the files in a text editor to copy them into MediaWiki, you can copy them directly to the clipboard with the following commands:<br/> `cat mediawiki_use_of_funds_de.txt | xclip -sel c` (Linux) and <br/> `cat mediawiki_use_of_funds_de.txt | pbcopy` (Mac)
#### What is happening behind the scenes?

#### Script: `bin/extract_to_mediawiki`

- Default (no year): `php bin/extract_to_mediawiki <de|en>`
  - `<de|en>`- which language folder to read (de_DE or en_GB).
  - e.g. `php bin/extract_to_mediawiki de` Or `php bin/extract_to_mediawiki en`

- With year: `php bin/extract_to_mediawiki <de|en> [YYYY]`
  - `YYYY` (optional) - four‑digit year
  - e.g. `php bin/extract_to_mediawiki de 2023` Or `php bin/extract_to_mediawiki en 2023`

**Output:**
It writes the output file in the repo's root: `mediawiki_use_of_funds_<lang>[_YYYY].txt`

e.g. `use-of-funds-de_DE.txt` / `use-of-funds-en_GB.txt` Or <br>
&emsp;&emsp;`use-of-funds-de_DE-2025.txt` / `use-of-funds-de_DE-2025.txt`

## Clean up UoF source JSON file

When the [fundraising-application](https://github.com/wmde/fundraising-application/) uses the "latest" UoF, it's time 
 to clean up the duplicate UoF JSON file. Please follow the ticket below to achieve that:

[Remove old UoF content and scripts from content repo](https://phabricator.wikimedia.org/T398431)

## FAQ 

### Where to put translations?
If they are very short snippets of text like labels or messages, place them in `messages/messages.json`. Otherwise, create a file in `mail`, `shared` or `web`.

### What HTML tags are allowed?
Have a look at the [list of allowed tags in the content provider Repository](https://github.com/wmde/fundraising-content-provider/blob/master/src/HtmlPurifier.php#L21-L28).

### What template syntax is allowed?
Only `{% include %}` and `{$ variable $}` statements.

### Where is the regex in data/validation.json used?
These are being shared and used for client and server side validation. Currently, they're being used in the following places:

* The Fundraising Frontend app outputs them as application vars used by Vuejs for client side form validation.
* They are injected into the Fun Validators `AddressValidator` for server side validation.
