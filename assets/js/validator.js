function showError(selector, message) {
    let parentSelector = selector.parentElement;
    let errorMessage = parentSelector.querySelector('.form_field__message');
    parentSelector.classList.add('error');
    errorMessage.innerText = message;
}

function showSuccess(selector) {
    let parentSelector = selector.parentElement;
    let errorMessage = parentSelector.querySelector('.form_field__message');
    parentSelector.classList.remove('error');
    errorMessage.innerText = "";
}

function onlyLettersAndNumbers(value) {
    return /^[A-Za-z0-9]*$/.test(value);
}

function checkLowerCase(value) {
    return value.toUpperCase() != value;
}

function checkUpperCase(value) {
    return value.toLowerCase() != value;
}

function checkSymbol(value) {
    symbols = /[!@#$%^&*]/;
    return symbols.test(value);
}

function checkNumber(value) {
    return /\d/.test(value);
}

function checkBetweenLength(value, min, max) {
    return value.length >= min && value.length <= max;
}

function checkMinLength(value, min) {
    return value.length >= min;
}

function otherFieldValidation(selector) {
    // To validate name, address, ...
    if (!selector.value.trim()) {
        showError(selector, 'Not be blank')
    } else if (!checkMinLength(selector.value.trim(), 5)) {
        showError(selector, 'At least 5 characters required')
    } else {
        showSuccess(selector)
        return true
    }
    return false
}

function checkSelect(selector) {
    if(selector.selectedIndex <=0) {
        showError(selector, 'Not be blank')
    } else {
        showSuccess(selector)
        return true
    }
    return false
}

function checkFileUpload(selector) {
    return selector.value;
}