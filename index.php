<?php
require_once  "comm.php";

require_once "service.php";
require_once  "crawler.php";

/**
 * @throws Exception
 */
$html = "";
$frontDay = isset($_GET["frontDay"]) ? $_GET["frontDay"] : null;
if ($frontDay != null) {
    setHardenContinuous($frontDay); //写涨停连板
    setHardenIndustry($frontDay);  //写入涨停行业
}

//    ob_end_clean();

$hardens = Service::getHarden();
$hardenIndustrys = Service::getHardenIndustrys();
$hardenIndustrys = array_column($hardenIndustrys, null, "date");
//p($hardenIndustrys);
//    exit();
$trArr = [];
for ($i = -1; $i < 20; $i++) {
    $tds = "";
    if ($i == 1) {
        foreach ($hardens as $k => $v) {
            $tds .= "<td >{$v["date"]}</td>";
        }
    } else if ($i == 0) {
        foreach ($hardens as $k => $v) {
            $hardensNumText = "涨停数=".@$hardenIndustrys[$v["date"]]["harden_num"];
            $t = @$hardenIndustrys[$v["date"]]["harden_industry_text"] ?? "";
            $tds .= "<td  style='color:blue' onclick='hardensIndustryShow(this)' title='".@$hardenIndustrys[$v["date"]]["harden_industry_text"]."\n".$hardensNumText."'>".@$hardenIndustrys[$v["date"]]["harden_reason"]."</td>";
        }

    } else if ($i == -1) {
        foreach ($hardens as $k => $v) {
            $tds .= "<td>".@$hardenIndustrys[$v["date"]]["harden_num"]."</td>";
        }

    } else {
        foreach ($hardens as $k => $v) {
            $hardenOneDay = Service::changeHardenText($v["harden_text"]);
            $isSetTd = false;
            $matchedGp = [];
            $matchedGpDetail = [];
            foreach ($hardenOneDay as $hardenOneDayKey => $hardenOneGp) {
                if ($hardenOneGp["连涨天数"] == $i) {
                    $matchedGp[] = $hardenOneGp['股票简称']."(".@$hardenOneGp['一级行业'].")";
//                    $matchedGpDetail[] = implode("|", $hardenOneGp);
                    //拼装一只股票的详情
                    $hardenOneGpDetailText = "";
                    foreach($hardenOneGp as $kkk => $vvv) {
                        $hardenOneGpDetailText .= $kkk.":".$vvv."|";
                    }
                    $hardenOneGpDetailText = rtrim($hardenOneGpDetailText, "|");
                    $matchedGpDetail[] = $hardenOneGpDetailText;
                }
//                    print_r($matchedGp);
//                    exit();
            }
            $matchedGpDetailText = implode("\n\n", $matchedGpDetail);
//            p($matchedGpDetail);exit();
            if ($matchedGp) {
                $tds .= "<td  title=\"$matchedGpDetailText\"  onclick='showGpDetail(this)'>".implode("<br>", $matchedGp)."</td>";
                $isSetTd = true;
//                    break;
            }
            if ($isSetTd == false) {
                $tds .= "<td ></td>";
            };
        }
    }
    $leftTitle = "{$i}板";
    if ($i == 1) {
        $leftTitle = "日期";
    } else if ($i == 0) {
        $leftTitle = "热点";
    } else if ($i == -1) {
        $leftTitle = "涨停数";
    }
    $trStyleComm = "white-space: nowrap;";
    if ($i == 5) {
        $trStyle = "style='background: wheat; $trStyleComm' ";
    } else if ($i == 10) {
        $trStyle = "style='background: violet; $trStyleComm'";
    } else if ($i >= 1) {
        $trStyle = "style='$trStyleComm' ";
    } else {
        $trStyle = "style=''";

    }
    $trArr[] = "
            <tr $trStyle >
                <td>$leftTitle</td>
                {$tds}

            </tr>
            ";
}
$trArr = array_reverse($trArr);
//    print_r($trArr);
//    exit();
//    rsort($trArr);
$trs = implode("", $trArr);

$html = "
    <table border=\"\">
        $trs
    </table>
    ";


function setHardenContinuous($frontDay) {
    echo "写入涨停...".PHP_EOL."<br>";
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
    echo " 写入涨停成功";
}


function setHardenIndustry($frontDay) {

    // ============= 写入涨停行业 ==============
    echo "写入涨停行业...".PHP_EOL."<br>";
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
    echo " 写入涨停行业成功";
}
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />

    <title>涨停梯队</title>

    <!-- Bootstrap -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .total-form .control-label{
            line-height: 34px;
        }
        table {
            border-collapse: unset;
            border:1px;
        }
        body {
            padding: 0 20% 0 20%;
        }
    </style>
</head>

<div class="">

    <?=$html;?>
    <div class="form-group" style="margin-top:20px; margin-bottom: 100px;" >

        <div class=" col-xs-4">
            <button type="submit" id="flush" class="pull-right btn btn-success">刷新</button>

        </div>
        <div class=" col-xs-6">
            <button type="submit" id="flush7" class="pull-right btn btn-success">刷新近7天</button>

        </div>

    </div>
</div>
<body>
<br>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function hardensIndustryShow(t) {
        alert($(t).attr("title"));
    }

    function showGpDetail(t) {
        alert($(t).attr("title"));
    }

    $(function(){
        $("#flush").click(function () {
            window.location = "index.php?frontDay=0"
        });
        $("#flush7").click(function () {
            window.location = "index.php?frontDay=7"
        });
    });
</script>
</body>
</html>