function setSite(color, font) {
    document.documentElement.style.setProperty('--me-color', color);
    document.documentElement.style.setProperty('--me-font-family', font);
}

$(function () {
        // debugger
        let href = location.href
        let origin = location.origin
        let pathname = location.pathname
        let hostname = location.hostname.replace("www.", "");
        // hostname = hostname.replace("www.", "")
        let siteName = hostname.split('.')[0];

        document.title = siteName;

        try {
            document.querySelector('[data-clickout-type="native_table_box_processed"]').remove(); // lower advert
        } catch (err) {
        }

        try {
            document.querySelector("#style-css-css").remove(); // theirs style.css
        } catch (err) {
        }

        try {
            document.querySelector("#style-new-css").remove(); // theirs style.css
        } catch (err) {
        }

        try {
            document.querySelector("body > div.main > main > section.container.pb-20.pt-sm-60").remove(); // newsletter
        } catch (err) {
        }

        try {
            document.querySelector(".newsletter.home-newsletter.single").remove(); // newsletter
        } catch (err) {
        }

        try {
            document.querySelector("#widget_container").remove(); // widget Buy/Sell at the best rates
        } catch (err) {
        }

        try {
            document.querySelectorAll(".socials").forEach((e) => { // twitter and others
                e.remove();
            });
        } catch (err) {
        }

        try {
            document.querySelectorAll(".modal").forEach((e) => {
                e.remove();
            });
        } catch (err) {
        }

        try {
            document.querySelectorAll(".article-tag-box").forEach((e) => { // tags
                e.remove();
            });
        } catch (err) {
        }

        try {
            $("a").remove(":contains('Twitter')");
        } catch (err) {
        }

        try {
            $("script").remove(":contains('googletagmanager')");
        } catch (err) {
        }

        try {
            document.querySelectorAll(".p1").forEach((e) => { // tags
                e.remove();
            });
        } catch (err) {
        }

        // get rid ot nasty button of their colour when clicked get security warning /home/al/Pictures/Screenshots/Screenshot from 2023-11-19 21-08-05.png
        try {
            document.querySelectorAll(".raw-html-embed").forEach((e) => {
                e.remove();
            });
        } catch (err) {
        }

        if (pathname === '/') {
            try {
                let sections = document.querySelectorAll("section")
                sections[1].remove()
                sections[5].remove()
                sections[7].remove()
                sections[10].remove()
                sections[11].remove()
                sections[14].remove()
            } catch (err) {
            }
        }

        try {
            document.getElementById('home-main-title').innerText = 'Latest News';
        } catch (err) {
        }

        try {
            document.getElementsByClassName('recommended-title')[0].innerText = 'Editor\' s choice';
        } catch (err) {
        }

        $('.slide-news-main-part').removeClass('slide-news-main-part').addClass('me-slide-news-main-part');
        $('.slide-bot-line').removeClass('slide-bot-line').addClass('me-slide-bot-line');
        // $('.follow-button').removeClass('follow-button').addClass('me-follow-button');
        $('.newsletter-section').removeClass('newsletter-section');

        try {
            document.querySelectorAll(".follow-button").forEach((e) => { // tags
                e.remove();
            });
        } catch (err) {
        }

        $("head").prepend("<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-0WB7KX709G\"></script>" +
            "<script>\n" +
            "  window.dataLayer = window.dataLayer || [];\n" +
            "  function gtag(){dataLayer.push(arguments);}\n" +
            "  gtag('js', new Date());\n" +
            "\n" +
            "  gtag('config', 'G-0WB7KX709G');\n" +
            "</script>" +
            // "<link href=\"/assets/images/favicon.png\" rel=\"shortcut icon\"/>" +
            "<link href=\"https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.2/dist/cookieconsent.css\" rel=\"stylesheet\"/>" +
            "<script defer=\"\" src=\"/assets/js/cookieconsent.js\"></script>" +
            "<script defer=\"\" src=\"/assets/js/cookieconsent-init.js\"></script>" +
            "<script defer=\"\" src=\"/assets/js/frontend.js\"></script>" +
            "<link href=\"/assets/css/style-new.css\" rel=\"stylesheet\"/>"
        );

        try {
            document.querySelectorAll("a").forEach((e) => { // edit links
                if (e.href.search('/ext/') === -1) {
                    e.href = e.href.replace("https://cryptonews.com", "");
                }
            });
        } catch (err) {
        }

        try {
            document.querySelectorAll('.me-mailto').forEach((e) => {
                e.outerHTML = '<a href="mailto:support@' + hostname + '" class="d-inline-block" style="color:#fff">support@' + hostname + '</a>';
            });
        } catch (err) {
        }

        try {
            document.querySelector(".header__logo > img").src = "/assets/images/logos/" + hostname + ".svg";
        } catch (err) {
        }

        if (hostname === 'da.com' || hostname === 'intspeed.com' || hostname === 'amkamdam.com' || hostname === 'xxx.xx') {
            setSite('#025360', 'Kanit')
        }

        if (hostname === 'huy.com' || hostname === 'xxx.xx' || hostname === 'xxx.xx') {
            setSite('pink', 'Oswald')
        }

        if (hostname === 'huy-1.com' || hostname === 'xxx.xx' || hostname === 'xxx.xx') {
            setSite('red', 'Playfair Display')
        }

        // change to site name
        try {
            document.querySelector(".breadcrumbs").children[0].textContent = siteName
        } catch (err) {

        }

        // change to site name
        try {
            document.querySelector("#copyright").textContent = '© 2023 ' + siteName + '. All rights reserved';
        } catch (err) {

        }

        function setSi(e) {
            e.innerHTML = e.innerHTML.replace(/cryptonews/g, siteName);
            e.innerHTML = e.innerHTML.replace(/Cryptonews/g, siteName);
            e.innerHTML = e.innerHTML.replace(/CryptoNews/g, siteName);
        }

        // change to site name
        try {
            document.body.querySelectorAll('.layout-size').forEach(setSi);
        } catch (err) {
        }

        // insert ads
        // index.html
        // $("body > div.main > main > section:nth-child(2) > div > div > div.col-12.col-lg-9 > div.dslot.pb-20.d-md-none").load('/me-index.html [did="16"] > a');
        // $("body > div.main > main > section:nth-child(2) > div > div > div.col-12.col-lg-9 > div.dslot.pb-20.d-none.d-md-block").load('/me-index.html [did="11"] > iframe');
        $("body > div > main > section.container.position-relative.choice-section > div > div:nth-child(3) > div > div > div").load('/me-index.html [did="1"] > iframe');
        // $("body > div.main > main > section:nth-child(5) > div > div").load('/me-index.html [did="2"] > a');

        //news/index.html
        if (pathname === '/news/') {
            $("body > div.main > main > div:nth-child(2) > div > div > div.col-12.col-lg-3 > div.dslot").load('/me-index.html [did="4-news"] > iframe');
        }

        if (pathname === '/news/bitcoin-news/') {
            $("body > div.main > main > div:nth-child(2) > div > div > div.col-12.col-lg-3 > div.dslot").load('/me-index.html [did="4-bitcoin-news"] > iframe');
        }

        if (pathname === '/news/ethereum-news/') {
            $("body > div.main > main > div:nth-child(2) > div > div > div.col-12.col-lg-3 > div.dslot").load('/me-index.html [did="4-ethereum-news"] > iframe');
        }

        if (pathname === '/news/nft-news/') {
            $("body > div.main > main > div:nth-child(2) > div > div > div.col-12.col-lg-3 > div.dslot").load('/me-index.html [did="4-nft-news"] > iframe');
        }

        if (pathname === '/news/press-releases/') {
            $("body > div.main > main > div:nth-child(2) > div > div > div.col-12.col-lg-3 > div.dslot").load('/me-index.html [did="4-press-releases"] > iframe');
        }
        // $("body > div.main > main > div:nth-child(2) > div > div > div.col-12.col-lg-3 > div.dslot").load('/me-index.html [did="4"] > iframe');

        // news/*.htm
        $("body > div.main > div:nth-child(1) > div:nth-child(2) > main > div > div.col-12.col-md-9.mb-40 > div.article-single__content.category_contents_details > div.dslot.text-right").load('/me-index.html [did="9"] > a');
        $("body > div.main > div:nth-child(1) > div:nth-child(2) > div > div:nth-child(1)").load('/me-index.html [did="6"] > a');
        $("body > div.main > div:nth-child(1) > div:nth-child(2) > main > div > div.col-12.col-md-9.mb-40 > div.article-single__content.category_contents_details > div:nth-child(16)").load('/me-index.html [did="12"] > a');
        $("body > div.main > div:nth-child(2) > div:nth-child(2) > main > div > div.col-12.col-md-9.mb-40 > div.article-single__content.category_contents_details > div:nth-child(15)").load('/me-index.html [did="12"] > a');
        $("body > div.main > div:nth-child(1) > div:nth-child(2) > main > div > div.col-12.col-md-9.mb-40 > div.article-single__content.category_contents_details > div.dslot.row.mb-20").load('/me-index.html [did="5"] > a');
        $("body > div.main > div:nth-child(1) > div:nth-child(2) > div > div:nth-child(4)").load('/me-index.html [did="7"] > a');
        $("body > div.main > main > div > div > div.col-12.col-lg-9 > div.scrollspy > div").load('/me-index.html [did="5"] > a');
        $("#altcoins > div > div.dslot").load('/me-index.html [did="5"] > a');
        $("body > div.main > main > div > div.mb-50.c-black > coinlist > div.mb-60.dslot").load('/me-index.html #1160x90 > a');
        $("body > div.main > div > div > main > div.row > div.scrollspy.col-lg-9.col-md-9.col-sm-12 > div:nth-child(2) > div > div > div").load('/me-index.html [did="5"] > a');
        $('.dslot').removeClass('dslot').addClass('huyslot');

        // replace cryptonews's empty image
        try {
            document.querySelectorAll("img").forEach((e) => {
                if (e.dataset.src === 'https://cimg.co/p/assets/empty-cryptonews.jpg' || e.dataset.lazySrc === 'https://cimg.co/p/assets/empty-cryptonews.jpg') {
                    e.dataset.src = "/assets/images/empty-kak-1.jpg";
                    e.dataset.lazySrc = "/assets/images/empty-kak-1.jpg";
                    e.src = "/assets/images/empty-kak-1.jpg";
                }
            });
        } catch (err) {
        }
    }
);

$(window).load(function () {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");
});

// it is in every file but not working must be the lazy loading
window.sid = "1"
window.burl = "https://a2.cryptonews.com"
window.cid = 1
window.trans = {
    ago: "ago",
    ago_long: "minute, minutes, hour, hours, day, days",
    time_seconds_ago: "[time] [seconds] [ago]",
    time_minutes_ago: "[time] [minutes] [ago]",
    time_hours_ago: "[time] [hours] [ago]",
    time_days_ago: "[time] [days] [ago]",
}
