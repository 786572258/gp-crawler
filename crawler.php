<?php
require_once  "comm.php";

class Crawler
{
    public static $cookie = null;
    static function setCookie($cookie) {
        self::$cookie = $cookie;
    }
    //获取涨停股票
    static function getHarden($frontDay) {
//        $frontDay = 4;
        $date = date('Ymd',strtotime("-{$frontDay} day"));
        echo "日期:" . $date;
        $query = str_replace("20220629", $date, 'query=2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C%E4%B8%94%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E4%B8%94%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%EF%BC%9B%E6%89%80%E5%B1%9E%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%3B&urp_sort_way=desc&urp_sort_index=%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%5B20220629%5D&page=1&perpage=100&condition=%5B%7B%22chunkedResult%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C_%26_%E4%B8%94_%26_%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95_%26_%E4%B8%94_%26_%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%3B_%26_%E6%89%80%E5%B1%9E%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%3B%22%2C%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A6%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220629%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220629%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%98%AF%E5%90%A6%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%B6%A8%E5%81%9C%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A4%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%87%8F%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220629%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220629%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%E8%82%A1)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%87%8F%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%87%8F%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%87%8F%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A2%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220629%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220629%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%222%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%7D%2C%7B%22indexName%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22indexProperties%22%3A%5B%5D%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%7D%2C%22reportType%22%3A%22null%22%2C%22valueType%22%3A%22_%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%7D%5D&codelist=&indexnamelimit=&logid=383015d5a994cacdb95293043a11b499&ret=json_all&sessionid=22c243e0d6f7299a1585c4dcc63f1621&date_range%5B0%5D=20220629&date_range%5B1%5D=20220629&iwc_token=&urp_use_sort=1&user_id=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe&uuids%5B0%5D=24087&query_type=stock&comp_id=6257151&business_cat=soniu&uuid=24087');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ai.iwencai.com/urp/v7/landing/getDataList',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $query,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
                'Accept-Language: zh-CN,zh;q=0.9',
                'Cache-control: no-cache',
                'Connection: keep-alive',
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: cid=78507239c6883680d9d2953835a75ec31637978778; v=A84ZA3MNIKHGE5TcZQpNYmQJGa-VT7JjpMxBL_jcO2ONTmARYN_iWXSjlsvL',
                'Origin: http://www.iwencai.com',
                'Pragma: no-cache',
                'Referer: http://www.iwencai.com/',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);
        return $response;
    }

    /**
     *
     * x个交易日前涨停且涨停封单；所属一级行业
     * 临时的请求，会失效
     * http://www.iwencai.com/unifiedwap/result?w=2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C%E4%B8%94%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%EF%BC%9B%E6%89%80%E5%B1%9E%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A&querytype=stock&addSign=1656219000078
     * @param $frontDay 几个交易日前
     * @return bool|string
     */
    public static function getHardenWithCookie($frontDay = 0) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://www.iwencai.com/customized/chart/get-robot-data',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // todo perpage改 question改

            CURLOPT_POSTFIELDS =>'{
    "question": "'.$frontDay.'个交易日前涨停且涨停封单；所属一级行业",
    "perpage": "200",
    "page": 1,
    "secondary_intent": "stock",
    "log_info": "{\\"input_type\\":\\"typewrite\\"}",
    "source": "Ths_iwencai_Xuangu",
    "version": "2.0",
    "query_area": "",
    "block_list": "",
    "add_info": "{\\"urp\\":{\\"scene\\":1,\\"company\\":1,\\"business\\":1},\\"contentType\\":\\"json\\",\\"searchInfo\\":true}"
}',            CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
                'Accept-Language: zh-CN,zh;q=0.9',
                'Cache-control: no-cache',
