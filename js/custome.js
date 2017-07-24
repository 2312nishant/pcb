function blinker() {
    $('.comp').fadeOut(500);
    $('.comp').fadeIn(1000);


}
// Wait for window load
$(window).load(function() {



});
setTimeout(blinker, 2000);
setTimeout(jsForIncludePage, 2000);


function jsForIncludePage() {

    /// for rashi
   jQuery("#accordion").accordion({
        heightStyle: "content"
    });
    /// end rashi



    /////check device OS
    if (isMobile.Android()) {
        $('.ios').css('display', 'none');

    } else if (isMobile.iOS()) {
        $('.android').css('display', 'none');
    } else {

    }

    // end os check		





    /* Light YouTube Embeds by @labnol */

    /* Web: http://labnol.org/?p=27941 */



    $('#mainvideo').css('height',$('#videolist').height()+'px')

    jQuery( "#tabs" ).tabs();




    ///  currousal 4
    jQuery('#carousel4').carouFredSel({
        width: '100%',
        direction: "left",
        scroll: {
            duration: 800
        },
        items: {
            visible: 1
        },
        auto: {
            items: 1,
            timeoutDuration: 4000
        },
        prev: {
            button: '#prev4',
            items: 1
        },
        next: {
            button: '#next4',
            items: 1
        }
    });
    ///end carousal 4

}


var updateDisplay = function (voteCount, data) {
    for (var key in data) {
        var sel = 'span.' + key;
        $(sel).width(data[key] / voteCount * 100 + '%');
        data[key] > 0 ? $(sel).html((data[key] / voteCount * 100).toFixed(0) + '%') : $(sel).html('0%');

        $('#vote-count').html(voteCount + ' votes');
    }
};


var isMobile = {
    Windows: function () {
        return /IEMobile/i.test(navigator.userAgent);
    },
    Android: function () {
        return /Android/i.test(navigator.userAgent);
    },
    BlackBerry: function () {
        return /BlackBerry/i.test(navigator.userAgent);
    },
    iOS: function () {
        return /iPhone|iPad|iPod/i.test(navigator.userAgent);
    },
    any: function () {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());
    }
};


			

	
	