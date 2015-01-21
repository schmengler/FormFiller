SSE = window.SSE || {};
SSE.FormFiller = SSE.FormFiller || {};

SSE.FormFiller.Filler = Class.create();
SSE.FormFiller.Filler.prototype = {
    'initialize' : function() {
    },
    'fill' : function(form) {
    	this.helper = new SSE.FormFiller.FormHelper(window.Faker);
        if (form.id == 'co-billing-form') {
            this.fillAddressForm(form, 'billing:');
        } else if (form.id == 'co-shipping-form') {
            this.fillAddressForm(form, 'shipping:');
        } else if (form.id == 'form-validate') {
            this.fillAddressForm(form, '');
        } else {
            alert('Form with id ' + form.id + ' not recognized');
        }
    },
    'fillAddressForm' : function(form, prefix) {
        var addressData = new SSE.FormFiller.AddressData(window.Faker);
        $H(addressData.values).each(function(value) {
        	var element = $(prefix + value[0]);
        	if (element) element.setValue(value[1]);
        });
        this.helper.randomizeSelect(prefix + 'prefix');
        this.helper.randomizeSelect(prefix + 'country_id');
        this.helper.randomizeSelect(prefix + 'region_id');
    }
}
SSE.FormFiller.AddressData = Class.create();
SSE.FormFiller.AddressData.prototype = {
    'values' : {},
    'initialize' : function(faker) {
        this.faker     = faker;

        this.values.firstname = faker.Name.firstName();
        this.values.lastname  = faker.Name.lastName();
        this.values.company   = faker.Company.companyName();

        this.values.street1   = faker.Address.streetAddress();
        this.values.street_1   = faker.Address.streetAddress();
        this.values.street2   = faker.Address.secondaryAddress();
        this.values.city      = faker.Address.city();
        this.values.postcode  = faker.Address.zipCode();
        this.values.zip       = faker.Address.zipCode();
        this.values.telephone = faker.PhoneNumber.phoneNumber();
        this.values.fax       = faker.PhoneNumber.phoneNumber();

        var email = faker.Internet.email() + '.example.com';
        this.values.email         = email;
        this.values.email_address = email;

        var password = SSE.FormFiller.DEFAULT_PASSWORD || 'test123';
        this.values.password          = password;
        this.values.confirmation      = password;
        this.values.customer_password = password;
        this.values.confirm_password  = password;

        this.addCustomFields();
    },
    'addCustomFields' : function()
    {
    	// add your custom address attributes here:
    	this.values.house_number = this.faker.random.number(999);
    }
};

SSE.FormFiller.FormHelper = Class.create();
SSE.FormFiller.FormHelper.prototype = {
    'initialize' : function(faker) {
        this.faker     = faker;
        this.randomWord = faker.Internet.domainWord();
    },
    //Randomly select dropdown
    'randomizeSelect' : function(el) {
           var $el  = $(el);
           if ($el) {
               var len  = $el.select('option').length - 1;
               $el.select('option')[this.faker.random.number(len) + 1].selected = true;
           }
    }
};

var formFiller = new SSE.FormFiller.Filler();