//                'Connection: keep-alive',
                'Content-Type: application/json',
                'Cookie: ' . self::$cookie,
                'Origin: http://www.iwencai.com',
                'Pragma: no-cache',
                'Referer: http://www.iwencai.com/unifiedwap/result?w=2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C%E4%B8%94%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%EF%BC%9B%E6%89%80%E5%B1%9E%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A&querytype=stock&addSign=1656219000078',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  $response;
    }

    /**
     *
     * x个交易日前涨停且涨停封单；所属一级行业
     * 临时的请求，会失效
     * http://www.iwencai.com/unifiedwap/result?w=2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C%E4%B8%94%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%EF%BC%9B%E6%89%80%E5%B1%9E%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A&querytype=stock&addSign=1656219000078
     * @param $frontDay 几个交易日前
     * @return bool|string
     */
    public static function getHardenContinuousWithCookie($frontDay = 0) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://www.iwencai.com/customized/chart/get-robot-data',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // todo perpage改 question改

            CURLOPT_POSTFIELDS =>'{"question":"'.$frontDay.'个交易日前连板最多；封单金额；换手率；非st","perpage":"100","page":1,"secondary_intent":"stock","log_info":"{\"input_type\":\"typewrite\"}","source":"Ths_iwencai_Xuangu","version":"2.0","query_area":"","block_list":"","add_info":"{\"urp\":{\"scene\":1,\"company\":1,\"business\":1},\"contentType\":\"json\",\"searchInfo\":true}"}',
                CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
                'Accept-Language: zh-CN,zh;q=0.9',
                'Cache-control: no-cache',
