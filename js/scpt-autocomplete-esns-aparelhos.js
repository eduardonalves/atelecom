﻿/*jslint  browser: true, white: true, plusplus: true */
/*global $: true */

$(function () {
    'use strict';

			$("#aparelho").change(
		
			function()
			{


				var apid = $("#aparelho").val();
				var monitor = $("#aparelho option:selected").attr("id");

    // Load countries then initialize plugin:
    $.ajax({
        url: 'ajax/get-esns-estoque-parceiro.php?monitor=' + monitor + '&apid=' + apid,
        dataType: 'json'
    }).done(function (source) {

        var countriesArray = $.map(source, function (value, key) { return { value: value, data: key }; }),
            countries = $.map(source, function (value) { return value; });

        // Setup jQuery ajax mock:
        $.mockjax({
            url: '*',
            responseTime: 2000,
            response: function (settings) {
                var query = settings.data.query,
                    queryLowerCase = query.toLowerCase(),
                    re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi'),
                    suggestions = $.grep(countriesArray, function (country) {
                         // return country.value.toLowerCase().indexOf(queryLowerCase) === 0;
                        return re.test(country.value);
                    }),
                    response = {
                        query: query,
                        suggestions: suggestions
                    };

                this.responseText = JSON.stringify(response);
            }
        });

        // Initialize ajax autocomplete:
        $('#autocomplete-ajax').autocomplete({
            // serviceUrl: '/autosuggest/service/url',
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                //$('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
                document.forms.filtro.submit();
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x').val(hint);
            },
            onInvalidateSelection: function() {
                $('#selction-ajax').html('You selected: none');
            }
        });

        // Initialize autocomplete with local lookup:
        $('#autocomplete').autocomplete({
            lookup: countriesArray,
            onSelect: function (suggestion) {
                $('#selection').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
            }
        });
        
        // Initialize autocomplete with custom appendTo:
        $('#autocomplete-custom-append').autocomplete({
            lookup: countriesArray,
            appendTo: '#suggestions-container'
        });

        // Initialize autocomplete with custom appendTo:
        $('#autocomplete-dynamic').autocomplete({
            lookup: countriesArray
        });
        
    });

});
});
