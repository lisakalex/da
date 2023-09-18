<?php
function get_link()
{
    $link = mysqli_connect("localhost", "al", "Zaichik1.&", "hyip");
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $link;
}

$ip = $_SERVER ['REMOTE_ADDR'];
$url = $_SERVER ['REQUEST_URI'];
if (isset($_SERVER['HTTP_REFERER'])) $url_ref = $_SERVER['HTTP_REFERER'];


function after($thiss, $inthat)
{
    if (!is_bool(strpos($inthat, $thiss))) {
        return substr($inthat, strpos($inthat, $thiss) + strlen($thiss));
    }
}

function between($thiss, $that, $inthat)
{
    return before($that, after($thiss, $inthat));
}

function before($thiss, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $thiss));
}

function found($haystack, $needle)
{
    return (strpos($haystack, $needle) !== false);
}

function cutString($str, $amount = 1, $dir = "right")
{
    if (($n = strlen($str)) > 0) {
        if ($dir == "right") {
            $start = 0;
            $end = $n - $amount;
        } else if ($dir == "left") {
            $start = $amount;
            $end = $n;
        }

        return substr($str, $start, $end);
    } else {
        return false;
    }
}


function get_url($url)
{
    $part1 = before("//", $url);
    $part2 = after("//", $url);
    if (found($part2, "/")) {
        return $part1 . "//" . before("/", $part2);
    } else {
        return $part1 . "//" . $part2;
    }
}

function get_hyip_name($url)
{
    if ($url != null && $url != "") {
        if (found($url, "www.")) {
            $hyip = between("www.", ".", $url);
        } else {
            $hyip = between("//", ".", $url);
        }
//    if (!filter_var($url, FILTER_VALIDATE_URL)) {
//        return 0;
//    } else {
//        $hyip_url3 = after("//", $url);
//        $hurl_1 = before("/", $hyip_url3);
//        $pos = strpos($hurl_1, "www.");
//        if ($pos !== false) {
//            $hurl_1 = after("www.", $hurl_1);
//        }
//    }
        return $hyip;
    }
}

function call_curl($url)
{
    $data = array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $contents = curl_exec($ch);

    $data['contents'] = $contents;

    $curlinfo_effective_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $curlinfo_total_time = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
    $curlinfo_total_time = round($curlinfo_total_time, 3);
    $curlinfo_response_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    $curlinfo_filetime = curl_getinfo($ch, CURLINFO_FILETIME);
    $curlinfo_namelookup_time = curl_getinfo($ch, CURLINFO_NAMELOOKUP_TIME);
    $curlinfo_connect_time = curl_getinfo($ch, CURLINFO_CONNECT_TIME);
    $curlinfo_redirect_count = curl_getinfo($ch, CURLINFO_REDIRECT_COUNT);
    $curlinfo_size_download = curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
    $curlinfo_speed_download = curl_getinfo($ch, CURLINFO_SPEED_DOWNLOAD);
    $data['eff_url'] = $curlinfo_effective_url;

    curl_close($ch);

//    $htime = gmdate("d-m-Y   H:i:s");
//    $sql = "INSERT INTO curl_data (curlinfo_effective_url, curlinfo_total_time, curlinfo_response_code, curlinfo_namelookup_time, curlinfo_connect_time, curlinfo_redirect_count, curlinfo_size_download, curlinfo_speed_download, htime) VALUES(?,?,?,?,?,?,?,?,?)";
//    $stmt = mysqli_stmt_init($link);
//    if (mysqli_stmt_prepare($stmt, $sql)) {
//        mysqli_stmt_bind_param($stmt, "sssssssss", $curlinfo_effective_url, $curlinfo_total_time, $curlinfo_response_code, $curlinfo_namelookup_time, $curlinfo_connect_time, $curlinfo_redirect_count, $curlinfo_size_download, $curlinfo_speed_download, $htime);
//        mysqli_stmt_execute($stmt);
//    }

//    $htime = gmdate("d-m-Y   H:i:s");
//    $link = get_link();
//    $sql = "INSERT INTO curl_data ( curlinfo_effective_url, curlinfo_total_time, curlinfo_response_code) VALUES(?,?,?)";
//    $stmt = mysqli_stmt_init($link);
//    if (mysqli_stmt_prepare($stmt, $sql)) {
//        mysqli_stmt_bind_param($stmt, "sss", $curlinfo_effective_url, $curlinfo_total_time, $curlinfo_response_code);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_close($stmt);
//    }
    return $data;
}

