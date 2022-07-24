<?php
echo 3;exit();
require_once  "comm.php";
require_once "service.php";
require_once "crawler.php";
/**
 * @throws Exception
 */
function main() {
//    $_GET["cookie"] = "other_uid=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe; ta_random_userid=1t3sfi1t21; cid=78507239c6883680d9d2953835a75ec31637978778; PHPSESSID=22c243e0d6f7299a1585c4dcc63f1621; cid=78507239c6883680d9d2953835a75ec31637978778; ComputerID=78507239c6883680d9d2953835a75ec31637978778; WafStatus=0; wencai_pc_version=1; v=A_QjtaUPKp7REL6rHDoXzGorw7ljzRYvWsmtco9qgesC2Zrntt3oR6oBfH_d";
//    $_GET["cookie"] = "other_uid=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe; ta_random_userid=1t3sfi1t21; cid=78507239c6883680d9d2953835a75ec31637978778; PHPSESSID=22c243e0d6f7299a1585c4dcc63f1621; cid=78507239c6883680d9d2953835a75ec31637978778; ComputerID=78507239c6883680d9d2953835a75ec31637978778; WafStatus=0; wencai_pc_version=1; v=A_oth_-pTLUCRsDZF3vx3lClTSsZq34k8C3yKQTzp55Y1ZSV7DvOlcC_QivX";
//    $_GET["cookie"] = "other_uid=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe; ta_random_userid=1t3sfi1t21; cid=78507239c6883680d9d2953835a75ec31637978778; PHPSESSID=22c243e0d6f7299a1585c4dcc63f1621; cid=78507239c6883680d9d2953835a75ec31637978778; ComputerID=78507239c6883680d9d2953835a75ec31637978778; WafStatus=0; wencai_pc_version=1; v=A3ivAQljbhvM7IKfQV1TAM5_Ty0P4d02PkGw77LoxTVm0hYTWvGs-45VgGUB";
//    $_GET["useCookie"] = 0;
    $_GET["frontDay"] = 7;
    if (@$_GET["cookie"]) {
//        Crawler::setCookie("other_uid=Ths_iwencai_Xuangu_pbddnwn06ktvlp5wv1d394ls5qtzp7fe; ta_random_userid=1t3sfi1t21; cid=78507239c6883680d9d2953835a75ec31637978778; PHPSESSID=22c243e0d6f7299a1585c4dcc63f1621; cid=78507239c6883680d9d2953835a75ec31637978778; ComputerID=78507239c6883680d9d2953835a75ec31637978778; WafStatus=0; v=A2m-0oBULzQcKROUWKFyIydAfh7GNnyQx4OK0woO5FiP9IdAU4ZtOFd6kMOY");
        Crawler::setCookie($_GET["cookie"]);
    }


    setHardenContinuous(); //写涨停连板
    setHardenIndustry();  //写入涨停行业


}

function view() {

}

function setHardenContinuous() {
    echo "写入涨停...".PHP_EOL."<br>";
    $frontDay = (int)@$_GET["frontDay"] ?? 0;
    if ($_GET["cookie"] && @$_GET["useCookie"]) {
        for ($i = 0; $i <= $frontDay; $i++) {
            echo "序号:".$i. " ";
            try {
                echo "结果:";
                echo Service::setHardenContinuous(Crawler::getHardenContinuousWithCookie($i));
                echo PHP_EOL;
            } catch (Exception $e) {
                echo "异常".$e->getMessage().PHP_EOL;
                continue;
            }
        }
    } else {
        for ($i = 0; $i <= $frontDay; $i++) {
            echo "序号:".$i. " ";
            try {
                $r = Service::setHardenContinuous(Crawler::getHardenContinuous($i));
                echo "结果:".$r;
            } catch (Exception $e) {
                echo "异常".$e->getMessage().PHP_EOL;
            }
            echo PHP_EOL."<br>";
        }
    }
    echo " 写入涨停成功";
}


function setHardenIndustry() {
    // ============= 写入涨停行业 ==============
    echo "写入涨停行业...".PHP_EOL."<br>";
    $frontDay = (int)@$_GET["frontDay"] ?? 0;
    if (@$_GET["cookie"] && @$_GET["useCookie"]) {
        for ($i = 0; $i <= $frontDay; $i++) {
            echo "序号:".$i. " ";
            try {
                echo "结果:";
                echo Service::setHardenIndustry(Crawler::getHardenWithCookie($i));
                echo PHP_EOL;
            } catch (Exception $e) {
                echo "异常".$e->getMessage().PHP_EOL;
            }
        }
    } else {
        for ($i = 0; $i <= $frontDay; $i++) {
            echo "序号:".$i. " ";
            try {
                $r = Service::setHardenIndustry(Crawler::getHarden($i));
                echo "结果:".$r;
            } catch (Exception $e) {
                echo "异常".$e->getMessage().PHP_EOL;
            }
            echo PHP_EOL."<br>";
        }
    }
    echo " 写入涨停行业成功";
}
main();
