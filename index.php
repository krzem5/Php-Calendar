<?php
$args=explode("?",$_SERVER["REQUEST_URI"]);
$y=date("Y");
$m=date("n");
$hd=0;
if (sizeof($args)==2){
	$dt=explode("-",explode("date=",$args[1])[1]);
	$hd=$dt[0];
	$m=$dt[1];
	$y=$dt[2];
}
echo "
<html>
	<head>
		<title>Calendar - ".date("n/Y",mktime(0,0,0,$m,1,$y))."</title>
		<style>
			@import url(\"https://fonts.googleapis.com/css?family=Mansalva|Gloria+Hallelujah|Indie+Flower&display=swap\");
			body {
				width: 100%;
				height: 100%;
			}
			body, body * {
				margin: 0;
				padding: 0;
				user-select: none;
			}
			.bg {
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-image: url(\"https://www.setaswall.com/wp-content/uploads/2017/03/Artistic-Landscape-4K-Wallpaper-3840x2160.jpg\");
				filter: blur(4px);
			}
			.wr {
				position: absolute;
				top: 50%;
				left: 50%;
				width: 700px;
				height: 695px;
				background: #28282c;
				border-radius: 20px;
				transform: translate(-50%,-50%);
				box-shadow: 0 0 15px 15px #ececec50;
				overflow: hidden;
			}
			.header {
				top: 0;
				left: 0;
				width: 100%;
				height: 55px;
				font-family: Mansalva;
				font-size: 30px;
				text-align: center;
				line-height: 55px;
				color: #c4e7bf;
				cursor: pointer;
			}
			.arrow.l {
				position: absolute;
				top: 0;
				left: 0;
				width: 55px;
				height: 55px;
				line-height: 55px;
				text-align: center;
				font-size: 45px;
				text-decoration: none;
				color: #b373ee;
				font-family: consolas;
			}
			.arrow.r {
				position: absolute;
				top: 0;
				right: 0;
				width: 55px;
				height: 55px;
				line-height: 55px;
				text-align: center;
				font-size: 45px;
				text-decoration: none;
				color: #b373ee;
				font-family: consolas;
			}
			.line-svg {
				transform: translate(0,-26px);
			}
			.line-svg .line {
				fill: none;
				stroke: #709dac;
				stroke-width: 0.85;
				stroke-linecap: round;
				stroke-linejoin: round;
			}
			.box {
				position: absolute;
				width: 100px;
				height: 100px;
				font-family: Indie Flower;
				font-size: 38px;
				line-height: 100px;
				text-align: center;
				color: #d8f7fa;
			}
			.box.today {
				color: #deff00 !important;
				box-shadow: inset 0 0 15px 0.05px #ffde00 !important;
				background: repeating-linear-gradient(135deg,#ff9c00,#ff9c00 10px,#de3d0c 10px,#de3d0c 20px);
				background-size: 200px 200px;
				animation: bg-gradient 3s linear infinite;
				font-weight: 800 !important;
				font-size: 45px !important;
			}
			.box.birthsday {
				color: #0d3df1 !important;
				box-shadow: inset 0 0 15px 5px #8a26f0 !important;
				background: repeating-linear-gradient(135deg,#31cbec,#31cbec 10px,#1fd30c 10px,#1fd30c 20px);
				background-size: 200px 200px;
				animation: bg-gradient 3s linear infinite;
				font-weight: 800 !important;
				font-size: 55px !important;
			}
			.box.selected {

			}
			.box.selected .sel-svg {
				transform: translate(0,-100px);
			}
			.box.selected .sel-svg .sel {
				stroke: #a41111;
				stroke-width: 5;
				stroke-linecap: round;
				stroke-linejoin: round;
				fill: none;
				stroke-dasharray: 220px;
				stroke-dashoffset: 220px;
				transition: stroke-dashoffset 0.35s cubic-bezier(0.35,0,0.55,1);
			}
			.box.selected .sel-svg .sel.anim {
				stroke-dashoffset: 0;
			}
			.box:not(.day) {
				cursor: pointer;
				box-shadow: inset 0 0 5px 0.05px #505050;
			}
			.box.rm-top:after {
				content: \"\";
				position: absolute;
				top: -1px;
				left: 0;
				width: 100px;
				height: 7px;
				background-color: #28282c;
			}
			.box.weekend {
				color: #f19143;
			}
			.box.day {
				height: 30px;
				line-height: 30px;
				font-family: Gloria Hallelujah;
				font-weight: 800;
				font-size: 25px;
				color: #5fd0dc;
			}
			.box.day.weekend {
				color: #e8592c;
			}
			.box.pad {
				font-size: 22px;
				color: #95abad;
			}
			.box.pad.weekend {
				font-size: 22px;
				color: #a6642e;
			}
			@keyframes bg-gradient {
				0% {
					background-position: 100px 100px;
				}
				100% {
					background-position: 200px 200px;
				}
			}
		</style>
		<script type=\"text/javascript\">
			function change_date(nd){
				window.location.href=window.location.href.split(\"?\")[0]+`?date=\${nd}`;
			}
			function start_anim(){
				var e=document.querySelectorAll(\".box.selected .sel-svg .sel\")[0];
				if (e!=undefined){
					setTimeout(function(){
						e.classList.add(\"anim\");
					},500);
				}
			}
		</script>
	</head>
	<body onload=\"javascript:start_anim();\">
		<div class=\"bg\">
		</div>
		<div class=\"wr\">
			<div class=\"header\" onclick=\"javascript:change_date('".date("j-n-Y")."');\">Calendar - ".date("n/Y",mktime(0,0,0,$m,1,$y))."</div>
			<svg class=\"line-svg\" viewBox=\"0 0 100 100\">
				<path class=\"line\" d=\"m 0 5 C 3 7 7 2 10 3 C 13 7 26 1 30 5 C 38 6 45 4 60 4 C 63 4 67 6 85 2 C 94 4 97 5 100 3\"></path>
			</svg>
			<a class=\"arrow l\" href=\"?date=0-".date("n-Y",mktime(0,0,0,$m-1,1,$y))."\">&larr;</a>
			<a class=\"arrow r\" href=\"?date=0-".date("n-Y",mktime(0,0,0,$m+1,1,$y))."\">&rarr;</a>
";
$pad=date("w",mktime(0,0,0,$m,1,$y))-1;
$i=0;
foreach (["Mon","Tue","Wed","Thu","Fri","Sat","Sun"] as $nm){
	echo "
			<div class=\"box day ".($i>=5?"weekend":"")."\" style=\"top:68px;left:".($i*100)."px;\">".$nm."</div>
	";
	$i++;
}
$st=date("t",mktime(0,0,0,$m-1,1,$y))-$pad+1;
for ($j=0;$j<$pad;$j++){
	echo "
			<div class=\"box pad rm-top\" style=\"top:95px;left:".($j*100)."px;\" onclick=\"javascript:change_date('".($st+$j).date("-n-Y",mktime(0,0,0,$m-1,1,$y))."');\" ontouchstart=\"javascript:change_date('".($st+$j).date("-n-Y",mktime(0,0,0,$m-1,1,$y))."');\">".($st+$j)."</div>
	";
}
$oy=$y+0;
for ($d=1;$d<=date("t",mktime(0,0,0,$m,1,$y));$d++){
	$x=($d+$pad-1)%7;
	$y=($d+$pad-1-$x)/7+1;
	echo "
			<div class=\"box ".($x>=5?"weekend":"")." ".($y==1?"rm-top":"")." ".($hd==$d?"selected":"")." ".($oy==date("Y")&&$m==date("n")&&$d==date("j")?"today":"")." ".($m==3&&$d==5?"birthsday":"")."\" style=\"top:".($y*100-15+10)."px;left:".($x*100)."px;\" onclick=\"javascript:change_date('".$d.date("-n-Y",mktime(0,0,0,$m,1,$oy))."');\"  ontouchstart=\"javascript:change_date('".$d.date("-n-Y",mktime(0,0,0,$m,1,$oy))."');\">".$d.($hd==$d?"<svg class=\"sel-svg\" viewBox=\"0 0 100 100\"><path class=\"sel\" d=\"M 37 18 C -13 104 98 93 83 53 Q 66 11 25 26\"></path></svg>":"")."</div>
	";
}
$j=$pad+date("t",mktime(0,0,0,$m,1,$y));
$off=$j-1;
while ($j<42){
	$x=$j%7;
	$y=($j-$x)/7+1;
	echo "
			<div class=\"box pad ".($x>=5?"weekend":"")."\" style=\"top:".($y*100-15+10)."px;left:".($x*100)."px;\" onclick=\"javascript:change_date('".($j-$off).date("-n-Y",mktime(0,0,0,$m+1,1,$oy))."');\" ontouchstart=\"javascript:change_date('".($j-$off).date("-n-Y",mktime(0,0,0,$m+1,1,$oy))."');\">".($j-$off)."</div>
	";
	$j++;
}
echo "
		</div>
	</body>
</html>
";
?>