function run_yourself($table)
{
    $hit = 0;
    $link = get_link();
    $sql = "SELECT COUNT(hit) FROM " . $table . " WHERE hit=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $hit);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hit);
        mysqli_stmt_fetch($stmt);
        mysqli_close($link);
    }

    if ($hit) {
        $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        call_curl($url);
    } else {
//        if ($table == "seed") {
//            $link = get_link();
//            $sql = "INSERT INTO monitor1 SELECT * FROM monitor GROUP BY monitor";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//            run_someone("/hyip/hyip.php");
//        }

//        if ($table == "monitor1") {
//            $link = get_link();
//            $sql = "INSERT INTO hyip1 SELECT * FROM hyip GROUP BY hyip";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//            run_someone("/hyip/rate.php");
//        }
//
//        if ($table == "hyip1") {
//            $link = get_link();
//            $sql = "INSERT INTO performance1 SELECT * FROM performance GROUP BY url";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//
//            $link = get_link();
//            $sql = "INSERT INTO graph SELECT * FROM performance1";
//            mysqli_query($link, $sql);
//            mysqli_close($link);
//        }
    }
}

function run_someone($url) //   /hyip/t.php
{
    $url = $_SERVER['HTTP_HOST'] . $url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_exec($ch);
    curl_close($ch);
}

// print array
function printa($sweet)
{
    foreach ($sweet as $key => $value) {
        echo $key . "\t" . $value . "<br>";
    }
}

function filter($data)
{
    $link = get_link();
    $data = trim(htmlentities(strip_tags($data)));
    $data = stripslashes($data);
    $data = mysqli_real_escape_string($link, $data);
    $data = htmlspecialchars($data);
    return $data;
}

function page_protect()
{
    session_start();

//    if (isset ($_COOKIE ['cus_id']) && isset ($_COOKIE ['user_name']) && isset ($_COOKIE ['full_name'])) {
//        $_SESSION ['cus_id'] = $_COOKIE ['cus_id'];
//        $_SESSION ['user_name'] = $_COOKIE ['user_name'];
//        $_SESSION ['full_name'] = $_COOKIE ['full_name'];
////        $_SESSION ['upline'] = $_COOKIE ['upline'];
//    }

    if (!isset ($_SESSION ['loggedin'])) {
        header("Location: /login/");
    }
}


function satoshi_to_btc($value)
{
    return bcdiv(intval($value), 100000000, 8);
}

/**
 * count how man new addresses left
 */
function new_addresses()
{
    $payment = "new";
    $newaddr = "";
    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT count(*) AS total FROM trans WHERE payment=?')) {
        mysqli_stmt_bind_param($stmt, "s", $payment);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $newaddr);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    return $newaddr;
}

//
//count all satoshis
//$link = get_link();
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT sum(usd_paid) FROM trans')) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $all);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}
//
//$all_usd = number_format($all, 0);


function get_rate()
{
    $url = "https://bitpay.com/api/rates/BTC/USD";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $contents = curl_exec($ch);
    $arr_json = json_decode($contents, true);
    return $arr_json['rate'];
}

//not used
function confirmed($address)
{
//    https://blockstream.info/api/address/" . $address . "/utxo
    $url = "https://blockstream.info/testnet/api/address/" . $address . "/utxo";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $contents = curl_exec($ch);
    $arr_json = json_decode($contents, true);
    return $arr_json[0]['status']['confirmed'];
}

function get_transaction_status($address)
{
//    https://github.com/Blockstream/esplora/blob/master/API.md
    $url = "https://blockstream.info/api/address/" . $address;
//    $url = "https://blockstream.info/testnet/api/address/" . $address;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $contents = curl_exec($ch);
    $arr_json = json_decode($contents, true);
    return satoshi_to_btc($arr_json['chain_stats']['funded_txo_sum']);
}

