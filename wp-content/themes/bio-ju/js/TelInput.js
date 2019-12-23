jQuery(function ($) {
    var input = document.querySelector("#telefoni");
    if (input) {
        window.intlTelInput(input, {
        initialCountry: "AL",
        // geoIpLookup: function(success, failure) {
            // $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            // var countryCode = (resp && resp.country) ? resp.country : "";
            // success(countryCode);
            // failure(resp);
            // });
        // },
        // utilsScript: "/js/utils.js" // just for formatting/placeholders etc
        });        
    }
});