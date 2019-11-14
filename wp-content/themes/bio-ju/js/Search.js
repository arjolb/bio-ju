jQuery(function ($) {
    //Variables
    let inputField = $('.primary-nav__navigation2--search input');
    let searchContainer = $('.primary-nav__navigation2--search');
    let results = $('#search-results');
    let typingTimer;
    let spinnerVisible = false;
    let previousValue;

    //Events
    $(document).on('click',focusFn);
    inputField.on('keyup',typing);



    searchContainer.on('click',function (e) {
        e.stopPropagation();

        inputField.focus();
        searchContainer.addClass('active');
        // results.addClass('active');
    })




    //Functions
    function focusFn(e) {
        let test = $(e.target);
        
        if (!test.hasClass('primary-nav__navigation2--search') && !test.hasClass('search-results')) {
            searchContainer.removeClass('active');
            results.removeClass('active');
            inputField.val('');
            results.html('');
        }

    }



    function typing(e) {
        if (inputField.val() !== previousValue) {
            clearTimeout(typingTimer);

            if (inputField.val()) {

                results.addClass('active');

                if (!spinnerVisible) {
                    results.html('<div class="spinner-loader"></div>');
                    spinnerVisible = true;
                }
                typingTimer = setTimeout(function () {
                    resultsFn();
                },1000);
            } else {
                results.html('');
                spinnerVisible = false;
            }

        
        } 

        previousValue = inputField.val();
    }

    function resultsFn() {
        $.getJSON('http://localhost:3000/bio-ju/wp-json/bio-ju/v1/search?keyword=' + inputField.val(), (resultsData) => {
            results.html(`
                ${resultsData.length ? '<table><thead><tr><th></th><th></th></tr></thead><tbody>' : 'Nuk u gjet asnje rezultat!'}
                ${resultsData.map(result=>`<tr>  <td><img src="${result.image}"></td>   <td><a href="${result.permalink}">${result.title}</a> </td> </tr>`).join('')}
                ${resultsData.length ? '</tbody></table' : ''}
                `);
        });

        spinnerVisible = false;
    }
})