function test_cron($page, $link)
{
    $link = get_link();
    $stmt = mysqli_stmt_init($link);
    $sql = "INSERT INTO customer (full_name, account_date)
	VALUES(?, now())";
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $page);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

function unique_multidim_array($array, $key)
{
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
{
    $from_user = "=?UTF-8?B?" . base64_encode($from_user) . "?=";
    $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";

    $headers = "From: $from_user <$from_email>\r\n" .
        "MIME-Version: 1.0" . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\r\n";

    return mail($to, $subject, $message, $headers);
}


//$all_usd = $all * get_rate();
//$all_usd = number_format($all_usd, 0);

function reCaptcha($recaptcha)
{
    $secret = "6LcEwn0UAAAAAP2Bm4qGvjhpDgzeDrkZCMR68Y2W";
    $ip = $_SERVER['REMOTE_ADDR'];

    $postvars = array("secret" => $secret, "response" => $recaptcha, "remoteip" => $ip);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $data = curl_exec($ch);
    curl_close($ch);

    return json_decode($data, true);
}

function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_now()
{
    $now = new DateTime('NOW');
    $now = $now->format('Y-m-d');
    try {
        $now = new DateTime($now);
    } catch (Exception $e) {
    }
    return $now;
}

/**
 * A sweet interval formatting, will use the two biggest interval parts.
 * On small intervals, you get minutes and seconds.
 * On big intervals, you get months and days.
 * Only the two biggest parts are used.
 *
 * @param DateTime $start
 * @param DateTime|null $end
 * @return string
 * @throws Exception
 */
function formatDateDiff($start, $end = null)
{
    if (!($start instanceof DateTime)) {
        $start = new DateTime($start);
    }

    if ($end === null) {
        $end = new DateTime();
    }

    if (!($end instanceof DateTime)) {
        $end = new DateTime($start);
    }

    $interval = $end->diff($start);
    $doPlural = function ($nb, $str) {
        return $nb > 1 ? $str . 's' : $str;
    }; // adds plurals

    $format = array();
    if ($interval->y !== 0) {
        $format[] = "%y " . $doPlural($interval->y, "year");
    }
    if ($interval->m !== 0) {
        $format[] = "%m " . $doPlural($interval->m, "month");
    }
    if ($interval->d !== 0) {
        $format[] = "%d " . $doPlural($interval->d, "day");
    }
    if ($interval->h !== 0) {
        $format[] = "%h " . $doPlural($interval->h, "hour");
    }
    if ($interval->i !== 0) {
        $format[] = "%i " . $doPlural($interval->i, "minute");
    }
    if ($interval->s !== 0) {
        if (!count($format)) {
            return "less than a minute ago";
        } else {
            $format[] = "%s " . $doPlural($interval->s, "second");
        }
    }

    // We use the two biggest parts
    if (count($format) > 1) {
        $format = array_shift($format) . " and " . array_shift($format);
    } else {
        $format = array_pop($format);
    }

    // Prepend 'since ' or whatever you like
    return $interval->format($format);
}

//if ($url !== null) {
//    $link = get_link();
//    $sql = "INSERT INTO url_data (url, url_ref, ip) VALUES(?,?,?)";
//    $stmt = mysqli_stmt_init($link);
//    if (mysqli_stmt_prepare($stmt, $sql)) {
//        mysqli_stmt_bind_param($stmt, "sss", $url, $url_ref, $ip);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_close($stmt);
//    }
//}

//count all satoshis
//$stmt = mysqli_stmt_init($link);
//if (mysqli_stmt_prepare($stmt, 'SELECT sum(usd_paid) FROM trans')) {
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $all_usd);
//    mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}

function clean_url($url)
{
    if (found($url, "www.")) {
        $url = between("www.", ".", $url);
    } else {
        $url = between("//", ".", $url);
    }
    return $url;
}

//$all_usd = $all * get_rate();
//$all_usd = number_format($all, 0);
//kk
//$all_usd = 1;