//                'Connection: keep-alive',
                'Content-Type: application/json',
                'Cookie: ' . self::$cookie,
                'Origin: http://www.iwencai.com',
                'Pragma: no-cache',
                'Referer: http://www.iwencai.com/unifiedwap/result?w=2%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C%E4%B8%94%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%EF%BC%9B%E6%89%80%E5%B1%9E%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A&querytype=stock&addSign=1656219000078',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  $response;


    }

    //获取涨停连板
    public static function getHardenContinuous_bak($frontDay) {
        $curl = curl_init();
        $date = date('Ymd',strtotime("-{$frontDay} day"));
        echo "日期:" . $date;
        $query = str_replace("20220624", $date, 'query=0%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E8%BF%9E%E6%9D%BF%E6%9C%80%E5%A4%9A%EF%BC%9B%E5%B0%81%E5%8D%95%E9%87%91%E9%A2%9D%EF%BC%9B%E6%8D%A2%E6%89%8B%E7%8E%87%3B%E9%9D%9Est%3B&urp_sort_way=desc&urp_sort_index=%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%5B20220624%5D&page=1&perpage=100&condition=%5B%7B%22chunkedResult%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E8%BF%9E%E6%9D%BF%E6%9C%80%E5%A4%9A%3B_%26_%E5%B0%81%E5%8D%95%E9%87%91%E9%A2%9D%3B_%26_%E6%8D%A2%E6%89%8B%E7%8E%87%3B_%26_%E9%9D%9Est%3B%22%2C%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A6%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220624%22%2C%22(%3D2%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220624%22%2C%22(%3D%22%3A%222%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%95%B4%E5%9E%8B%E6%95%B0%E5%80%BC(%E5%A4%A9)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D2%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D2%22%2C%22relatedSize%22%3A0%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A4%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220624%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220624%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%E5%85%83)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22relatedSize%22%3A0%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A2%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220624%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220624%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%25)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%220%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22relatedSize%22%3A0%7D%2C%7B%22reportType%22%3A%22null%22%2C%22indexName%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%2C%22indexProperties%22%3A%5B%22%E4%B8%8D%E5%8C%85%E5%90%ABst%22%5D%2C%22valueType%22%3A%22_%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%E4%B8%8D%E5%8C%85%E5%90%ABst%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%E4%B8%8D%E5%8C%85%E5%90%ABst%22%2C%22relatedSize%22%3A0%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%B8%8D%E5%8C%85%E5%90%AB%22%3A%22st%22%7D%7D%5D&codelist=&indexnamelimit=&logid=64da85c75c024dee783d38f6bbf47992&ret=json_all&sessionid=22c243e0d6f7299a1585c4dcc63f1621&date_range%5B0%5D=20220624&date_range%5B1%5D=20220624&iwc_token=&urp_use_sort=1&user_id=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe&uuids%5B0%5D=24087&query_type=stock&comp_id=6257151&business_cat=soniu&uuid=24087');
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ai.iwencai.com/urp/v7/landing/getDataList',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $query,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
                'Accept-Language: zh-CN,zh;q=0.9',
                'Cache-control: no-cache',
                'Connection: keep-alive',
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: cid=78507239c6883680d9d2953835a75ec31637978778; v=A9QDFUWvSivBst5zXUA3bEqLoxlDLdt-OvqH9G_lYl7i6noHlj3Ip4phXfO9',
                'Origin: http://www.iwencai.com',
                'Pragma: no-cache',
                'Referer: http://www.iwencai.com/',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return  $response;
    }
    /*
     * 获取涨停连板
        10个交易日前的连续涨停天数>=1且几天几板；封单金额；换手率；非st;
    */
    public static function getHardenContinuous($frontDay) {

        $curl = curl_init();
        $date = date('Ymd',strtotime("-{$frontDay} day"));
        echo "日期:" . $date;
        $query = str_replace("20220617", $date, 'query=10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1%E4%B8%94%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%EF%BC%9B%E5%B0%81%E5%8D%95%E9%87%91%E9%A2%9D%EF%BC%9B%E6%8D%A2%E6%89%8B%E7%8E%87%EF%BC%9B%E9%9D%9Est%3B&urp_sort_way=desc&urp_sort_index=%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%5B20220617%5D&page=1&perpage=200&condition=%5B%7B%22chunkedResult%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1_%26_%E4%B8%94_%26_%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%3B_%26_%E5%B0%81%E5%8D%95%E9%87%91%E9%A2%9D%3B_%26_%E6%8D%A2%E6%89%8B%E7%8E%87%3B_%26_%E9%9D%9Est%3B%22%2C%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A8%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220617%22%2C%22(%3D1%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220617%22%2C%22(%3D%22%3A%221%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%95%B4%E5%9E%8B%E6%95%B0%E5%80%BC(%E5%A4%A9)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1%E6%97%A5%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1%E6%97%A5%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A6%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220617%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220617%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A4%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220617%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220617%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%E5%85%83)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A2%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220617%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220617%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%25)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%8D%A2%E6%89%8B%E7%8E%87%22%7D%2C%7B%22indexName%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%2C%22indexProperties%22%3A%5B%22%E4%B8%8D%E5%8C%85%E5%90%ABst%22%5D%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%B8%8D%E5%8C%85%E5%90%AB%22%3A%22st%22%7D%2C%22reportType%22%3A%22null%22%2C%22valueType%22%3A%22_%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%E4%B8%8D%E5%8C%85%E5%90%ABst%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%E4%B8%8D%E5%8C%85%E5%90%ABst%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%7D%5D&codelist=&indexnamelimit=&logid=c4e8ebcc3db16a2c45e36c8eca02e86d&ret=json_all&sessionid=22c243e0d6f7299a1585c4dcc63f1621&date_range%5B0%5D=20220617&date_range%5B1%5D=20220617&iwc_token=&urp_use_sort=1&user_id=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe&uuids%5B0%5D=24087&query_type=stock&comp_id=6257151&business_cat=soniu&uuid=24087');

    $query = str_replace("20220708", $date, 'query=10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1%E4%B8%94%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%E4%B8%94%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%EF%BC%9B%E5%B0%81%E5%8D%95%E9%87%91%E9%A2%9D%EF%BC%9B%E6%8D%A2%E6%89%8B%E7%8E%87%EF%BC%9B%E9%9D%9Est%EF%BC%9B%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%3B&urp_sort_way=desc&urp_sort_index=%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0&page=1&perpage=100&condition=%5B%7B%22chunkedResult%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1_%26_%E4%B8%94_%26_%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF_%26_%E4%B8%94_%26_%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%3B_%26_%E5%B0%81%E5%8D%95%E9%87%91%E9%A2%9D%3B_%26_%E6%8D%A2%E6%89%8B%E7%8E%87%3B_%26_%E9%9D%9Est%3B_%26_%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%3B%22%2C%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A12%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220708%22%2C%22%28%3D1%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220708%22%2C%22%28%3D%22%3A%221%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%95%B4%E5%9E%8B%E6%95%B0%E5%80%BC%28%E5%A4%A9%29%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1%E6%97%A5%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%3E%3D1%E6%97%A5%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E8%BF%9E%E7%BB%AD%E6%B6%A8%E5%81%9C%E5%A4%A9%E6%95%B0%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A10%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220708%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220708%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E5%87%A0%E5%A4%A9%E5%87%A0%E6%9D%BF%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A8%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220708%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220708%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%B6%A8%E5%81%9C%E5%8E%9F%E5%9B%A0%E7%B1%BB%E5%88%AB%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A6%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220708%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220708%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC%28%E5%85%83%29%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%B6%A8%E5%81%9C%E5%B0%81%E5%8D%95%E9%A2%9D%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A4%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220708%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220708%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC%28%25%29%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%2210%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%8D%A2%E6%89%8B%E7%8E%87%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B10%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%8D%A2%E6%89%8B%E7%8E%87%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A2%2C%22relatedSize%22%3A0%7D%2C%7B%22indexName%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%2C%22indexProperties%22%3A%5B%22%E4%B8%8D%E5%8C%85%E5%90%ABst%22%5D%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%B8%8D%E5%8C%85%E5%90%AB%22%3A%22st%22%7D%2C%22reportType%22%3A%22null%22%2C%22valueType%22%3A%22_%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%E4%B8%8D%E5%8C%85%E5%90%ABst%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%E4%B8%8D%E5%8C%85%E5%90%ABst%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%E8%82%A1%E7%A5%A8%E7%AE%80%E7%A7%B0%22%7D%2C%7B%22indexName%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22indexProperties%22%3A%5B%5D%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%7D%2C%22reportType%22%3A%22null%22%2C%22valueType%22%3A%22_%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%E6%89%80%E5%B1%9E%E5%90%8C%E8%8A%B1%E9%A1%BA%E4%B8%80%E7%BA%A7%E8%A1%8C%E4%B8%9A%22%7D%5D&codelist=&indexnamelimit=&logid=3f109cddd020793d449f3f93359d8cc5&ret=json_all&sessionid=22c243e0d6f7299a1585c4dcc63f1621&date_range%5B0%5D=20220708&date_range%5B1%5D=20220708&iwc_token=&urp_use_sort=1&user_id=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe&uuids%5B0%5D=24087&query_type=stock&comp_id=6257151&business_cat=soniu&uuid=24087');

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ai.iwencai.com/urp/v7/landing/getDataList',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
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
        return $response;

    }


    //获取同花顺符合二板模式的个股
    static function getSecondBoardGp() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ai.iwencai.com/urp/v7/landing/getDataList',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'query=%E5%88%86%E6%97%B6%E6%B6%A8%E9%80%9F%E5%A4%A7%E4%BA%8E2%E4%B8%94%E6%B6%A8%E5%B9%85%E5%A4%A7%E4%BA%8E5%EF%BC%9B%E5%BC%80%E7%9B%98%E6%B6%A8%E8%B7%8C%E5%B9%85%3E%3D-1.5%3C8%EF%BC%9B%E4%B8%80%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C%E4%B8%94%E8%82%A1%E4%BB%B720%E5%85%83%E4%BB%A5%E5%86%85%E4%B8%94%E6%B5%81%E9%80%9A%E5%B8%82%E5%80%BC15-110%E4%BA%BF%E4%B8%94%E7%AD%B9%E7%A0%81%E8%8E%B7%E5%88%A9%E6%AF%94%E4%BE%8B%E5%A4%A7%E4%BA%8E60%25%EF%BC%9B%E9%9D%9E%E4%B8%80%E5%AD%97%E6%9D%BF&urp_sort_way=desc&urp_sort_index=5%E6%97%A5%E6%B6%A8%E9%80%9F%5B20220722%5D&page=1&perpage=50&condition=%5B%7B%22chunkedResult%22%3A%22%E5%88%86%E6%97%B6%E6%B6%A8%E9%80%9F%E5%A4%A7%E4%BA%8E2_%26_%E4%B8%94_%26_%E6%B6%A8%E5%B9%85%E5%A4%A7%E4%BA%8E5%3B_%26_%E5%BC%80%E7%9B%98%E6%B6%A8%E8%B7%8C%E5%B9%85%3E%3D-1.5%3C8%3B_%26_%E4%B8%80%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C_%26_%E4%B8%94_%26_%E8%82%A1%E4%BB%B720%E5%85%83%E4%BB%A5%E5%86%85_%26_%E4%B8%94_%26_%E6%B5%81%E9%80%9A%E5%B8%82%E5%80%BC15-110%E4%BA%BF_%26_%E4%B8%94_%26_%E7%AD%B9%E7%A0%81%E8%8E%B7%E5%88%A9%E6%AF%94%E4%BE%8B%E5%A4%A7%E4%BA%8E60%25%3B_%26_%E9%9D%9E%E4%B8%80%E5%AD%97%E6%9D%BF%22%2C%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A19%2C%22relatedSize%22%3A0%7D%2C%7B%22indexName%22%3A%22%E6%B6%A8%E9%80%9F%22%2C%22indexProperties%22%3A%5B%22nodate%201%22%2C%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220722%22%2C%22(0.02%22%5D%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22tech%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220722%22%2C%22(%22%3A%220.02%22%2C%22nodate%22%3A%221%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%25)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%22%E6%B6%A8%E9%80%9F%3E2%25%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%22%E6%B6%A8%E9%80%9F%3E2%25%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%E6%B6%A8%E9%80%9F%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A17%2C%22relatedSize%22%3A0%7D%2C%7B%22indexName%22%3A%22%E6%B6%A8%E8%B7%8C%E5%B9%85%3A%E5%89%8D%E5%A4%8D%E6%9D%83%22%2C%22indexProperties%22%3A%5B%22nodate%201%22%2C%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220722%22%2C%22(0.05%22%5D%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220722%22%2C%22(%22%3A%220.05%22%2C%22nodate%22%3A%221%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%25)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%22%E6%B6%A8%E8%B7%8C%E5%B9%85%3E5%25%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%22%E6%B6%A8%E8%B7%8C%E5%B9%85%3E5%25%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%E6%B6%A8%E8%B7%8C%E5%B9%85%3A%E5%89%8D%E5%A4%8D%E6%9D%83%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A15%2C%22relatedSize%22%3A0%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22uiText%22%3A%222022%E5%B9%B47%E6%9C%8822%E6%97%A509%E7%82%B925%E5%88%86%E7%9A%84%E6%B6%A8%E8%B7%8C%E5%B9%85%3E%3D-1.5%25%E4%B8%942022%E5%B9%B47%E6%9C%8822%E6%97%A509%E7%82%B925%E5%88%86%E7%9A%84%E6%B6%A8%E8%B7%8C%E5%B9%85%3C8%25%22%2C%22sonSize%22%3A2%2C%22queryText%22%3A%222022%E5%B9%B47%E6%9C%8822%E6%97%A509%E7%82%B925%E5%88%86%E7%9A%84%E6%B6%A8%E8%B7%8C%E5%B9%85%3E%3D-1.5%25%E4%B8%942022%E5%B9%B47%E6%9C%8822%E6%97%A509%E7%82%B925%E5%88%86%E7%9A%84%E6%B6%A8%E8%B7%8C%E5%B9%85%3C8%25%22%2C%22relatedSize%22%3A2%7D%2C%7B%22dateText%22%3A%22%E5%BC%80%E7%9B%98%22%2C%22indexName%22%3A%22%E5%88%86%E6%97%B6%E6%B6%A8%E8%B7%8C%E5%B9%85%3A%E5%89%8D%E5%A4%8D%E6%9D%83%22%2C%22indexProperties%22%3A%5B%22%E5%8C%BA%E9%97%B4%E5%81%8F%E7%A7%BB%20%5B0%2C0%5D%22%2C%22%E4%BA%A4%E6%98%93%E6%97%B6%E9%97%B4%2009%3A25%22%2C%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220722%22%2C%22(%3D-0.015%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220722%22%2C%22%E5%8C%BA%E9%97%B4%E5%81%8F%E7%A7%BB%22%3A%22%5B0%2C0%5D%22%2C%22(%3D%22%3A%22-0.015%22%2C%22%E4%BA%A4%E6%98%93%E6%97%B6%E9%97%B4%22%3A%2209%3A25%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%25)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22sonSize%22%3A0%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B%E5%BC%80%E7%9B%98%5D%E6%B6%A8%E8%B7%8C%E5%B9%85%3A%E5%89%8D%E5%A4%8D%E6%9D%83%22%7D%2C%7B%22dateText%22%3A%22%E5%BC%80%E7%9B%98%22%2C%22indexName%22%3A%22%E5%88%86%E6%97%B6%E6%B6%A8%E8%B7%8C%E5%B9%85%3A%E5%89%8D%E5%A4%8D%E6%9D%83%22%2C%22indexProperties%22%3A%5B%22%E5%8C%BA%E9%97%B4%E5%81%8F%E7%A7%BB%20%5B0%2C0%5D%22%2C%22%E4%BA%A4%E6%98%93%E6%97%B6%E9%97%B4%2009%3A25%22%2C%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220722%22%2C%22%3C0.08%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220722%22%2C%22%E5%8C%BA%E9%97%B4%E5%81%8F%E7%A7%BB%22%3A%22%5B0%2C0%5D%22%2C%22%E4%BA%A4%E6%98%93%E6%97%B6%E9%97%B4%22%3A%2209%3A25%22%2C%22%3C%22%3A%220.08%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%25)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22sonSize%22%3A0%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B%E5%BC%80%E7%9B%98%5D%E6%B6%A8%E8%B7%8C%E5%B9%85%3A%E5%89%8D%E5%A4%8D%E6%9D%83%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A11%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%B6%A8%E5%81%9C%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220721%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220721%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%98%AF%E5%90%A6%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%B6%A8%E5%81%9C%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B1%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%B6%A8%E5%81%9C%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A9%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%94%B6%E7%9B%98%E4%BB%B7%3A%E4%B8%8D%E5%A4%8D%E6%9D%83%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220721%22%2C%22%3C%3D20%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%3C%3D%22%3A%2220%22%2C%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220721%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%E5%85%83%7C%E6%B8%AF%E5%85%83%7C%E7%BE%8E%E5%85%83%7C%E8%8B%B1%E9%95%91)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%94%B6%E7%9B%98%E4%BB%B7%3C%3D20%E5%85%83%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%94%B6%E7%9B%98%E4%BB%B7%3C%3D20%E5%85%83%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B1%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%94%B6%E7%9B%98%E4%BB%B7%3A%E4%B8%8D%E5%A4%8D%E6%9D%83%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A7%2C%22relatedSize%22%3A0%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22uiText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84a%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%3E%3D15%E4%BA%BF%E5%85%83%E4%B8%941%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84a%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%3C%3D110%E4%BA%BF%E5%85%83%22%2C%22sonSize%22%3A2%2C%22queryText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84a%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%3E%3D15%E4%BA%BF%E5%85%83%E4%B8%941%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84a%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%3C%3D110%E4%BA%BF%E5%85%83%22%2C%22relatedSize%22%3A2%7D%2C%7B%22dateText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22a%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220721%22%2C%22(%3D1500000000%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220721%22%2C%22(%3D%22%3A%221500000000%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%E5%85%83)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22sonSize%22%3A0%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B1%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5Da%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%22%7D%2C%7B%22dateText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22a%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220721%22%2C%22%3C%3D11000000000%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%3C%3D%22%3A%2211000000000%22%2C%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220721%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%E5%85%83)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22sonSize%22%3A0%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B1%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5Da%E8%82%A1%E5%B8%82%E5%80%BC(%E4%B8%8D%E5%90%AB%E9%99%90%E5%94%AE%E8%82%A1)%22%7D%2C%7B%22opName%22%3A%22and%22%2C%22opProperty%22%3A%22%22%2C%22sonSize%22%3A3%2C%22relatedSize%22%3A0%7D%2C%7B%22dateText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E6%94%B6%E7%9B%98%E8%8E%B7%E5%88%A9%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220721%22%2C%22(0.6%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22index%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220721%22%2C%22(%22%3A%220.6%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22_%E6%B5%AE%E7%82%B9%E5%9E%8B%E6%95%B0%E5%80%BC(%25)%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22uiText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%94%B6%E7%9B%98%E8%8E%B7%E5%88%A9%3E60%25%22%2C%22sonSize%22%3A0%2C%22queryText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E6%94%B6%E7%9B%98%E8%8E%B7%E5%88%A9%3E60%25%22%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B1%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E6%94%B6%E7%9B%98%E8%8E%B7%E5%88%A9%22%7D%2C%7B%22opName%22%3A%22%E5%8F%96%E5%8F%8D%22%2C%22opProperty%22%3A%22%22%2C%22uiText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E4%B8%80%E5%AD%97%E7%BA%BF%E5%8F%96%E5%8F%8D%22%2C%22sonSize%22%3A1%2C%22queryText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E7%9A%84%E4%B8%80%E5%AD%97%E7%BA%BF%E5%8F%96%E5%8F%8D%22%2C%22relatedSize%22%3A1%7D%2C%7B%22dateText%22%3A%221%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%22%2C%22indexName%22%3A%22%E4%B8%80%E5%AD%97%E7%BA%BF%22%2C%22indexProperties%22%3A%5B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%2020220721%22%5D%2C%22dateUnit%22%3A%22%E6%97%A5%22%2C%22source%22%3A%22new_parser%22%2C%22type%22%3A%22tech%22%2C%22indexPropertiesMap%22%3A%7B%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%3A%2220220721%22%7D%2C%22reportType%22%3A%22TRADE_DAILY%22%2C%22dateType%22%3A%22%E4%BA%A4%E6%98%93%E6%97%A5%E6%9C%9F%22%2C%22valueType%22%3A%22%22%2C%22domain%22%3A%22abs_%E8%82%A1%E7%A5%A8%E9%A2%86%E5%9F%9F%22%2C%22sonSize%22%3A0%2C%22relatedSize%22%3A0%2C%22tag%22%3A%22%5B1%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%5D%E4%B8%80%E5%AD%97%E7%BA%BF%22%7D%5D&codelist=&indexnamelimit=&logid=bcc1c185838a2f50d2bca54b9739e02c&ret=json_all&sessionid=22c243e0d6f7299a1585c4dcc63f1621&date_range%5B0%5D=20220721&date_range%5B1%5D=20220722&iwc_token=&urp_use_sort=1&user_id=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe&uuids%5B0%5D=24087&query_type=stock&comp_id=6257151&business_cat=soniu&uuid=24087',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json, text/plain, */*',
                'Accept-Language: zh-CN,zh;q=0.9',
                'Cache-control: no-cache',
                'Connection: keep-alive',
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: cid=78507239c6883680d9d2953835a75ec31637978778; v=A-w7rX0nomfaO7ZfeHyPpDKDu8EbpY5Mkiynm0ci-XM7xYL_brVg3-JZdeOV',
                'Origin: http://www.iwencai.com',
                'Pragma: no-cache',
                'Referer: http://www.iwencai.com/',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}