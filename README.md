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

Banners on wikipedia.org (managed with CentralNotice) need the "Use of
funds" content (file `data/use_of_funds_content.json`) as data attributes
in an HTML tag. You can extract the "use of funds" content with the script
`bin/extract_to_mediawiki`. Follow these steps to for each language to
make the content available for banners on CentralNotice. The banners will
be able to include this content.

1. Run the script to generate wikitext from the use of funds content.
By default, the script will output the generated "Use of funds" MediaWiki page (in wikitext) to the standard output shell.
In order to copy this output you can use shell pipes:
```shell
bin/extract_to_mediawiki de | xclip -sel c 
#or alternatively, to copy it with a text editor:
bin/extract_to_mediawiki en > tempOutput.txt
```
2. Go to the page for "use of funds" content on metaWiki. There are different pages (resources) for each year and each language:
	* https://meta.wikimedia.org/wiki/MediaWiki:WMDE_Fundraising/UseOfFunds_2023_DE
	* https://meta.wikimedia.org/wiki/MediaWiki:WMDE_Fundraising/UseOfFunds_2023_EN
3. Edit the respective page and paste the output from step 1 and save the changes.


Banners in wikipedia.de currently include the JSON directly.

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
