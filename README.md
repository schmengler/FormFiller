SSE_FormFiller
======
Manually testing the Magento guest checkout can be tedious. To make it easier, **SSE_FormFiller** adds a button "Fill form with random data" to the shipping and billing address forms.

## Installation

### Download ###

Download the [current version from Github](https://github.com/schmengler/FormFiller/archive/master.zip) and copy `app` and `js` into the Magento root directory.

### With Composer ###

In your project's `composer.json`, add `sse/formfiller` to your dependencies:

	{
		"require-dev": {
			"sse/formfiller": "dev-master"
		}
	}

and add the Github repository:

	{
		"repositories": [
			{
				"type": "git",
				"url": "https://github.com/schmengler/FormFiller.git"
			}
		]
	}

## Version 
* Version 0.2.1

## Configuration

The module can be configured in the Magento backend in `System > Configuration > Developer > Form Fill`:

* *Enabled*: The module is enabled by default but you can set this to "No" to completely turn it off.
* *Show button only in developer mode*: If set to yes, the "Fill form with random data" buttons are only shown in developer mode. The scripts are loaded regardless and can be used on the JavaScript console, for example with `formFiller.fill(billingForm.form)`

## Currently supported forms

- Billing Address
- Shipping Address
- Edit Customer Address
- Customer Registration

The module is ready to be extended to support other forms as well:

1. Add the class name of the block that contains the form in `SSE_FormFiller_Model_Observer::_getSupportedBlocks()`
2. Implement the form fill logic dependent on the form id in `SSE.FormFiller.Filler.fill()` (file `js/sse/formfiller.js`)

## Usage in any Magento instance without installation

You can use the form filler in any Magento instance via bookmarklets without installing the extension. It's a bit less convenient and not configurable but it does the job:

* Copy the Bookmarklets from here: https://gist.github.com/schmengler/6244d14a03cbee0cf820
* On a page with fillable form, use the "Load FormFiller" bookmarklet, then the appropiate "Fill form" bookmarklet


## License 
* see [LICENSE](https://github.com/schmengler/blob/master/license.txt) file

## Acknowledgements
* Thanks to Chris Coyier and Adam Lichtenstein for their inspiration in this article: http://css-tricks.com/prefilling-forms-custom-bookmarklet/

* Thanks to Matthew Bergman and Marak Squires for their JavaScript port of **Faker** to generate dummy data: https://github.com/marak/Faker.js/