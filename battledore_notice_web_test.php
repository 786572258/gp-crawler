<?php
require_once  "comm.php";
require_once  "service.php";
require_once  "crawler.php";

/**
 * 打板通知
 *
分时涨速大于2且涨幅大于5；开盘涨跌幅>=-1.5<8；一个交易日前涨停且股价20元以内且流通市值15-110亿且筹码获利比例大于60%；非一字板
 *
 * 推荐:近1分钟区间涨跌幅大于4.5；开盘涨跌幅>=-1.5<8；一个交易日前涨停且股价20元以内且流通市值15-110亿且筹码获利比例大于60%；非一字板
  http://www.iwencai.com/unifiedwap/result?w=%E8%BF%911%E5%88%86%E9%92%9F%E5%8C%BA%E9%97%B4%E6%B6%A8%E8%B7%8C%E5%B9%85%E5%A4%A7%E4%BA%8E4.5%EF%BC%9B%E5%BC%80%E7%9B%98%E6%B6%A8%E8%B7%8C%E5%B9%85%3E%3D-1.5%3C8%EF%BC%9B%E4%B8%80%E4%B8%AA%E4%BA%A4%E6%98%93%E6%97%A5%E5%89%8D%E6%B6%A8%E5%81%9C%E4%B8%94%E8%82%A1%E4%BB%B720%E5%85%83%E4%BB%A5%E5%86%85%E4%B8%94%E6%B5%81%E9%80%9A%E5%B8%82%E5%80%BC15-110%E4%BA%BF%E4%B8%94%E7%AD%B9%E7%A0%81%E8%8E%B7%E5%88%A9%E6%AF%94%E4%BE%8B%E5%A4%A7%E4%BA%8E60%25%EF%BC%9B%E9%9D%9E%E4%B8%80%E5%AD%97%E6%9D%BF&querytype=stock

 */
function main() {
    $thsResponse = Crawler::getSecondBoardGpByCookie();
    $data = Service::getThsData($thsResponse);
    pj($data);exit();
}

main();
