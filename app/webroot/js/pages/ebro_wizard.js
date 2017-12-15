/* [ ---- Ebro Admin - wizard ---- ] */



$(function() {

    ebro_wizard.init();

});



ebro_wizard = {
    init: function() {

        if ($('#wizard_a').length) {

            var wizard_form = $('#wizard_a');

            //* wizard

            wizard_form.steps({
                headerTag: "h4",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                labels: {
                    next: "Next",
                    previous: "Previous",
                    finish: "<i class=\"icon-ok\"></i> Submit"

                },
                titleTemplate: "<span class=\"number\">#index#</span> #title#",
                onStepChanging: function(event, currentIndex, newIndex) {



                    // Allways allow previous action even if the current form is not valid!

                    if (currentIndex > newIndex) {

                        return true;

                    }



                    var isFormValid = true;

                    wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {

                        $(this).parsley('validate');

                        isFormValid = $(this).parsley("isValid");

                    });

                    return isFormValid;

                },
                onStepChanged: function(event, currentIndex, priorIndex) {

                    //* resize wizard step to fit error messages

                    ebro_wizard.setHeight();

                },
                onFinishing: function(event, currentIndex) {

                    var isFormValid = true;

                    wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {

                        $(this).parsley('validate');

                        isFormValid = $(this).parsley("isValid");

                    });

                    return isFormValid;

                },
                onFinished: function(event, currentIndex) {

                    //alert("Submitted!");

                    //* uncomment the following to submit form

                    wizard_form.submit();

                }

            });

            //* validate

            wizard_form.parsley({
                errors: {
                    classHandler: function(elem, isRadioOrCheckbox) {

                        if (isRadioOrCheckbox) {

                            return $(elem).closest('div');

                        }

                    },
                    container: function(element, isRadioOrCheckbox) {

                        if (isRadioOrCheckbox) {

                            return element.closest('div');

                        }

                    }

                },
                listeners: {
                    onFieldError: function(elem, constraints, ParsleyField) {

                        //* resize wizard step to fit error messages

                        ebro_wizard.setHeight();

                    },
                    onFieldSuccess: function(elem, constraints, ParsleyField) {

                        //* resize wizard step to fit error messages

                        ebro_wizard.setHeight();

                    }

                }

            });



            //* resize wizard step

            ebro_wizard.setHeight();



        }

        if ($('#wizard_c').length) {

            var wizard_form = $('#wizard_c');

            //* wizard

            wizard_form.steps({
                headerTag: "h4",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                labels: {
                    next: "Next",
                    previous: "Previous",
                    finish: "<i class=\"icon-ok\"></i> Submit"

                },
                titleTemplate: "<span class=\"number\">#index#</span> #title#",
                onStepChanging: function(event, currentIndex, newIndex) {



                    // Allways allow previous action even if the current form is not valid!

                    if (currentIndex > newIndex) {

                        return true;

                    }



                    var isFormValid = true;

                    wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {

                        $(this).parsley('validate');

                        isFormValid = $(this).parsley("isValid");

                    });

                    return isFormValid;

                },
                onStepChanged: function(event, currentIndex, priorIndex) {

                    //* resize wizard step to fit error messages

                    ebro_wizard.setHeight();

                },
                onFinishing: function(event, currentIndex) {

                    var isFormValid = true;

                    wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {

                        $(this).parsley('validate');

                        isFormValid = $(this).parsley("isValid");

                    });

                    return isFormValid;

                },
                onFinished: function(event, currentIndex) {

                    //alert("Submitted!");
                    var flag = 0;
                    //* uncomment the following to submit form

                    var primary_phone = $('#LeadLeadPrimaryphonenumber').val();
                    var email_id = $('#LeadLeadEmailid').val();
                    if (primary_phone == '' && email_id == '') {
                        bootbox.alert('Please type primary phone no. or email id!');


                        flag = 1;
                    }


                    if ($('#LeadLeadCreationType').val() == 4) {
                        flag = 0;
                        var associate = $('#LeadLeadAssociate').val();
                        if (associate == '') {
                            bootbox.alert('Please select associate!');

                            flag = 1;
                        }
                    }




                    if (flag == 0) {
                        wizard_form.submit();
                    }
                    //wizard_form.submit();

                }

            });

            //* validate

            wizard_form.parsley({
                errors: {
                    classHandler: function(elem, isRadioOrCheckbox) {

                        if (isRadioOrCheckbox) {

                            return $(elem).closest('div');

                        }

                    },
                    container: function(element, isRadioOrCheckbox) {

                        if (isRadioOrCheckbox) {

                            return element.closest('div');

                        }

                    }

                },
                listeners: {
                    onFieldError: function(elem, constraints, ParsleyField) {

                        //* resize wizard step to fit error messages

                        ebro_wizard.setHeight();

                    },
                    onFieldSuccess: function(elem, constraints, ParsleyField) {

                        //* resize wizard step to fit error messages

                        ebro_wizard.setHeight();

                    }

                }

            });



            //* resize wizard step

            ebro_wizard.setHeight();



        }


        if ($('#wizard_b').length) {

            var wizard_form = $('#wizard_b');
           

            //* wizard

            wizard_form.steps({
                headerTag: "h4",
                enableAllSteps: true,
                bodyTag: "fieldset",
                enableFinishButton: false,
                enableNextButton: false,
                enablePagination: false,
                currentIndex: 2,
                show: 2,
               onShow:2,
                transitionEffect: "slideLeft",
                titleTemplate: "<span class=\"number\">#index#</span> #title#",
                onStepChanging: function(event, currentIndex, newIndex) {

                    $('#ActionType').val(newIndex);

                    // Allways allow previous action even if the current form is not valid!

                    if (currentIndex < newIndex) {

                        return true;

                    }



                    var isFormValid = true;

                    wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {

                        $(this).parsley('validate');

                        isFormValid = $(this).parsley("isValid");

                    });

                    return isFormValid;

                },
                onStepChanged: function(event, currentIndex, priorIndex) {

                    //* resize wizard step to fit error messages

                    ebro_wizard.setHeight();


                },
                onFinishing: function(event, currentIndex) {

                    var isFormValid = true;

                    wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {

                        $(this).parsley('validate');

                        isFormValid = $(this).parsley("isValid");

                    });

                    return isFormValid;

                },
                onFinished: function(event, currentIndex) {

                    //alert("Submitted!");

                    //* uncomment the following to submit form

                    wizard_form.submit();

                }

            });

            //* validate

            wizard_form.parsley({
                errors: {
                    classHandler: function(elem, isRadioOrCheckbox) {

                        if (isRadioOrCheckbox) {

                            return $(elem).closest('div');

                        }

                    },
                    container: function(element, isRadioOrCheckbox) {

                        if (isRadioOrCheckbox) {

                            return element.closest('div');

                        }

                    }

                },
                listeners: {
                    onFieldError: function(elem, constraints, ParsleyField) {

                        //* resize wizard step to fit error messages

                        ebro_wizard.setHeight();

                    },
                    onFieldSuccess: function(elem, constraints, ParsleyField) {

                        //* resize wizard step to fit error messages

                        ebro_wizard.setHeight();

                    }

                }

            });



            //* resize wizard step

            ebro_wizard.setHeight();



        }

    },
    setHeight: function() {

        setTimeout(function() {

            var cur_height = $('#wizard_a .body.current').filter(':visible').outerHeight();
            var cur_height_b = $('#wizard_b .body.current').filter(':visible').outerHeight();
            var cur_height_c = $('#wizard_c .body.current').filter(':visible').outerHeight();

            $('#wizard_b > .content').height(cur_height_b);
            $('#wizard_c > .content').height(cur_height_c);
            $('#wizard_a > .content').height(cur_height);

        }, 300);

    }

}