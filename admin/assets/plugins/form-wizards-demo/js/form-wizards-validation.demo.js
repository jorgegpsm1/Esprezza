var handleBootstrapWizardsValidation = function() {
	"use strict";
	$("#wizard").bwizard({ validating: function (e, ui) { 
	        if (ui.index == 0){
                if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-1')){
                    return false;
                }
	        } 
            else if (ui.index == 1){
                if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-2')){
                    return false;
                }
	        } 
            else if (ui.index == 2){
                if (false === $('form[name="form-wizard"]').parsley().validate('wizard-step-3')){
                    return false;
                }
	        }
	    } 
	});
};

var FormWizardValidation = function (){
	"use strict";
    return {
        init: function () {
            $.getScript('./assets/plugins/parsley/dist/parsley.js').done(function() {
                $.getScript('./assets/plugins/bootstrap-wizard/js/bwizard.js').done(function(){
                    handleBootstrapWizardsValidation();                    
                });
            });
        }
    };
}();