<?php
require_once  "comm.php";
require_once   "sendMailService.php";

class Service
{
    function getHardenIndustry() {

    }

    public static function getThsData($response) {
        $response = json_decode($response, true);
        $data = @$response["data"]["answer"]["0"]["txt"][0]["content"]["components"][0]["data"];
        if (!$data) {
            $data = @$response["answer"]["components"][0]["data"];
        }
        return $data;
    }

    public static function setHardenIndustry($harden) {
        global $db;
//        ob_clean();
//         p($harden);
//        exit();
        $data = self::getThsData($harden);
        if (!@$harden || !$data || @!$data["datas"]) {
            throw new Exception("没有数据");
            return false;
        }
        $datas = $data["datas"];
        $date = $data["meta"]["time"];
        $date = explode(" ", $date)[0];
        $hardenNum = $data["meta"]["extra"]["code_count"];

        $hardenIndustryWithKey = [];
        $hardenReasons = [];
        $hardenIndustryArr = [];
        $hardenIndustryTextArr = [];
        foreach ($datas as $k => $v) {
            @$hardenIndustryWithKey[$v["所属同花顺一级行业"]][] = $v;
//        echo $k+1 . "    " . $v["股票简称"] . "<br>";
        }

        foreach ($hardenIndustryWithKey as $k => $v) {
            $hardenIndustryArr[] = [
                "harden_industry_name" => $k,
                "harden_industry_ztnum" => count($v),
//            "harden_industry_zt_reason" => $v["涨停原因类别[20220624]"],
            ];
        }
        $harden_industry_ztnums = array();
        foreach ($hardenIndustryArr as $hardenIndustry) {
            $harden_industry_ztnums[] = $hardenIndustry['harden_industry_ztnum'];
        }
//根据涨停数排行
        array_multisort($harden_industry_ztnums, SORT_DESC, $hardenIndustryArr);
        foreach ($hardenIndustryArr as $k => $v) {
            $hardenIndustryTextArr[] = "行业:{$v['harden_industry_name']}|涨停数:{$v['harden_industry_ztnum']}";
        }
        foreach ($datas as $k => $v) {
//            涨停原因类别[20220622]: "资产重组+光伏+储能"
            $hardenReasonUnitArr = explode("+", $v["涨停原因类别[$date]"]);
            foreach ($hardenReasonUnitArr as $kk => $vv) {
                @$hardenReasons[$vv]++;
            }
        }
        arsort($hardenReasons);
        $hardenReasonsNames = array_keys($hardenReasons);
        $hardenReasonString = @implode("+", array_slice($hardenReasonsNames,0,4));
        $hardenReasonNumString = @implode("+", array_slice($hardenReasons,0,4));

        //前三入库
        $hardenIndustryModel = [
            "harden_industry_first" => $hardenIndustryArr[0]["harden_industry_name"] ?? "",
            "harden_industry_first_ztnum" => $hardenIndustryArr[0]["harden_industry_ztnum"] ?? 0,

            "harden_industry_second" => $hardenIndustryArr[1]["harden_industry_name"] ?? "",
            "harden_industry_second_ztnum" => $hardenIndustryArr[1]["harden_industry_ztnum"] ?? 0,

            "harden_industry_third" => $hardenIndustryArr[2]["harden_industry_name"] ?? "",
            "harden_industry_third_ztnum" => $hardenIndustryArr[2]["harden_industry_ztnum"] ?? 0,
            "date" => $date,
            "harden_num" => $hardenNum,
            "harden_reason" => $hardenReasonString . " " . $hardenReasonNumString,
            "harden_industry_text" => implode("\n", $hardenIndustryTextArr),
        ];
        $r = $db->insert("harden_industry", $hardenIndustryModel);
        $id = $db->getLastId();
        $db->delete("harden_industry","date = '".$date."' and id != '$id'");
        return $r;
    }

    public static function setHardenContinuous($harden) {
        global $db;

        $data = self::getThsData($harden);
        if (!@$harden || !$data || @!$data["datas"]) {
            throw new Exception("没有数据");
        }

//        ob_clean();
//        pj($data);
//        exit();
        $datas = $data["datas"];
        $date = $data["meta"]["time"];
        $date = explode(" ", $date)[0];
        $hardenNum = $data["meta"]["extra"]["code_count"];
        //对数据整理
        $hardenDays = array();
        foreach($datas as $k => $v) {
            $datas[$k]["涨停天数"] = $v["连续涨停天数[{$date}]"];
            $fewDayFewBoard = $v["几天几板[{$date}]"];
            if (strstr($fewDayFewBoard, "天")) {
                $fewDay = explode("天", $fewDayFewBoard)[0];
                $fewBoard = explode("板", explode("天", $fewDayFewBoard)[1])[0];
                if ($fewDay >= 5 && $fewBoard >= 4 && ($fewDay - $fewBoard) <= 3 && $fewDay != $fewBoard) {
                    $datas[$k]["涨停天数"] = $fewBoard;
                    $datas[$k]["股票简称"] = $v["股票简称"].$fewDayFewBoard;
                }
            }
            $hardenDays[] = $datas[$k]["涨停天数"];
        }

        //对数据排序
        //根据涨停天数排行
        array_multisort($hardenDays, SORT_DESC, $datas);

        $hardenIndustryGroup = [];
        $hardenIndustryGroupCounts = array();
        foreach($datas as $k => $v) {
            $hardenIndustryGroup[$v["所属同花顺一级行业"]][] = $v;
        }
        foreach($hardenIndustryGroup as $k => $v) {
            $hardenIndustryGroupCounts[] = count($v);
        }
        array_multisort($hardenIndustryGroupCounts, SORT_DESC, $hardenIndustryGroup);

//        pj($hardenIndustryGroup);
//        exit();
        $hardenTextArr = [];
        $datas = array_slice($datas,0,8);
//        pj($datas);
//        exit();
        foreach ($datas as $k => $v) {
            $hardenTextArr[] = "股票简称:{$v["股票简称"]}|连涨天数:{$v["涨停天数"]}|换手率:". round($v["换手率[$date]"], 0) . "|封单额:" . round($v["涨停封单额[$date]"] / 10000, 0). "|一级行业:" . $v["所属同花顺一级行业"]. "|原因:" . @$v["涨停原因类别[$date]"] ;
        }
        $hardenLimitdownModel = [
            "harden_text" => implode("\n", $hardenTextArr),
            "date" => $date,
        ];
        $r = $db->insert("harden_limitdown", $hardenLimitdownModel);
        $id = $db->getLastId();
        $db->delete("harden_limitdown","date = '".$date."' and id != '$id'");
        return $r;
    }

