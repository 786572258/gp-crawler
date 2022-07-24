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
    $thsResponse = Crawler::getSecondBoardGp();
    Service::notice($thsResponse);


    echo "done";
}

main();