function get_percentage($total, $number)
{
    if ($total > 0) {
        return round(($number * 100) / $total, 2);
    } else {
        return 0;
    }
}

function change_percentage($today_perf, $yesterday_perf)
{
    if ($yesterday_perf > 0) { // wasn't there yesterday, today is the first day, so it is 100% compare to yesterday
        $change = $today_perf - $yesterday_perf;
        return ($change * 100) / $yesterday_perf;
    } else {
        return 100;
    }
}

$banner_price["Top"] = 100;
$banner_price["Left side 1"] = 50;
$banner_price["Left side 2"] = 50;
$banner_price["Left side 3"] = 50;
$banner_price["Left side 4"] = 50;
$banner_price["Left side 5"] = 50;
$banner_price["Right side 1"] = 50;
$banner_price["Right side 2"] = 50;
$banner_price["Right side 3"] = 50;
$banner_price["Right side 4"] = 50;
$banner_price["Right side 5"] = 50;
$banner_price["Bottom"] = 75;

$banner_size["Top"] = "728x90";
$banner_size["Left side 1"] = "125x125";
$banner_size["Left side 2"] = "125x125";
$banner_size["Left side 3"] = "125x125";
$banner_size["Left side 4"] = "125x125";
$banner_size["Left side 5"] = "125x125";
$banner_size["Right side 1"] = "125x125";
$banner_size["Right side 2"] = "125x125";
$banner_size["Right side 3"] = "125x125";
$banner_size["Right side 4"] = "125x125";
$banner_size["Right side 5"] = "125x125";
$banner_size["Bottom"] = "468x60";

function all_banners()
{
    $all_banners['Top'] = array("/assets/images/728.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Left side 1'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Left side 2'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Left side 3'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Left side 4'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Left side 5'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Right side 1'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Right side 2'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Right side 3'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Right side 4'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Right side 5'] = array("/assets/images/125.png", "https://www.allhyipmonitors.com/\" target=\"_blank");
    $all_banners['Bottom'] = array("/assets/images/468.png", "https://www.allhyipmonitors.com/\" target=\"_blank");

    $link = get_link();
    $now = get_now();
    $banners = array();
    $payment = "complete";

    $sql = "SELECT banner_url, banner.banner_id, site, slot, days, banner.start_date FROM banner INNER JOIN trans ON banner.id = trans.banner_id WHERE payment=?";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $payment);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $banner_url, $banner_id, $site, $slot, $days, $start_date);

        while (mysqli_stmt_fetch($stmt)) {
            try {
                $firstday = new DateTime($start_date);
                $lastday = new DateTime($start_date);
                $lastday->modify('+' . $days - 1 . 'days');
            } catch (Exception $e) {
            }

            if (($now >= $firstday) && ($now <= $lastday)) {
                $banners[] = array('banner_url' => $banner_url, 'banner_id' => $banner_id, 'site' => $site, 'slot' => $slot, 'days' => $days, 'start_date' => $start_date);
            }
        }
    }

    mysqli_close($link);

    $banners1 = array();
    foreach ($banners as $banner) {
        for ($i = 0; $i < $banner['slot']; $i++) {
            $banners1[$banner['banner_id']][] = array($banner['banner_url'], $banner['site']);
        }
    }

//    $all_banners = [];
    foreach ($banners1 as $k => $v) {
        $b = count($v);
        $b--;
        $b = rand(0, $b);
        $all_banners[$k] = $v[$b];
    }
    return $all_banners;
}

//const SECRET_KEY = '0x4AAAAAAAIsOm0GWgza-zWsAZq2yQtuXuc';
const SECRET_KEY = '1x0000000000000000000000000000000AA';

//const SITE_KEY = '0x4AAAAAAAIsOpi3Q-FDPBEo';
const SITE_KEY = '1x00000000000000000000AA';


function turnstile($response)
{
    $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
    $curl = curl_init();
    $curl_setopt = curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
        ],
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POSTFIELDS => json_encode([
            'secret' => SECRET_KEY,
            'response' => $response
        ]),
    ]);

    $result = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($json = json_decode($result)) {
        if ($json->success) {
            return true;
        } else {
            return false;
        }
    }
}
