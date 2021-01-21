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

<<<<<<< HEAD
<<<<<<< Updated upstream
let fetchLinkData = function (link) {
    return new Promise(function (resolve, reject) {
        $ajax.get(link).success(function (...arguments) {
            resolve(...arguments);
        }).error(function (error) {
            reject(error);
        }).fail(function (error) {
            reject(error);
        });
    });
};

let performBasicLinkAction = function (event, $inputUrl, $button, $linkExtractionStatus) {
    event.preventDefault();
    if(! $inputUrl.val()){
        $linkExtractionStatus.html(templateLinkExtractionError({
            message: 'You must provide video url first!'
        }))
        $inputUrl.focus();
        return false;
    }

    $button.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-pulse"></i> Fetching');
    $inputUrl.attr('disabled', 'disabled');
    $linkExtractionStatus.html('');
    return btoa($inputUrl.val());
};

const $modal = $('#modal_general');
=======
let handleSearchResultClick = function ($form, $inputUrl) {
    if (localStorage.getItem('clicked-search-result')){
        setTimeout(function () {
            $inputUrl.val(localStorage.getItem('clicked-search-result'));
            $form.submit();
            localStorage.removeItem('clicked-search-result');
        }, 100);
    }
};

const $modal = $('#modal_general');
>>>>>>> Stashed changes
=======
const $modal = $('#modal_general');
>>>>>>> c3531c6ed659c7e1718d4e97afb688ec60fa9411
