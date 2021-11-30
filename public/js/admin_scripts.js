$(document).ready(function () {

    $('#request-payment-link').on('click', function () {

        this.innerHTML = '<span class="spinner-border spinner-border-sm mr-3" role="status" aria-hidden="true"></span>'+'Пожалуйста подождите...';
        this.classList.remove('btn-primary');
        this.classList.add('btn-secondary');
        this.classList.add('disabled');
    })

});
