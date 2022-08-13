function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement
        }
    }
    var selectorRules = {};
    
    // Validate fields
    function validate(inputElement, rule) {
        var formMessage = getParent(inputElement, options.formGroupSelector).querySelector(options.formMessage)
        var errorMessage;

        // Lấy ra các rules của selector
        var rules = selectorRules[rule.selector];

        // Lặp qua từng rule và ktra
        // Nếu có lỗi thì dừng việc kiểm tra
        for (var i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case "radio":
                case "checkbox":
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ":checked")
                    )
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            if (errorMessage) break;
        }

        if(errorMessage) {
            formMessage.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add("invalid")
        } else {
            formMessage.innerText = "";
            getParent(inputElement, options.formGroupSelector).classList.remove("invalid")
        }

        return !errorMessage
    }

    // Lấy elements của form cần validate
    var formElement = document.querySelector(options.form);
    if (formElement) {
        // Khi submit form
        formElement.onsubmit = function(e) {
            e.preventDefault();

            var isFormValid = true;
            // 
            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector)
                var isValid= validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            })
           

            if (isFormValid) {
                // TH submit với js
                if (typeof options.onSubmit === "function") {
                    var enableInputs = formElement.querySelectorAll("[name");
                    var formValues = Array.from(enableInputs).reduce(function(values, input) {
                        
                        switch(input.type) {
                            case "radio":
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break
                            case "checkbox":
                                if (!input.matches(':checked')) {
                                    if (!Array.isArray(values[input.name])){
                                        values[input.name] = ' '
                                    } 
                                    return values;
                                }
                                if (!Array.isArray(values[input.name])){
                                    values[input.name] = [ ]
                                }
                                values[input.name].push(input.value);
                                break;
                            case "file":
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }
                        
                        return values
                    }, {})
                    options.onSubmit(formValues);
                } 
                // TH submit = HTML
                else {
                    formElement.submit();
                }
            } 
        }

        // Lặp qua mỗi rule và xử lí (lắng nghe các sự kiện blur, oninput, ...)
        options.rules.forEach(function (rule) {

            // Save rules for each input element
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test)
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector)
            
            Array.from(inputElements).forEach(function (inputElement) {
                 // Applied when mouse over/blur the input element
                 inputElement.onblur = function() {
                    validate(inputElement, rule)
                }

                // Applied when users are typing on the input element
                // Using onchange for select tag.
                inputElement.oninput = function() {
                    var formMessage = getParent(inputElement, options.formGroupSelector).querySelector(options.formMessage)
                    formMessage.innerText = "";
                    getParent(inputElement, options.formGroupSelector).classList.remove("invalid")
                }
            })
        })
    }
}

// Define rules:
Validator.isRequired = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            return value ? undefined : "Please enter this field"
        }
    }
}

Validator.isEmail = function(selector) {
     return {
        selector: selector,
        test: function(value) {
            var regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
            return regexEmail.test(value) ? undefined : "Email is not valid"
        }
    }
}

Validator.minLength = function(selector, min) {
    return {
       selector: selector,
       test: function(value) {
           return value.length >= min ? undefined : "At least 6 characters required"
       }
   }
}

Validator.isConfirmed = function(selector, getConfirmValue,message) {
    return {
       selector: selector,
       test: function(value) {
           return value === getConfirmValue() ? undefined : message ||"Not accurate value"
       }
   }
}