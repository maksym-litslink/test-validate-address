let state = {
    originalAddress: null,
    standardizedAddress: null,
};
const addressToText = (address) => {
    return `Address Line 1: ${address.addressLine1}
Address Line 2: ${address.addressLine2}
City: ${address.city}
State: ${address.state}
Zip Code: ${address.zip}`;
};
const addressToFormData = (address) => {
    let formData = new FormData();
    formData.append('addressLine1', address.addressLine1);
    formData.append('addressLine2', address.addressLine2);
    formData.append('city', address.city);
    formData.append('state', address.state);
    formData.append('zip', address.zip);
    return formData;
};

const addressPreview = document.getElementById('addressPreview');
const modal = new bootstrap.Modal(document.getElementById('confirmModal'), {});

document.getElementById('switchToOriginal').addEventListener('click', () => {
    addressPreview.value = addressToText(state.originalAddress);
});
document.getElementById('switchToStandardized').addEventListener('click', () => {
    addressPreview.value = addressToText(state.standardizedAddress);
});

document.getElementById('addressValidate').addEventListener('submit', function(event) {
    event.preventDefault();
    let xhr = new XMLHttpRequest();
    let formData = new FormData(this);

    xhr.open('POST', '/api/usps/validate.php', true);
    xhr.responseType = 'json';
    xhr.send(formData);
    xhr.onload = function() {
        if (xhr.status === 200) {
            state.originalAddress = xhr.response.originalAddress;
            state.standardizedAddress = xhr.response.standardizedAddress;
            addressPreview.value = addressToText(state.standardizedAddress);
            modal.show();
        } else {
            throw new Error('Error submitting the form');
        }
    };
});

document.getElementById('saveButton').addEventListener('click', function(event) {
    let xhr = new XMLHttpRequest();
    const isStandardized = document.querySelector('input[name="type"]:checked').value === 'standardized';
    const formData = addressToFormData(isStandardized ? state.standardizedAddress : state.originalAddress);

    xhr.open('POST', '/api/save.php', true);
    xhr.responseType = 'json';
    xhr.send(formData);
    xhr.onload = function() {
        console.log(xhr.status);
        if (xhr.status === 200) {
            document.getElementById('successAlert').classList.remove('visually-hidden');
            setTimeout(() => {
                modal.hide();
            }, 1000);
        } else {
            throw new Error('Error saving');
        }
    };
});
