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

let handleSearchResultClick = function ($form, $inputUrl, $selectChosenQuality = null) {
    if (localStorage.getItem('clicked-search-result')) {
        setTimeout(function () {
            let data = JSON.parse(localStorage.getItem('clicked-search-result'));

            $inputUrl.val(data.url);

            if (null !== $selectChosenQuality) {
                $selectChosenQuality.val(data.quality);
            }

            $form.submit();
            localStorage.removeItem('clicked-search-result');
        }, 100);
    }
};

const $modal = $('#modal_general');
