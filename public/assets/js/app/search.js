(function () {
    let extractionPage;

    window.APP.search = new function () {

        //Handle search result click
        this.getVideoLink = function (searchItemElement) {
            localStorage.setItem(
                'clicked-search-result',
                encodeURI(searchItemElement.getAttribute('data-href')
                )
            );
            window.open(extractionPage, '_blank');
        };

        this.searchFactory = function (config) {
            let templateSearchResult = Handlebars.compile($('#template-search-result').html());
            let templatePageNumbers = Handlebars.compile($('#template-page-numbers').html());
            let $elMovies = $('#search-results');
            let submitButton = config.form.querySelector('button[type="submit"]');

            extractionPage = config.extractionPage;
            $elMovies.html('<div class="text-center m-3"><i class="fa fa-spinner fa-spin fa-2x"></i></div>');

            APP.UI.showButtonLoader(submitButton);

            let hideLoader = function () {
                $elMovies.html('');
                APP.UI.hideButtonLoader(submitButton);
            };

            APP.Ajax.create().submitForm(config.form)
                .success(function (movies) {
                    if (movies.results.length === 0 || !movies.results[0].title) {
                        $elMovies.html('<div class="alert alert-warning">No movie with such name found.</div>');
                        hideLoader();
                        return;
                    }

                    hideLoader();

                    $elMovies.append(templatePageNumbers({
                        totalPages: (movies.meta.total_pages + 1)
                    }));

                    movies.results.forEach(function (movie) {
                        $elMovies.append(templateSearchResult(movie));
                    });
                })
                .error(hideLoader)
                .fail(hideLoader);
        };

        this.fzmovies = function (form) {
            this.searchFactory({
                form: form,
                extractionPage: '/movies/fzmovies'
            });
        }

        this.femkvcom = function (form) {
            this.searchFactory({
                form: form,
                extractionPage: '/tvshows/480mkv-com'
            });
        };

        this.mobiletvshows = function (form) {
            this.searchFactory({
                form: form,
                extractionPage: '/tvshows/mobiletvshows'
            });
        };

        this.netnaija = function (form) {
            this.searchFactory({
                form: form,
                extractionPage: '/movies/netnaija'
            });
        };
    };
})();