    public static function getHarden() {
        $list = Comm::getDB()->fetAll("harden_limitdown","*","date desc",1,500);
        return $list;
//        print_r($list);
    }

    public static function getBattledoreNoticeList($date) {
        $list = Comm::getDB()->fetAll("battledore_notice","*","date desc","date='$date'",500);
        return $list;
    }

    public static function getHardenIndustrys() {
        $list = Comm::getDB()->fetAll("harden_industry","*","date desc",1,500);
        return $list;
//        print_r($list);
    }

    public static function changeHardenText($harden_text) {
        $hardenOneDayTextRows = explode("\n", $harden_text);
        $hardenOneDayArr = [];
        $hardensArr = [];
        foreach ($hardenOneDayTextRows as $kk => $vv) {
//                print_r($hardenOneDayTextRows);
//                exit();
            $hardenOneGpKeyValueTextRows = explode("|", $vv);
            $hardenOneGpKeyValueArr = [];
            foreach ($hardenOneGpKeyValueTextRows as $kkk => $vvv) {
                $key = explode(":", $vvv)[0];
                $value = explode(":", $vvv)[1];
                $hardenOneGpKeyValueArr[$key] = $value;
            }
            $hardenOneDayArr[] = $hardenOneGpKeyValueArr;
        }
//        print_r($hardenOneDayArr);
//        exit();

//            $hardensArr[] = $hardenArr;
        return $hardenOneDayArr;
    }


    public static function notice($thsResponse) {
        file_put_contents("run.txt", "调度执行-". date("Y-m-d H:i:s") ."\n", FILE_APPEND);
        $checkDayStr = date('Y-m-d ',time());
        $currTime = time();
        $timeBegin940 = strtotime($checkDayStr."09:40".":00");
        $timeEnd1020 = strtotime($checkDayStr."10:20".":00");

        $timeBegin1300 = strtotime($checkDayStr."13:00".":00");
        $timeEnd1350 = strtotime($checkDayStr."13:50".":00");
        if ($currTime < $timeBegin940 || ($currTime >= $timeEnd1020 && $currTime < $timeBegin1300)) {
            die("不在打板时间范围");
        } else if ($currTime < $timeBegin1300 || $currTime >= $timeEnd1350) {
            die("不在打板时间范围");
        }

        $i = 0;
        while($i < 10) {
            global $db;
            $data = self::getThsData($thsResponse);
            if (!@$thsResponse || !$data || @!$data["datas"]) {
                throw new Exception("没有数据");
                return false;
            }
            $datas = $data["datas"];
            //提取日期
            foreach ($datas as $k => $v) {
                foreach ($v as $kk => $vv) {
                    if (strstr($kk, "5日涨速[")) {
                        preg_match("/5日涨速\[(\d*)\]/s", $kk, $res);
                        $date = $res[1];
                        break 2;
                    }
                }
                exit();
            }
            if (!$date) {
                file_put_contents("run.txt", "获取日期失败". date("yy-mm-dd H:i:s") ."\n", FILE_APPEND);
                echo "获取日期失败";
                exit();
            }

            $hour = date("H");
            $battledoreNoticeList = self::getBattledoreNoticeList($date);
            $noticeMsg = "符合二板模式:";
            $r = 0;
            foreach ($datas as $k => $v) {
                foreach($battledoreNoticeList as $battledoreNoticeKey => $battledoreNotice) {
                    if ($v["股票简称"] == $battledoreNotice["gpname"] && $hour == $battledoreNotice["hour"]) {
                        echo "存在,跳过";
                        continue 2;
                    }
                }
                $battledore_notice_arr = [
                    "gpname" => $v["股票简称"],
                    "date" => $date,
                    "hour" => $hour,
                ];
                $r = $db->insert("battledore_notice", $battledore_notice_arr);
                $id = $db->getLastId();
                $noticeMsg .= $v["股票简称"]." ";
            }
            if ($r) {
                //消息通知
                $sendResult = sendMail("595171801@qq.com", $noticeMsg, $noticeMsg);
                echo "推送结果:".$sendResult;
                file_put_contents("run.txt", "推送结果:".$sendResult. date("yy-mm-dd H:i:s") ."\n", FILE_APPEND);
            }
            $i++;
            sleep(6);
        }
    }

}