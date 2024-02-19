import './bootstrap.js';
import $ from 'jquery';

$(document).ready(function () {
    $('#searchInput').on('input', function () {
        let query = $(this).val();

        $.ajax({
            url: '/autocomplete',
            method: 'GET',
            data: {query: query},
            success: function (data) {
                displayResults(data);
            }
        });
    });

    function displayResults(results) {
        let resultsContainer = $('#autocompleteResults');
        resultsContainer.empty();

        let query = $('#searchInput').val().trim();  // Trim whitespace from the input

        if (results.length > 0 && query !== '') {
            for (let i = 0; i < 10; i++) {
                let city = results[i];
                resultsContainer.append(`<div><a href="/cities/${city.id}">${city.name}</a></div>`);
            }

            resultsContainer.show();
        } else if (results.length <= 0 && query !== '') {
            resultsContainer.append(`<div>Nenašli sa žiadne výsledky</div>`);
            resultsContainer.show();
        } else {
            resultsContainer.hide();
        }
    }
});
