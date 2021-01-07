window.onerror = function (event) {
    //alert('An error occurred, please refresh this page and try again.');
    console.log(event);
};

Handlebars.registerHelper('errorMessage', function (message) {
    if (!message) {
        return 'Link extraction failed';
    }

    return message;
});

let ajaxErrorHandler = function (error) {
    console.log('Error occurred');
    console.log(error);
};

const $modal = $('#modal_general');