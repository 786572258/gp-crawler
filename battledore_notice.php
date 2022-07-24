<?php
require_once  "comm.php";
require_once  "service.php";
require_once  "crawler.php";

/**
 * 打板通知
 *
分时涨速大于2且涨幅大于5；开盘涨跌幅>=-1.5<8；一个交易日前涨停且股价20元以内且流通市值15-110亿且筹码获利比例大于60%；非一字板
 * */
function main() {
    //获取同花顺符合二板模式的个股
//    $thsResponse = Crawler::getSecondBoardGp();
//    Service::notice($thsResponse);
    $res = file_get_contents("http://maimai.byethost22.com/gp-crawler/battledore_notice.php");
    $curl = curl_init();
    $query = "";

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://maimai.byethost22.com/gp-crawler/battledore_notice.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => $query,
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json, text/plain, */*',
            'Accept-Language: zh-CN,zh;q=0.9',
            'Cache-control: no-cache',
            'Connection: keep-alive',
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: cid=78507239c6883680d9d2953835a75ec31637978778; v=A9AHGWE7hpNgRVqXlqtruHY3pxUnmbES1loKWcqQnaT_DH4LcqmEcyaN2E4Z',
            'Origin: http://www.iwencai.com',
            'Pragma: no-cache',
            'Referer: http://www.iwencai.com/',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo  $response;



    file_put_contents("run2.txt", $response. date("yy-mm-dd H:i:s") ."\n", FILE_APPEND);
    echo "done";
}

main();
