jQuery(document).ready(function($) {

    if($(".interest-rate").length) {

        // Build Request URL
        var $xml,
            requestUrl = rabodirectGlobals.templateDirectoryURI + '/inc/get-interest-rates.php',
            cacheExpired = isCacheExpired(),
            isCached = (Modernizr.localstorage &&
                typeof localStorage.interestRateData !== 'undefined' &&
                rabodirectGlobals.cacheInterestRates &&
                !cacheExpired);

        //console.log(isCached);

        // Check if the data has been cached
        // If it has, pull the XML out of local storage
        if(isCached) {
            displayRates(JSON.parse(localStorage.interestRateData));
        }
        else {
            // If not, fetch it remotely with AJAX
            // AJAX request made here:
            $.get(requestUrl)
                .fail(showError)
                .done(function(data) {
                    displayRates(data);

                    if(rabodirectGlobals.cacheInterestRates ) {
                        cacheData(data);
                    }

                });
        }


    }

    function basic_format(_rate) {
        if(!_rate) {
            return false;
        }
        if(!isNaN(_rate)) {
            return parseFloat(_rate).toFixed(2) + '%';
        }
        return _rate;
    }

    function advanced_format(_rate) {
        if(_rate) {
            /*     	console.log(rate); */
            _rate = parseFloat(_rate).toFixed(2);
            _rate = '<span class="integer">' + _rate.replace('.', '</span><span class="decimal">.') + '</span>';
            _rate += '<span class="percentage">%</span><span class="per-anum">p.a.</span>';
            return _rate;
        }
        return false;
    }

    // Callback functions

    function showError() {
        //if ajax request is not successful, display a message to the user saying that the figures
        //are not up to date.
        // This should never happen
        var marginTop = $('#wpadminbar').length ? '32px' : '0';

        $('<div class="error-message interest-rate-error">There was a problem connecting to the server, the interest rate figures displayed are not up to date.</div>')
            .appendTo('body')
            .css({
                'margin-top': marginTop
            });

        $('.main-header').css({'margin-top':'44px'});
    }

    function displayRates(data) {

        var currentDate,
            currentDateOutput = $('.current-date');

        // Parse the received data to jQuery explorable format
        var xml = $.parseXML(data);
        $xml = $(xml);

        // Get and display the comparison date
        if(currentDateOutput.length) {
            currentDate = $xml.find('figure[name="comparison_date"]').text();

            if(currentDateOutput.text() !== currentDate) {
                currentDateOutput.text(currentDate);
            }
        }

        //Format each rate
        $('.interest-rate').each(formatRate);
    }

    function formatRate() {
        var $this = $(this);

        var dataRate = $this.attr('data-rate');

        //Rate retrieval from XML
        var rate = $xml.find('figure[name="' + dataRate + '"]').text();

        if( rate ) {
            // Check if the interest rate has the 'advanced' class
            // Format accordingly...
            if($this.hasClass('advanced')) {
                $this.html(advanced_format(rate));
            }
            else {
                $this.text(basic_format(rate));
            }

            $this.removeClass('loading');
        }
        else {
            console.log('ZD ERROR: Invalid rate name. Please check the value in the "rate" attribute of the shortcode');
        }
    }

    function cacheData(data) {
        var d = new Date();

        if(Modernizr.localstorage) {
            localStorage.interestRateData = JSON.stringify(data);
            localStorage.interestRateDataTimestamp = d.getTime();
        }
    }

    function isCacheExpired() {

        var d = new Date();
        // Set cache time limit at X hours
        var cacheMinutes = 0;
        var cacheHours = 1000 * 60 * 60 * parseInt(rabodirectGlobals.cacheInterestRatesHours, 10);
        var cacheDays = 0;
        var cacheLimit = cacheMinutes + cacheHours + cacheDays;
        // If the cache timestamp has been defined and
        // if the difference between the current time and the cached time is greater than X hours
        // then the cache has expired

        //console.log('time diff:');
        //console.log(d.getTime() - localStorage.interestRateDataTimestamp);
        //console.log('cacheLimit:');
        //console.log(cacheLimit);

        return (typeof localStorage.interestRateDataTimestamp !== 'undefined') && (d.getTime() - localStorage.interestRateDataTimestamp) > cacheLimit;
    }

});
