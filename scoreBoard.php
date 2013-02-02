<!DOCTYPE html>
<html>
<script src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="rotatepic.js"></script>
<style type="text/css">
div.dot{
	position: relative;
	top: 2px;
	left: 2px;
	width: 10px;
	height: 10px;
	border-radius: 50%;
	background: red;
}
div.wdot{
	width: 14px;
	height: 14px;
	border-radius: 50px;
	background: white;
	//border: 1px solid red;
}
.n{
	cursor: url(nsmall.png) 5 8,auto;
}
.ne{
	cursor: url(nes.png) 8 5,auto;
}
.nw{
	cursor: url(nws.png) 5 6,url(n.ico),auto;
}
.s{
	cursor: url(ss.png) 7 10,url(n.ico),auto;
}
.se{
	cursor: url(ses.png) 10 10,url(n.ico),auto;
}
.sw{
	cursor: url(sws.png) 7 7,url(n.ico),auto;
}
.e{
	cursor: url(es.png) 10 5,url(n.ico),auto;
}
.w{
	cursor: url(ws.png) 10 5,url(n.ico),auto;
}
</style>
<script type="text/javascript">

myWidth = window.innerWidth;
myHeight = window.innerHeight;
<?php
$file = 'leaderBoard.txt';
$current = file_get_contents($file);
?>

//json={list:[{name:'testeropipip',score:10.23},{name:'tester',score:1.34},{name:'teshhhhhhhhhhter',score:0.3},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0},{name:'tester',score:0}]}

window.onload=function(){
	$(document).bind('mousemove',addMyEvent);
	json='<?php echo $current?>'
	json=eval('('+json.replace(/\\/g,"")+')');
	if(!json.list)
		return;
	str="<center><div style='background:white;border-radius:25px;border:2px solid black;opacity:0.8;font-weight:bold;font-size:45px'>Score Board<br></div><br><br><div id='scores' style='position:absolute;left:"+parseInt((myWidth-385)/2)+"px;background:white;border-radius:25px;border:2px solid black;opacity:0.8;z-index:2'><table border='0' style='position:relative;padding:20px;font-size:25px'>";
	for(k=0;k<json.list.length;k++){
		if(!json.list[k]){
			str+="<tr><td>"+(k+1)+". &nbsp</td><td>---</td><td>: ---</td></tr>";
			continue;}
		if(k==0){
			str+="<tr style='color:red;font-weight:bold'><td>"+(k+1)+". &nbsp</td><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
			continue;
		}
		if(k==1){
			str+="<tr style='color:green;font-weight:bold'><td>"+(k+1)+". &nbsp</td><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
			continue;
		}if(k==2){
			str+="<tr style='color:blue;font-weight:bold'><td>"+(k+1)+". &nbsp</td><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
			continue;
		}
		str+="<tr><td>"+(k+1)+". &nbsp</td><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
	}
	str+="</table>...</div></center><div class='startGame' style='position:fixed;top:"+parseInt(myHeight-180)/2+"px;left:10px;width:180px;height:180px;background:white;border-radius:50%;font-size:50px;cursor:pointer;z-index:0'><div style='position:relative;top:14px;left:14px;width:150px;height:150px;background:red;border-radius:50%;'> &nbsp <b style='position:relative;top:40px;left:-5px;color:white'>Start</b> &nbsp </div></div><div class='startGame' style='position:fixed;top:"+parseInt(myHeight-180)/2+"px;right:10px;width:180px;height:180px;background:white;border-radius:50%;font-size:50px;cursor:pointer;z-index:0'><div style='position:relative;top:14px;left:14px;width:150px;height:150px;background:red;border-radius:50%;'> &nbsp <b style='position:relative;top:40px;left:-5px;color:white'>game</b> &nbsp </div></div>";
	$("body").append(str);
	$(".startGame").click(function(event){
			window.location="index.php"
	});

	addBugs();
}

addBugs=function(){
	for(i=0;i<9;i++){
		rl=(Math.random()*10000)%myWidth;
		rt=(Math.random()*10000)%myHeight;
		$("body").append("<div class='wdot' style='position:fixed;z-index:-1;top:"+rt+"px;left:"+rl+"px' id='d"+i+"'><div class='dot'></div></div>");
		if(i<3)
			mover(10,i,1,i*2);
		else if(i<6)
			mover(10,i,i*2,1);
		else
			mover(10,i,i*2,i*2);
	}
}

mover=function(tim,n,xx,yy){
	presX=parseInt(document.getElementById("d"+n).style.left);
	presY=parseInt(document.getElementById("d"+n).style.top);
	if(presX>myWidth || presX<0){xx=-xx};
	if(presY>myHeight || presY<0){yy=-yy};
	$("#d"+n).css({
		left: function(index,value){
			return parseInt(value)+xx;
		},
		top: function(index,value){
			return parseInt(value)+yy;
		}
	});
	setTimeout("mover("+tim+","+n+","+xx+","+yy+")",tim);
}

</script>
<body style="background:green;background-image: -ms-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);background-image: -moz-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);background-image: -o-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);background-image: -webkit-gradient(radial, center center, 0, center center, 433, color-stop(0, #009900), color-stop(1, #002100));background-image: -webkit-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);">
	<div style="position:fixed;width:100%;height:100%;z-index:-2;"></div>
</body>
</html>