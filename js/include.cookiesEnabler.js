COOKIES_ENABLER.init({
    element: 'ce-elm', // Default class
    bannerHTML: '<div class="ce-banner__inner">'+
                    '<h4 id="ce-banner__header">'+
                        '<div class="cookie-ita">Questo sito internet utilizza cookies</div>'+
                        '<div class="cookie-eng" >This website uses cookies</div>'+
                    '</h4>'+
                    '<div class="cookie-ita">Questo sito internet utilizza cookies per migliorare la vostra esperienza d’uso. Utilizzando il nostro sito internet autorizza l’installazione dei cookies in accordo con la nostra Cookie Policy.</div>'+
                    '<div class="cookie-eng" >This website uses cookies to improve user experience. By using our website you consent to all cookies in accordance with our Cookie Policy.</div>'+
                    '<br>'+
                    '<div class="ce-banner__buttons">'+
                        '<a href="#" class="ce-trigger">'+
                            '<div class="cookie-ita">Accetto</div>'+
                            '<div class="cookie-eng">Enable cookies</div>'+
                        '</a>'+
                        '<a class="ce-more" target="_blank"  href="http://privacy.studioup.it/cookies-policy/?url='+ homeUrl + '" target="_self">'+
                            '<div class="cookie-ita">Maggiori informazioni</div>'+
                            '<div class="cookie-eng" >Privacy policy</div>'+
                        '</a>'+
                    '</div>'+
                '</div>',
    duration: '365', // Default duration cookis 365 days
    eventScroll: false, // Default false
    preventCookies: true,
    gatAnonymized : true,
    whitelistedCookies: ['_cfduid']
});