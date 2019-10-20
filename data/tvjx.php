<?php
error_reporting(0);
include('../system/inc.php'); //载入全局配置
header('Content-type:text/html;charset=utf-8');
$urllist='http://www.360kan.com/dianshi/list.php?rank=rankhot&pageno=1';
$info= curl_get($urllist);
switch($_GET['n']){
    case "jp":
        $vname='#<span class="s1">(.*?)</span>#';//影片名称
        $fname='#<span class="s2">(.*?)</span>#';//评分
        $nname='#<span class="hint">(.*?)</span>#';//年份
        $vlist='#<a class="js-tongjic" href="(.*?)">#';//链接
        $vstar='# <p class="star">(.*?)</p>#';//主演
        $vvlist='#<div class="s-tab-main">[\s\S]+?<div monitor-desc#';//获取图片区域
        $vimg='#<img src="(.*?)">#'; //图片
        $array = array();
        preg_match_all($vname, $info,$tvnamearr); //影片名称
        preg_match_all($vlist, $info,$tvlinkarr);//链接
        preg_match_all($vstar, $info,$tvzhuyanarr);//主演
        preg_match_all($vvlist, $info,$imglist);
        $zcf=implode($glue, $imglist[0]);
        preg_match_all($vimg, $zcf,$tvimgarr); //图片
        preg_match_all($fname, $info,$tvpingfenarr); //评分
        preg_match_all($nname, $info,$tvyeararr);// 年份
        $i=0;
        foreach ($tvnamearr[1] as $key => $value)
        {if ($i<12){
        $url=$tvlinkarr[1][$key]; //地址
        $img=$tvimgarr[1][$key]; //图片
        $name=$tvnamearr[1][$key];//名称
        $nname=$tvpingfenarr[1][$key]; //评分
        $jishu=$tvyeararr[1][$key]; //年份
        $zhuyan=$tvzhuyanarr[1][$key];//主演
        $jiami=$url;
        if ($xtcms_wei==1){
        $chuandi='./vod'.$jiami;
        }
        else{
        $chuandi='./play.php?play='.$jiami;
        }

        echo "<li class='col-md-5 col-sm-4 col-xs-3 ";
        if ($i>=10){
        echo "hidden-lg hidden-md";
        }
        echo "'><div class='stui-vodlist__box'>
        <a class='stui-vodlist__thumb lazyload img-shadow' href='$chuandi' target='_blank' title='$name' alt='$name' style='background:url({$img}) no-repeat;background-size:100%;background-position:50% 50%;'>
        <span class='play hidden-xs'></span>
        <span class='pic-text text-right'>$jishu</span>
        </a><div class='stui-vodlist__detail'>
        <h4 class='title text-overflow'>
        <a href='$chuandi' title='$name'>$name</a>
        </h4>
        <p class='text text-overflow text-muted hidden-xs'>$zhuyan</p>
        </div>
        </div>
        </li>";
        $i ++;}
        }
    break;
    case "wp":
    case "ht":
        $vname='#<span class="s1">(.*?)</span>#';$vlist='#<a class="js-tongjic" href="(.*?)">#';
        $vvlist='#<div class="s-tab-main">[\s\S]+?<div monitor-desc#';
        $vstar='# <p class="star">(.*?)</p>#';$nname='#<span class="hint">(.*?)</span>#';
        $vvlist='#<div class="s-tab-main">[\s\S]+?<div monitor-desc#';
        $vimg='#<img src="(.*?)">#';
        $bflist='#<a data-daochu(.*?) href="(.*?)" class="js-site-btn btn btn-play"></a>#';
        $jishu='#<span class="hint">(.*?)</span>#';//集数
        $array = array();
        preg_match_all($vname, $info,$namearr); //名称
        preg_match_all($vlist, $info,$listarr);
        preg_match_all($vstar, $info,$stararr);
        preg_match_all($vvlist, $info,$imglist);
        preg_match_all($jishu, $info,$xjishu);
        $zcf=implode($glue, $imglist[0]);
        preg_match_all($vimg, $zcf,$imgarr);
        preg_match_all($nname, $info,$nnamearr);
        $i = 0;
        foreach ($namearr[1] as $key => $value) {
            if ($i < 12) {
                $gul = $listarr[1][$key];
                $guq = $listarr[1][$key];
                $_GET['id'] = $gul;
                $zimg = $imgarr[1][$key];
                $zname = $namearr[1][$key];
                $nname = $nnamearr[1][$key];
                $jishu = $xjishu[1][$key];
                $zstar = $stararr[1][$key];
                $jiami = $gul;

                if ($xtcms_wei == 1) {
                    $chuandi = './vod' . $jiami;
                } else {
                    $chuandi = './play.php?play=' . $jiami;
                }
                echo '<div class="col-md-2 col-sm-3 col-xs-4">
            <a class="videopic lazy" href="' . $chuandi . '" title="' . $zname . '" data-original="' . $zimg . '" style="background: url('.$zimg.') no-repeat; background-position:50% 50%; background-size: cover; border-radius: 6px;"><span class="play hidden-xs"></span><span class="score">' . $jishu . '</span></a>
            <div class="title">
                <h5 class="text-overflow"><a href="' . $chuandi . '">' . $zname . '</a></h5>
            </div>
            <div class="subtitle text-muted text-muted text-overflow hidden-xs">' . $zstar . '</div>
        </div>';
                $i++;
            }
        }
    break;
    case "hyqs":
        $vname = '#<span class="s1">(.*?)</span>#';
        $vlist = '#<a class="js-tongjic" href="(.*?)">#';
        $vvlist = '#<div class="s-tab-main">[\s\S]+?<div monitor-desc#';
        $vstar = '# <p class="star">(.*?)</p>#';
        $nname = '#<span class="hint">(.*?)</span>#';
        $vvlist = '#<div class="s-tab-main">[\s\S]+?<div monitor-desc#';
        $vimg = '#<img src="(.*?)">#';
        $bflist = '#<a data-daochu(.*?) href="(.*?)" class="js-site-btn btn btn-play"></a>#';
        $jishu = '#<span class="hint">(.*?)</span>#'; //集数
        $array = array();
        preg_match_all($vname, $info, $namearr); //名称
        preg_match_all($vlist, $info, $listarr);
        preg_match_all($vstar, $info, $stararr);
        preg_match_all($vvlist, $info, $imglist);
        preg_match_all($jishu, $info, $xjishu);
        $zcf = implode($glue, $imglist[0]);
        preg_match_all($vimg, $zcf, $imgarr);
        preg_match_all($nname, $info, $nnamearr);
        $i = 0;
        foreach ($namearr[1] as $key => $value) {
            if ($i < 12) {
                $gul = $listarr[1][$key];
                $guq = $listarr[1][$key];
                $_GET['id'] = $gul;
                $zimg = $imgarr[1][$key];
                $zname = $namearr[1][$key];
                $nname = $nnamearr[1][$key];
                $jishu = $xjishu[1][$key];
                $zstar = $stararr[1][$key];
                $jiami = $gul;

                if ($xtcms_wei == 1) {
                    $chuandi = './vod' . $jiami;
                } else {
                    $chuandi = './play.php?play=' . $jiami;
                }
                echo "<li><div class='stui-vodlist__box'>
								<a class='stui-vodlist__thumb lazyload' href='$chuandi' title='$zname' style='background: url({$zimg}) no-repeat;background-size:100%;background-position:50% 50%;'>
									<span class='play hidden-xs'></span>
									<span class='pic-text text-right'>$jishu</span>
								</a>
								<div class='stui-vodlist__detail'>
									<h4 class='title text-overflow'><a href='$chuandi' title='$zname'>$zname</a></h4>
								</div>
							</div>
						</li>";
                $i++;
            }
        }
    break;
    case "st21":
    break;
}

?>
