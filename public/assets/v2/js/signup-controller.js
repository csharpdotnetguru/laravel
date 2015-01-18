$.fn.extend({
    // validates in input / check if it's an email
    isEmail: function() {
        return !!this.val().match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/);
    }
});

var SignupModal = function() {
    'use strict';

    return {
        initialize: function() {
            var that = this;

            // Resetting fields errors when clicking on signup button again
            $('.signup-button').click(function() {
                that.resetFields();

                setTimeout(function() {
                    $('input#firstname').focus();
                }, 500);
            });

            // Calling this.buttonClicked from within an anonymous function
            // to prevent this to get overriden with a jQuery object
//            $('#signupModal button.create-account').unbind('click');
            $('#signupModal button.create-account').click(function() {
//                $(this).button('loading');

                return that.buttonClicked();
            });
        },

        buttonClicked: function() {
            var that = this,
                liTemplate = '<li>The field _FIELDNAME_ is required.</li>';

            this.formHasErrors(function(fieldWithErrors, emailIsDuplicated) {
                if (fieldWithErrors) {
                    that.resetErrors();

                    // Looping through fields to highlight erroneous fields.
                    fieldWithErrors.forEach(function(field) {
                        // appending errors
                        $('.modal-alert ul').append(liTemplate.replace('_FIELDNAME_', that.resolveNameFromField(field)));
                        // highlighting inputs
                        $('#' + field).parent().addClass('has-error');
                    });

                    // prevent form submit
                    return false;
                }

                if (emailIsDuplicated) {
                    that.resetErrors();
                    $('.modal-alert ul').append('<li>The email has already been taken.</li>');
                    $('#email').parent().addClass('has-error');

                    // prevent form submit
                    return false;
                }

                // if no errors have been returned, submit form
                $('#signupModal form').submit();
            });

            // prevent submit while ajax get
            return false;
        },

        // Resetting fields errors
        resetErrors: function() {
            this.resetFields();
            $('.modal-alert.hidden').removeClass('hidden');
        },

        resolveNameFromField: function(fieldName) {
            switch (fieldName) {
                case 'firstname':
                    fieldName = 'First Name';
                    break;
                case 'email':
                    fieldName = 'Email (i.e. user@host.com)';
                    break;
                case 'password':
                    fieldName = 'Password';
                    break;
            }

            return fieldName;
        },

        resetFields: function() {
            $('.modal-alert').addClass('hidden');
            $('.modal-alert ul li').remove();

            $('#firstname').parent().removeClass('has-error');
            $('#email').parent().removeClass('has-error');
            $('#password').parent().removeClass('has-error');
        },

        formHasErrors: function(done) {
            var firstName = $('#firstname').val(),
                password = $('#password').val(),
                email = $('#email').val(),
                passes = true,
                fieldsWithErrors = [];

            // Check each fields
            if ((!firstName) || (firstName.length < 2)) {
                passes = false;
                fieldsWithErrors.push('firstname');
            }

            if ((!password) || (password.length < 6)) {
                passes = false;
                fieldsWithErrors.push('password');
            }

            if (!$('#email').isEmail()) {
                passes = false;
                fieldsWithErrors.push('email');
            }

            if (passes) {
                this.checkEmailForDuplicate(email, function(response) {
                    if (response.success) {
                        done();
                    } else {
                        done(null, true);
                    }
                });
            } else {
                done(fieldsWithErrors, false);
            }
        },

        // calls the check_email method to check if email is duplicated
        checkEmailForDuplicate: function(email, done) {
            if (user_check_email_route) {
                $.get(user_check_email_route + '?email=' + email, function(response) {
                    done(response);
                });
            }
        }
    };

};