<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include(__DIR__ . '/../a.php');
$all_banners = all_banners();
$mail = new PHPMailer(true);

if (filter_input(INPUT_POST, 'send-message', FILTER_SANITIZE_SPECIAL_CHARS) === 'da-send-message') {
    $response = $_POST['cf-turnstile-response'];
    $subject = $_POST['subject'];
    $name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone'];
    $user_message = $_POST['form_message'];

    if (turnstile($response)) {
        $message = /** @lang text */
            "<!DOCTYPE HTML>
            <html lang=\"en\">
            <head>
                <style>
                    .ka {
                        padding: 100px 0 0 0;
                    }
            
                    .ka1 {
                        color: #20bea8;
                    }
            
                    .ka2 {
                        padding: 2% 25% 2% 25%;
                        color: #606662;
                        text-align: left;
            
                    }
            
                    .ka3 {
                        /*background-color: #20bea8;*/
                        /*padding: 10px;*/
                        /*margin: 30px;*/
                        text-decoration: none;
                        color: #fff;
                        font-weight: 700;
                        font-size: 1.3em;
                        /*text-align: left;*/
            
                    }
            
                    .ka4 {
                        background-color: #20bea8;
                        padding: 10px;
                        margin: 30px 25% 30px 25%;
                        text-decoration: none;
                        color: #fff;
                        text-align: center;
                        border-radius: 5px;
            
                    }
            
                    .ku {
                        background-color: #e4edef;
                        padding: 50px 0 50px 0;
                        box-sizing: border-box;
                        display: block;
                        font-family: \"Open Sans\", sans-serif;
                        font-size: 14px;
                        line-height: 20px;
                        color: #8d9a9d;
                        /*text-align: center;*/
            
                    }
            
                    .main-container {
                        background-color: #F6F8F9;
                        /*height: 500px;*/
                        /*padding: 50px;*/
                        text-align: center;
                    }
            
                </style>
            </head>
            <body class=\"\">
            <div class=\"main-container\">
                <div class=\"ka\">
                    <img src=\"https://www.amkamdam.com/assets/images/logo-3.png\" alt=\"\" height=\"50\">
                </div>
                <div class=\"ka1\">
                    A prepaid credit card for the crypto community
                </div>
                <br>
                <div class=\"ka2\">
                    <h3>$name $last_name</h3>
                    <p>$user_message</p>
                    <p>Instant Messenger: $phone</p>
                    <br>
                </div>
                <div class=\"ku\">
                    <img src=\"https://kumpenot.com/media/img/foot.png\" alt=\"\">
                    <p class=\"footer-text\">No. 5, 17/F Bonham Trade Centre, 50 Bonham Strand, Sheung Wan, Hong Kong</p>
                    <p class=\"footer-text\">52-60 Tabernacle Street, London, United Kingdom, EC2A 4NJ</p>
                    <p class=\"footer-copyright\">© 2018-2019 <a href=\"index.htm\">kumpenot Ltd </a></p>
                </div>
            </div>
            </body>
            </html>
            ";

        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output: DEBUG_SERVER
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.ionos.co.uk';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'support@amkamdam.com';                     //SMTP username
            $mail->Password = 'Zaichik1.&';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('support@amkamdam.com');     //Add a recipient
//    $mail->addAddress('ellen@example.com');               //Name is optional
//        $mail->addReplyTo('support@amkamdam.com', 'support');
//        $mail->addCC('alexlisak@hotmail.com');
//    $mail->addBCC('bcc@example.com');

            //Attachments
//        $mail->addAttachment('../assets/images/125.png');         //Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
//            echo 'Message has been sent huy';
        } catch (Exception $e) {
//            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $err = urlencode("You have sent message successfully.");
        header("Location: /contact/?err=$err");
        exit ();
    } else {
        $err = urlencode("Try again.");
        header("Location: /contact/?err=$err");
        exit ();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title id="dynamicTitle">kumpeton</title>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="Crypto News: Latest Cryptocurrency News, Bitcoin News, Ethereum News and Price Data" property="og:title"/>
    <meta content="We deliver up-to-date, breaking crypto news about the latest Bitcoin, Ethereum, Blockchain, NFTs, and Altcoin trends and happenings." name="og:description"/>
    <script defer="" src="/assets/js/frontend.js"></script>
    <link href="/assets/css/frontend.css" rel="stylesheet"/>
    <link href="/assets/images/favicon.png" rel="shortcut icon"/>
    <script>
        window.trans = {
            ago: "ago",
            ago_long: "minute, minutes, hour, hours, day, days",
            time_seconds_ago: "[time] [seconds] [ago]",
            time_minutes_ago: "[time] [minutes] [ago]",
            time_hours_ago: "[time] [hours] [ago]",
            time_days_ago: "[time] [days] [ago]",
        }

    </script>
    <script>
        window.sid = 1;
    </script>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.2/dist/cookieconsent.css">
</head>
<body>
<header class="header" id="header">
    <a class="header__logo" href="/">
        <img alt="Crypto News" src="/assets/images/logo.png"/>
    </a>
    <div class="header-menu">
        <div class="header-menu__trigger d-none d-lg-flex">
            All
            <svg height="7" viewbox="0 0 12 7" width="12" xmlns="http://www.w3.org/2000/svg">
                <g fill-rule="evenodd">
                    <path d="M0 3.999L12 3.999 12 2.999 0 2.999zM0 7L12 7 12 6 0 6zM0 1L12 1 12 0 0 0z"></path>
                </g>
            </svg>
        </div>
        <div class="header-menu__dropdown" hidden="" id="dropdown-menu">
            <div class="container header-menu__dropdown-container">
                <div class="row">
                    <div class="col-12 col-lg-2">
                        <div class="header-links__dropdown-list">
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/news/">News</a><span>+</span>
                            </div>
                            <ul class="header-menu__dropdown-children">
                                <li><a href="/news/bitcoin-news/">Bitcoin News</a></li>
                                <li><a href="/news/ethereum-news/">Ethereum News</a></li>
                                <li><a href="/news/nft-news/">NFT News</a></li>
                                <li><a href="/news/defi-news/">DeFi News</a></li>
                                <li><a href="/news/altcoin-news/">Altcoin News</a></li>
                                <li><a href="/news/blockchain-news/">Blockchain News</a></li>
                                <li><a href="/news/press-releases/">Press Releases</a></li>
                                <li><a href="/news/sponsored/">Sponsored</a></li>
                                <li><a href="/news/industry-talk/">Industry Talk</a></li>
                                <li><a href="/news/ico-news/">ICO news</a></li>
                                <li><a href="/news/finance-news/">Finance News</a></li>
                                <li><a href="/news/technology-news/">Technology News</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2">
                        <div class="header-links__dropdown-list">
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/exclusives/">Exclusives</a><span>+</span>
                            </div>
                            <ul class="header-menu__dropdown-children">
                                <li><a href="/exclusives/features/">Features</a></li>
                                <li><a href="/exclusives/opinions/">Opinions</a></li>
                                <li><a href="/exclusives/people/">People In Crypto</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2">
                        <div class="header-links__dropdown-list">
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/guides/">Guides</a><span>+</span>
                            </div>
                            <ul class="header-menu__dropdown-children">
                                <li><a href="/guides/bitcoin/">Bitcoin</a></li>
                                <li><a href="/guides/ethereum/">Ethereum</a></li>
                                <li><a href="/guides/nft/">NFT</a></li>
                                <li><a href="/guides/defi-guides/">Defi Guides</a></li>
                                <li><a href="/guides/altcoins/">Altcoins</a></li>
                                <li><a href="/guides/blockchain/">Blockchain</a></li>
                                <li><a href="/guides/cryptocurrency/">Cryptocurrency</a></li>
                                <li><a href="/guides/icos/">ICOs / STOs / IEOs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2">
                        <div class="header-links__dropdown-list">
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/reviews/exchanges/">Exchanges</a><span></span>
                            </div>
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/coins/">Market Cap</a><span></span>
                            </div>
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/news/press-releases/">Press Releases</a><span></span>
                            </div>
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/news/industry-talk/">Industry Talk</a><span></span>
                            </div>
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="/exclusives/opinions/">Opinions</a><span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2">
                        <div class="header-links__dropdown-list">
                            <div class="header-menu__dropdown-heading">
                                <a class="heading" href="#">Recommended</a><span>+</span>
                            </div>
                            <ul class="header-menu__dropdown-children">
                                <li>
                                    <a href="/news/best-crypto-to-buy.htm"> Best crypto to buy now</a>
                                </li>
                                <li>
                                    <a href="/news/best-crypto-presales.htm"> Best crypto presales to invest in</a>
                                </li>
                                <li>
                                    <a href="/news/new-cryptocurrency.htm"> New cryptocurrency</a>
                                </li>
                                <li>
                                    <a href="/news/next-cryptocurrency-to-explode.htm"> Next cryptocurrency to explode</a>
                                </li>
                                <li>
                                    <a href="/news/best-crypto-icos.htm"> Best crypto icos</a>
                                </li>
                                <li>
                                    <a href="/news/crypto-launches.htm"> Crypto launches</a>
                                </li>
                                <li>
                                    <a href="/news/best-bitcoin-betting-sites.htm"> Crypto betting</a>
                                </li>
                                <li>
                                    <a href="/news/best-bitcoin-casinos.htm"> Bitcoin casinos</a>
                                </li>
                                <li>
                                    <a href="/news/best-bitcoin-gambling-sites.htm"> Bitcoin gambling sites</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-links d-none d-lg-flex">
        <ul class="menu_header">
            <li></li>
            <li>
                <a href="/news/">News
                    <span class="menu_icon"></span></a><span class="menu_icon mob"></span>
                <ul class="sub-menu">
                    <li><a href="/news/bitcoin-news/">Bitcoin News</a></li>
                    <li><a href="/news/ethereum-news/">Ethereum News</a></li>
                    <li><a href="/news/nft-news/">NFT News</a></li>
                    <li><a href="/news/defi-news/">DeFi News</a></li>
                    <li><a href="/news/altcoin-news/">Altcoin News</a></li>
                    <li><a href="/news/blockchain-news/">Blockchain News</a></li>
                    <li><a href="/news/press-releases/">Press Releases</a></li>
                    <li><a href="/news/sponsored/">Sponsored</a></li>
                    <li><a href="/news/industry-talk/">Industry Talk</a></li>
                    <li><a href="/news/ico-news/">ICO news</a></li>
                    <li><a href="/news/finance-news/">Finance News</a></li>
                    <li><a href="/news/technology-news/">Technology News</a></li>
                </ul>
            </li>
            <li>
                <a href="/exclusives/">Exclusives
                    <span class="menu_icon"></span></a><span class="menu_icon mob"></span>
                <ul class="sub-menu">
                    <li><a href="/exclusives/features/">Features</a></li>
                    <li><a href="/exclusives/opinions/">Opinions</a></li>
                    <li><a href="/exclusives/people/">People In Crypto</a></li>
                </ul>
            </li>
            <li>
                <a href="/guides/">Guides
                    <span class="menu_icon"></span></a><span class="menu_icon mob"></span>
                <ul class="sub-menu">
                    <li><a href="/guides/bitcoin/">Bitcoin</a></li>
                    <li><a href="/guides/ethereum/">Ethereum</a></li>
                    <li><a href="/guides/nft/">NFT</a></li>
                    <li><a href="/guides/defi-guides/">Defi Guides</a></li>
                    <li><a href="/guides/altcoins/">Altcoins</a></li>
                    <li><a href="/guides/blockchain/">Blockchain</a></li>
                    <li><a href="/guides/cryptocurrency/">Cryptocurrency</a></li>
                    <li><a href="/guides/icos/">ICOs / STOs / IEOs</a></li>
                </ul>
            </li>
            <li>
                <a href="/reviews/exchanges/">Exchanges
                </a>
            </li>
            <li>
                <a href="/coins/">Market Cap</a>
            </li>
            <li>
                <a href="/news/press-releases/">Press Releases</a>
            </li>
            <li>
                <a href="/news/industry-talk/">Industry Talk</a>
            </li>
            <li>
                <a href="/exclusives/opinions/">Opinions</a>
            </li>
            <li>
                <a href="#">Recommended
                    <span class="menu_icon"></span></a><span class="menu_icon mob"></span>
                <ul class="sub-menu">
                    <li>
                        <a href="/news/best-crypto-to-buy.htm"> Best crypto to buy now</a>
                    </li>
                    <li>
                        <a href="/news/best-crypto-presales.htm"> Best crypto presales to invest in</a>
                    </li>
                    <li>
                        <a href="/news/new-cryptocurrency.htm"> New cryptocurrency</a>
                    </li>
                    <li>
                        <a href="/news/next-cryptocurrency-to-explode.htm"> Next cryptocurrency to explode</a>
                    </li>
                    <li>
                        <a href="/news/best-crypto-icos.htm"> Best crypto icos</a>
                    </li>
                    <li>
                        <a href="/news/crypto-launches.htm"> Crypto launches</a>
                    </li>
                    <li>
                        <a href="/news/best-bitcoin-betting-sites.htm"> Crypto betting</a>
                    </li>
                    <li>
                        <a href="/news/best-bitcoin-casinos.htm"> Bitcoin casinos</a>
                    </li>
                    <li>
                        <a href="/news/best-bitcoin-gambling-sites.htm"> Bitcoin gambling sites</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="header-search">
        <div class="header-menu__trigger d-md-none">
            All
            <svg height="7" viewbox="0 0 12 7" width="12" xmlns="http://www.w3.org/2000/svg">
                <g fill-rule="evenodd">
                    <path d="M0 3.999L12 3.999 12 2.999 0 2.999zM0 7L12 7 12 6 0 6zM0 1L12 1 12 0 0 0z"></path>
                </g>
            </svg>
        </div>
        <div class="header-search__trigger">
            <svg height="14" viewbox="0 0 14 14" width="14" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 11c-2.757 0-5-2.243-5-5 0-1.198.441-2.284 1.146-3.146.212-.26.448-.495.708-.708C3.716 1.441 4.802 1 6 1c2.757 0 5 2.243 5 5 0 1.198-.441 2.284-1.146 3.146-.212.26-.448.496-.708.708C8.284 10.559 7.198 11 6 11zm4.579-1.128C11.464 8.827 12 7.477 12 6c0-3.313-2.687-6-6-6-1.477 0-2.827.536-3.872 1.421-.255.216-.491.452-.707.707C.536 3.173 0 4.523 0 6c0 3.313 2.687 6 6 6 1.477 0 2.827-.536 3.872-1.421L13.293 14l.707-.707-3.421-3.421z" fill="#212121"
                      fill-rule="evenodd"></path>
            </svg>
        </div>
        <form action="/search/" class="header-search__form">
            <input aria-label="search" class="remove-outline" name="q" placeholder="What are you searching for?" type="search"/>
            <div class="header-search__close">
                <svg id="Capa_1" version="1.1" viewbox="0 0 512 512" x="0px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" y="0px">
                    <g>
                        <polygon points="512,28.308 483.692,0 256,227.692 28.308,0 0,28.308 227.692,256 0,483.692 28.308,512 256,284.308 483.692,512
    512,483.692 284.308,256"></polygon>
                    </g>
                </svg>
            </div>
        </form>
    </div>
</header>
<div class="main">
    <main>
        <div class="container">
            <div class="breadcrumbs mb-20">
                <a href="/">Kumkanot</a>
                <a href="/about-us.htm">About Us</a>
            </div>
            <div class="mb-80">
                <h1 class="scrollspy" id="about-us"> About Us</h1>
                <div class="layout-size">
                    <p>Kumkanot.com offers original coverage of the global blockchain and cryptocurrency news, provides opinions, reviews, guides, introduces to Crypto people with an aim to help the general public understand and successfully use these technologies now and in the future. </p>
                    <p>We believe that the most important thing in the Blockchain revolution is the ability of people to understand and embrace the change. Our journalism standards - impartiality, truthfulness, transparency, and accuracy - will help you navigate this extremely dynamic world.</p>
                    <p>Join us in this journey, as there are millions of things to learn and understand. The change happens by bringing all the voices together. </p>
                    <p>Kumkanot.com is backed by Antanas Guoga, ultimate blockchain enthusiast, founder of the International Blockchain Centre in Vilnius, Lithuania, entrepreneur and former Member of the European Parliament. Guoga is also known as TonyG for his poker acumen, both as world-caliber player and founder of pokernews.com (sold in 2014).</p>
                </div>
            </div>
        </div>
        <div class="vapp" data-v-app="">
            <section class="container mb-60">
                <div class="row">
                    <div class="col-12 col-md-8 offset-lg-1 col-lg-7 offset-xl-2 col-xl-6" id="formblock">
                        <form novalidate="" class="contact-form mb-40" id="ContactForm" action="/contact/" method="post">
                            <div class="row">
                                <input type="hidden" name="send-message" value="da-send-message">
                                <div class="col-12 col-md-6" value="" data-v-a14ff93e=""><input type="text" name="first_name" placeholder="First name*" data-v-a14ff93e=""><span class="error-msg" data-v-a14ff93e=""></span></div>
                                <div class="col-12 col-md-6" value="" data-v-a14ff93e=""><input type="text" name="last_name" placeholder="Last name*" data-v-a14ff93e=""><span class="error-msg" data-v-a14ff93e=""></span></div>
                                <div class="col-12 col-md-6" value="" data-v-a14ff93e=""><input type="text" name="email_address" placeholder="Email Address*" data-v-a14ff93e=""><span class="error-msg" data-v-a14ff93e=""></span></div>
                                <div class="col-12 col-md-6" value="" data-v-a14ff93e=""><input type="text" name="phone" placeholder="Phone number" data-v-a14ff93e=""><span class="error-msg" data-v-a14ff93e=""></span></div>
                                <div class="col-12" value="" data-v-a14ff93e=""><input type="text" name="subject" placeholder="Subject*" data-v-a14ff93e=""><span class="error-msg" data-v-a14ff93e=""></span></div>
                                <div class="col-12" data-v-772218ee=""><textarea name="form_message" rows="3" placeholder="Your message*" data-v-772218ee="">
        </textarea><span class="error-msg" data-v-772218ee=""></span></div><!---->
                                <div class="col-12">
                                    <div class="contact-form__consent fs-12 mb-30">By submitting you agree to the processing of personal data. Read our <a href="/privacy-policy.htm">Privacy Policy</a></div>
                                </div>
                                <div class="col-12">
                                    <div class="checkbox mb-3" style="margin: 5px 0 5px 0">
                                        <div class="cf-turnstile" data-sitekey="<?= SITE_KEY ?>" data-theme="light"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="button-more button-more--big button-more--gradient remove-outline">Submit Form
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="6" viewBox="0 0 20 6">
                                            <path fill="#6C7473" fill-rule="evenodd" d="M6 0L1 5 0 6 1.414 6 19.999 6 19.999 5 2.413 5 6 1.415z" transform="matrix(-1 0 0 1 19.999 0)"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-4 offset-xl-1 col-xl-3 align-self-center">
                        <div class="contact-sidebar nowrap">
                            <div class="mb-30">
                                <div class="d-inline-block mr-10 align-top">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="12" viewBox="0 0 12 12">
                                        <g transform="translate(-1095 -1243) translate(295 1103) translate(770 35) translate(30 100) translate(0 5) translate(0 2)">
                                            <path fill="#FFF" d="M11.063 6.797c0 .13-.106.234-.235.234H1.172c-.13 0-.234-.105-.234-.234V1.321l4.81 3.06c.154.097.35.097.503 0l4.811-3.06v5.476zM9.918.938L6 3.43 2.08.94h7.84zM10.83 0H1.17C.531 0 0 .521 0 1.172v5.625C0 7.443.525 7.97 1.17 7.97h9.658c.646 0 1.17-.526 1.17-1.172V1.172C12 .53 11.476 0 10.83 0z"></path>
                                        </g>
                                    </svg>
                                </div>
                                <a href="mailto:info@cryptonews.com" class="d-inline-block"> info@cryptonews.com huy</a></div>
                            <div class="mb-30">
                                <div class="d-inline-block"> Blockwise media LTD <br> Trust Company Complex, Ajeltake Road <br> Ajeltake Island, Majuro <br> Republic of the Marshall Islands <br> MH 96960 <br></div>
                            </div>
                            <div class="socials socials--white socials--h-grey"><a href="https://www.facebook.com/cryptonewscom-720874761445956/" class="ssk ssk-facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path fill="#CCC" d="M8.854 4.155H7.072V2.97c.131-1.119 1.981-.907 1.981-.907V.138H9.05C8.986.123 5.37-.735 4.653 2.017l-.001.002-.006.018c-.113.345-.105 1.92-.103 2.118H3v2.107h1.64v5.732h2.388V6.262h1.827l.205-2.107h-.205z"></path>
                                    </svg>
                                </a><a href="https://twitter.com/Cryptonews" class="ssk ssk-twitter">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path fill="#CCC" fill-rule="evenodd"
                                              d="M10.771 3.429c.156 3.462-2.427 7.323-6.997 7.323-1.39 0-2.685-.407-3.774-1.107 1.306.155 2.609-.208 3.645-1.019-1.078-.019-1.987-.73-2.3-1.71.385.074.765.053 1.111-.042C1.272 6.637.454 5.57.482 4.43c.332.184.71.295 1.115.308C.5 4.005.19 2.557.835 1.45 2.05 2.94 3.863 3.92 5.91 4.022 5.55 2.482 6.718 1 8.308 1c.708 0 1.347.298 1.797.778.56-.112 1.087-.316 1.564-.599-.185.575-.576 1.059-1.083 1.363.498-.06.972-.192 1.413-.388-.33.494-.746.928-1.228 1.275"></path>
                                    </svg>
                                </a><a href="https://www.youtube.com/channel/UCq1LxxUw6DVELFN0wOmLLQw?disable_polymer=true" class="ssk ssk-youtube">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path fill="#CCC"
                                              d="M4.55 8.219V4.447l3.618 1.886L4.55 8.219zm7.333-4.583c-.103-.876-.313-1.13-.46-1.247-.238-.185-.668-.25-1.243-.29C9.255 2.038 7.69 2 5.997 2c-1.695 0-3.258.038-4.182.1-.575.04-1.006.105-1.243.29-.148.116-.357.37-.462 1.246-.148 1.26-.148 4.134 0 5.395.104.874.313 1.129.46 1.245.238.187.669.25 1.244.29.924.062 2.487.1 4.182.1 1.695 0 3.258-.038 4.183-.1.575-.04 1.005-.103 1.243-.29.148-.116.357-.371.46-1.245.148-1.261.148-4.135 0-5.395z"
                                              fill-rule="evenodd"></path>
                                    </svg>
                                </a><a href="https://www.linkedin.com/company/cryptonewscom/" class="ssk ssk-linkedin">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path d="M11.9939 12h-2.464V7.8c0-1.151-.438-1.794-1.349-1.794-.991 0-1.508.669-1.508 1.794V12h-2.375V4h2.375v1.078s.714-1.322 2.41-1.322c1.697 0 2.911 1.036 2.911 3.179V12zm-10.53-9.048c-.808 0-1.464-.66-1.464-1.476C-.0001.661.6559 0 1.4639 0c.809 0 1.465.661 1.465 1.476 0 .816-.656 1.476-1.465 1.476zM.2379 12h2.477V4H.2379v8z" fill="#CCC" fill-rule="evenodd"></path>
                                    </svg>
                                </a><a href="https://t.me/cryptonews_official" class="ssk ssk-telegram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path fill="#CCC" d="M.558 5.152L11.196 1.05c.495-.178.925.12.765.868l.001-.001-1.81 8.532c-.134.605-.495.752-.998.467L6.395 8.883l-1.33 1.282c-.147.147-.272.27-.556.27l.196-2.805 5.111-4.62c.223-.194-.05-.305-.343-.11L3.156 6.879l-2.723-.85c-.59-.188-.603-.591.126-.876" fill-rule="evenodd"></path>
                                    </svg>
                                </a><a href="/contact-us.htm" class="ssk ssk-email">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path fill="#CCC" d="M0 2.727v6.854c0 .373.273.675.649.675h10.696c.376 0 .649-.306.649-.675V2.727c0-.409-.244-.727-.65-.727H.65C.23 2 0 2.326 0 2.727m.988.597c0-.165.099-.26.259-.26.099 0 3.986 2.463 4.22 2.607l.609.38c.193-.13.387-.24.587-.375.408-.26 4.038-2.612 4.138-2.612.16 0 .26.095.26.26 0 .174-.337.348-.557.482-1.378.841-2.756 1.757-4.122 2.628-.08.054-.233.17-.35.151-.128-.019-4.083-2.56-4.802-2.983-.108-.064-.242-.123-.242-.278"
                                              fill-rule="evenodd"></path>
                                    </svg>
                                </a></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>
<footer class="footer">
    <div class="container">
        <div class="footer-top pt-60 pb-30">
            <div class="row">
                <div class="col-12 col-lg-5 col-xl-4 mb-lg-0 text-center text-md-left">
                    <div class="d-lg-flex mb-40">
                        <div class="footer-links d-md-inline-block text-center text-md-left align-self-center">
                            <a class="mr-20" href="/terms-and-conditions.htm">Terms &amp; Conditions</a>
                            <a class="mr-20" href="/about-us.htm">About Us</a>
                            <a class="mr-20" href="/contact/">Contact Us</a>
                            <a class="mr-20" href="/privacy-policy.htm">Privacy Policy</a>
                            <a class="mr-20" href="/disclaimer.htm">Disclaimer</a>
                        </div>
                    </div>
                    <div class="footer-tags d-none d-md-block">
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8 footer-links text-md-left">
                    <div class="row d-none d-md-flex" style="justify-content: flex-end">
                        <div class="col-12 col-lg-2">
                            <div class="header-menu__dropdown-heading">
                                <a class="mb-10 heading" href="/news/"><b>News</b></a><span>+</span>
                            </div>
                            <div class="menu-list-links header-menu__dropdown-children">
                                <a href="/news/bitcoin-news/">Bitcoin News</a><br/>
                                <a href="/news/ethereum-news/">Ethereum News</a><br/>
                                <a href="/news/nft-news/">NFT News</a><br/>
                                <a href="/news/defi-news/">DeFi News</a><br/>
                                <a href="/news/altcoin-news/">Altcoin News</a><br/>
                                <a href="/news/blockchain-news/">Blockchain News</a><br/>
                                <a href="/news/press-releases/">Press Releases</a><br/>
                                <a href="/news/sponsored/">Sponsored</a><br/>
                                <a href="/news/industry-talk/">Industry Talk</a><br/>
                                <a href="/news/ico-news/">ICO news</a><br/>
                                <a href="/news/finance-news/">Finance News</a><br/>
                                <a href="/news/technology-news/">Technology News</a><br/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="header-menu__dropdown-heading">
                                <a class="mb-10 heading" href="/exclusives/"><b>Exclusives</b></a><span>+</span>
                            </div>
                            <div class="menu-list-links header-menu__dropdown-children">
                                <a href="/exclusives/features/">Features</a><br/>
                                <a href="/exclusives/opinions/">Opinions</a><br/>
                                <a href="/exclusives/people/">People In Crypto</a><br/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="header-menu__dropdown-heading">
                                <a class="mb-10 heading" href="/guides/"><b>Guides</b></a><span>+</span>
                            </div>
                            <div class="menu-list-links header-menu__dropdown-children">
                                <a href="/guides/bitcoin/">Bitcoin</a><br/>
                                <a href="/guides/ethereum/">Ethereum</a><br/>
                                <a href="/guides/nft/">NFT</a><br/>
                                <a href="/guides/defi-guides/">Defi Guides</a><br/>
                                <a href="/guides/altcoins/">Altcoins</a><br/>
                                <a href="/guides/blockchain/">Blockchain</a><br/>
                                <a href="/guides/cryptocurrency/">Cryptocurrency</a><br/>
                                <a href="/guides/icos/">ICOs / STOs / IEOs</a><br/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="header-menu__dropdown-heading">
                                <a class="mb-10 heading" href="#"><b>Recommended</b></a><span>+</span>
                            </div>
                            <div class="menu-list-links header-menu__dropdown-children">
                                <a href="/news/best-crypto-to-buy.htm"> Best crypto to buy now </a>
                                <a href="/news/best-crypto-presales.htm"> Best crypto presales to invest in </a>
                                <a href="/news/new-cryptocurrency.htm"> New cryptocurrency </a>
                                <a href="/news/next-cryptocurrency-to-explode.htm"> Next cryptocurrency to explode </a>
                                <a href="/news/best-crypto-icos.htm"> Best crypto icos </a>
                                <a href="/news/crypto-launches.htm"> Crypto launches </a>
                                <a href="/news/best-bitcoin-betting-sites.htm"> Crypto betting </a>
                                <a href="/news/best-bitcoin-casinos.htm"> Bitcoin casinos </a>
                                <a href="/news/best-bitcoin-gambling-sites.htm"> Bitcoin gambling sites </a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="">
                                <div class="header-menu__dropdown-heading"><a class="heading" href="/editors/">Contributors</a></div>
                                <div class="header-menu__dropdown-heading"><a class="heading" href="/reviews/exchanges/">Exchanges</a></div>
                                <div class="header-menu__dropdown-heading"><a class="heading" href="/coins/">Market Cap</a></div>
                                <div class="header-menu__dropdown-heading"><a class="heading" href="/news/press-releases/">Press Releases</a></div>
                                <div class="header-menu__dropdown-heading"><a class="heading" href="/news/industry-talk/">Industry Talk</a></div>
                                <div class="header-menu__dropdown-heading"><a class="heading" href="/exclusives/opinions/">Opinions</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-block d-md-none footer_menu_mob">
                        <div class="header-menu__dropdown-heading">
                            <a class="mb-10 heading" href="/news/"><b>News</b></a>
                        </div>
                        <div class="menu-list-links header-menu__dropdown-children">
                            <a href="/news/bitcoin-news/">Bitcoin News</a><br/><a href="/news/ethereum-news/">Ethereum News</a><br/><a href="/news/nft-news/">NFT News</a><br/><a href="/news/defi-news/">DeFi News</a><br/><a href="/news/altcoin-news/">Altcoin News</a><br/><a href="/news/blockchain-news/">Blockchain News</a><br/><a href="/news/press-releases/">Press Releases</a><br/><a href="/news/sponsored/">Sponsored</a><br/><a href="/news/industry-talk/">Industry Talk</a><br/><a
                                    href="/news/ico-news/">ICO news</a><br/><a href="/news/finance-news/">Finance News</a><br/><a href="/news/technology-news/">Technology News</a><br/></div>
                        <div class="header-menu__dropdown-heading">
                            <a class="mb-10 heading" href="/exclusives/"><b>Exclusives</b></a>
                        </div>
                        <div class="menu-list-links header-menu__dropdown-children">
                            <a href="/exclusives/features/">Features</a><br/><a href="/exclusives/opinions/">Opinions</a><br/><a href="/exclusives/people/">People In Crypto</a><br/></div>
                        <div class="header-menu__dropdown-heading">
                            <a class="mb-10 heading" href="/guides/"><b>Guides</b></a>
                        </div>
                        <div class="menu-list-links header-menu__dropdown-children">
                            <a href="/guides/bitcoin/">Bitcoin</a><br/><a href="/guides/ethereum/">Ethereum</a><br/><a href="/guides/nft/">NFT</a><br/><a href="/guides/defi-guides/">Defi Guides</a><br/><a href="/guides/altcoins/">Altcoins</a><br/><a href="/guides/blockchain/">Blockchain</a><br/><a href="/guides/cryptocurrency/">Cryptocurrency</a><br/><br/><a href="/guides/icos/">ICOs / STOs / IEOs</a><br/><br/>
                        </div>
                        <div class="header-menu__dropdown-heading">
                            <a class="mb-10 heading" href="#"><b>Recommended</b></a>
                        </div>
                        <div class="menu-list-links header-menu__dropdown-children">
                            [{"url":"https:\/\/kumkanot.com\/news\/best-crypto-to-buy.htm","name":"Best crypto to buy now","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/best-crypto-presales.htm","name":"Best crypto presales to invest in","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/new-cryptocurrency.htm","name":"New cryptocurrency","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/next-cryptocurrency-to-explode.htm","name":"Next cryptocurrency to
                            explode","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/best-crypto-icos.htm","name":"Best crypto icos","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/crypto-launches.htm","name":"Crypto launches","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/best-bitcoin-betting-sites.htm","name":"Crypto betting","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/best-bitcoin-casinos.htm","name":"Bitcoin
                            casinos","children":[]}]<br/>[{"url":"https:\/\/kumkanot.com\/news\/best-bitcoin-gambling-sites.htm","name":"Bitcoin gambling sites","children":[]}]<br/></div>
                        <div class="menu-list-links header-menu__dropdown-children">
                            <a class="mb-10 heading" href="/editors/">
                                <b>Contributors</b>
                            </a>
                            <a class="mb-10 heading" href="/reviews/exchanges/">
                                <b>Exchanges</b>
                            </a>
                            <a class="mb-10 heading" href="/coins/">
                                <b>Market Cap</b>
                            </a>
                            <a class="mb-10 heading" href="/news/press-releases/"><b>Press Releases</b></a>
                            <a class="mb-10 heading" href="/news/industry-talk/"><b>Industry Talk</b></a>
                            <a class="mb-10 heading" href="/exclusives/opinions/"><b>Opinions</b></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 mb-lg-0 text-center d-md-none d-block mt-20">
                    <div class="footer-tags">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom pt-30 pb-30">
            <div class="row">
                <div class="col-12 col-md-6 text-center text-md-left mb-20 mb-md-0">
                    <div class="fs-12 c-light-grey">© 2023 kumkanot. All rights reserved</div>
                </div>
                <div class="col-12 col-md-6 text-center text-md-right">
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal" id="newsletter-modal">
    <div class="modal__content text-white">
        <div class="close__icon hide-modal" data-id="newsletter-modal">X</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.2/dist/cookieconsent.js"></script>
<script defer src="/assets/js/cookieconsent-init.js"></script>
</body>
</html>
