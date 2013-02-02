<!DOCTYPE html>
<html>
<!--					OFFSET CHECK IN CURSOR CSS if error
-->
<!-- 
<script src="http://code.jquery.com/jquery-latest.js"></script>
-->
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="rotatepic.js"></script>
<script src="cookie.js"></script>
<style type="text/css">
div.val{
	border: 1px solid black;
}
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
/*.n.ne.nw.s.se.sw.e.w{
	cursor: default;
}*/

.end{
	cursor: url(tester.png),auto;
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
//x,y are the co ordinates of mouse from rotate js
dots=[];
num=0;
myWidth = window.innerWidth;
myHeight = window.innerHeight;
lost=0;
myTime=0;
uName="";
ip="";
blurred=0;
json={}

function getip(json){
	ip=json.ip;
}

$(document).ready(function(){
	//check if IE yes do nothing
	browser=1;
	var ua = window.navigator.userAgent
	var msie = ua.indexOf ( "MSIE " )
	if ( msie > 0 ){      // If Internet Explorer, return version number
		browser=parseInt (ua.substring (msie+5, ua.indexOf (".", msie )));

		alert("internet explorer "+browser+" ?\nApologies, this is non-IE compatible game\nUser Any other browser :)\nDefinitely NOT ie");
		$("body").html("").append("<div id='goBack' style='position:fixed;top:"+parseInt((myHeight-180)/2)+"px;left:"+parseInt((myWidth-180)/2)+"px;width:180px;height:180px;background:white;border-radius:50%;font-size:50px;cursor:pointer'><div style='position:relative;top:14px;left:14px;width:150px;height:150px;background:red;border-radius:50%;'> &nbsp <b style='position:relative;top:40px;left:-5px;color:white'>Back</b> &nbsp </div></div>");
		$("#goBack").click(function(){
			window.location="http://paradigm2k12.com";
		});
		return;
		//window.location="http://paradigm2k12.com";
	}
	<?php
		$file = 'leaderBoard.txt';
		$current = file_get_contents($file);
	?>

	json="<?php echo $current?>";
	json=eval("("+json.replace(/\\/g,"")+")");
	//alert(JSON.stringify(json));
	addLeaderBoard(json,0);
	addTwitterFacebook(0);

//	$("body").append($('<div>',{'class':'dot','id':'d1','style':'position:fixed;top:50px;left:50px'}));
	$("body").append("<div style='position:fixed;width:100%;height:100%;z-index:-1'></div><div id='startGame' style='position:fixed;top:"+parseInt((myHeight-180)/2)+"px;left:"+parseInt((myWidth-180)/2)+"px;width:180px;height:180px;background:white;border-radius:50%;font-size:50px;cursor:pointer'><div style='position:relative;top:14px;left:14px;width:150px;height:150px;background:red;border-radius:50%;'> &nbsp <b style='position:relative;top:40px;left:-5px;color:white'>Start</b> &nbsp </div></div>");
	$("#startGame").click(function(){
		$("body").fadeOut(1000,function(){
			$("body").html("").css("display","inline");
			initTime(3);
			setTimeout(function(){startDa();},3000);
		});
	});
	$(document).bind('mousemove',addMyEvent);

	if(getCookie("MouseName")){
		uName=getCookie('MouseName');
		$("body").append("<div id='cookie' style='position:fixed;top:-55px;left:"+parseInt((myWidth-240)/2)+"px;background:white;border-radius:5px;border:2px solid black;opacity:0.8'><center>Change your <b style='color:red'>Name</b><br> &nbsp <input type='text' id='uName'/> &nbsp <br>...</center><img src='nameOut.png' id='nameHandle' style='position:absolute;top:65px;left:90px;cursor:pointer'/></div>");
		//$("nameHandle").css("left",parseInt($("cookie").css("width"))/2-28);
		$("#nameHandle").click(function(){
			if(parseInt($("#cookie").css("top"))==0){
				$("#cookie").animate({top:-(55)+"px"},500);
				$("#cookie").css("cursor","url(ss.png),auto");
				$("#nameHandle").attr("src","nameOut.png");
			}
			else{
				$("#cookie").animate({top:"0px"},500);
				$("#cookie").css("cursor","url(nsmall.png),auto");
				$("#nameHandle").attr("src","nameIn.png");
			}
		});
		document.getElementById('uName').addEventListener("keypress",function(event){
			if(event.keyCode==13){
				uName=document.getElementById("uName").value;
				if(uName.indexOf(")")!=-1 ||uName.indexOf("(")!=-1 ||uName.indexOf('\"')!=-1 ||uName.indexOf("\'")!=-1 ||uName.indexOf("\\")!=-1 ||uName.indexOf(":")!=-1 ||uName.indexOf("{")!=-1 || uName.indexOf("}")!=-1 )
				{
					document.getElementById("uName").value="";
					$("body").append("<div id='spclCharAlert' style='position:fixed;top:-25px;left:"+parseInt((myWidth-240)/2)+"px;background:white;border-radius:5px;border:2px solid black;opacity:0.8'><center> &nbsp No <b style='color:red'>Special Charecters</b> is allowed (except few) &nbsp <br></center></div>")
					$("#spclCharAlert").animate({top:"0px"},500);
					$("#cookie").animate({left:"-=10"},50,function(){
						$(this).animate({left:"+=20px"},50,function(){
							$(this).animate({left:"-=20"},50,function(){
								$(this).animate({left:"+=20"},50,function(){
									$(this).animate({left:"-=10"},50);
								});
							});
						});
					});

				}
				else{
					setCookie("MouseName",uName,300);
					$("#cookie").animate({top:"80px"},500,function(){
						$(this).animate({top:"-100px"},300);
					});
				}
			}
		},false);
	}
	else{
		$("body").append("<div id='cookie' style='position:fixed;top:-60px;left:"+parseInt((myWidth-240)/2)+"px;background:white;border-radius:5px;border:2px solid black;opacity:0.8'><center>Enter Your <b style='color:red'>Name</b><br> &nbsp <input type='text' id='uName'/> &nbsp <br>(press Enter)</center></div>");
		$("#cookie").animate({top:"80px"},500,function(){
			$(this).animate({top:"40px"},500,function(){
				$(this).animate({top:"60px"},500);
			});
		});
		document.getElementById('uName').addEventListener("keypress",function(event){
			if(event.keyCode==13){
				uName=document.getElementById("uName").value;
				if(uName.indexOf(")")!=-1 ||uName.indexOf("(")!=-1 ||uName.indexOf('\"')!=-1 ||uName.indexOf("\'")!=-1 ||uName.indexOf("\\")!=-1 ||uName.indexOf(":")!=-1 ||uName.indexOf("{")!=-1 || uName.indexOf("}")!=-1)
				{
					document.getElementById("uName").value="";
					$("body").append("<div id='spclCharAlert' style='position:fixed;top:-25px;left:"+parseInt((myWidth-240)/2)+"px;background:white;border-radius:5px;border:2px solid black;opacity:0.8'><center> &nbsp No <b style='color:red'>Special Charecters</b> is allowed &nbsp <br></center></div>")
					$("#spclCharAlert").animate({top:"0px"},500);
					$("#cookie").animate({left:"-=10"},50,function(){
						$(this).animate({left:"+=20px"},50,function(){
							$(this).animate({left:"-=20"},50,function(){
								$(this).animate({left:"+=20"},50,function(){
									$(this).animate({left:"-=10"},50);
								});
							});
						});
					});

				}
				else{
					setCookie("MouseName",uName,300);
					$("#cookie").animate({top:"80px"},500,function(){
						$(this).animate({top:"-100px"},300);
					});
				}
			}
		},false);
	}

});

startDa=function(){
	if(uName=="")
		uName="ip: "+ip;	
/*	last_position = {},
    mousemove_ok  = true,
    mouse_timer   = setInterval(function () {
        mousemove_ok = true;
    }, 100),
    x=0,
    y=0;
	$(document).bind('mousemove',addMyEvent);*/
	$("body").html("<div style='position:fixed;width:100%;height:100%;z-index:-1'></div>");
	timeNow=new Date();
	myTime=(((timeNow.getHours()*60 + timeNow.getMinutes())*60 + timeNow.getSeconds())*1000)+timeNow.getMilliseconds();
	//alert(myTime+"\n"+JSON.stringify(timeNow));
	for(i=0;i<1;i++){
		rl=(Math.random()*10000)%myWidth;
		rt=(Math.random()*10000)%myHeight;
		$("body").append("<div class='wdot' style='position:fixed;top:"+rt+"px;left:"+rl+"px' id='d"+i+"'><div class='dot'></div></div>")
		move(1,i,2,2);
		num+=1;
	}

	for(;i<3;i++){
		rl=(Math.random()*10000)%myWidth;
		rt=(Math.random()*10000)%myHeight;
		$("body").append("<div class='wdot' style='position:fixed;top:"+rt+"px;left:"+rl+"px' id='d"+i+"'><div class='dot'></div></div>");
		mover(10,i,1,i);
		num+=1;
	}

	/*for(;i<8;i++){
		rl=(Math.random()*10000)%myWidth;
		rt=(Math.random()*10000)%myHeight;
		$("body").append("<div class='wdot' style='position:fixed;top:"+rt+"px;left:"+rl+"px' id='d"+i+"'><div class='dot'></div></div>");
		mover(10,i,i,1);
		num+=1;
	}*/

	setInterval(function(){
		if(lost==1){return 0;};
		j=num+4
		for(i=num;i<j;i++){
			rl=(Math.random()*10000)%myWidth;
			rt=(Math.random()*10000)%myHeight;
			$("body").append("<div class='wdot' style='position:fixed;top:"+rt+"px;left:"+rl+"px' id='d"+i+"'><div class='dot'></div></div>");
			if(i==j-1){
				disp=parseInt(i/3)>1?parseInt(i/3):2;
				move(10,i,disp,disp);}
			else
				if(i%3==0)
					mover(10,i,4,2*parseInt(i/3));
				else
					mover(10,i,1,i)
			num+=1;
		}
	},7000);

	endGame=function(){
		if(blurred==0){
clearInterval(tresTimer);
				lost=1;
				endTime=new Date();
				myTime=(((endTime.getHours()*60 + endTime.getMinutes())*60 + endTime.getSeconds())*1000)+endTime.getMilliseconds()-myTime;
				myTime=Math.floor(myTime)/1000;				//ajax send the new score
				//edit the present json and show in leaderboard
				//	update the json
				if(myTime>1000)
					myTime%1000;
				if(json.list.length==0)
					json.list.push({name:uName,score:myTime});
				else{
					jsonFlag=0;
					for(k=0;k<json.list.length;k++){
						if(json.list[k].name==uName){
							if(json.list[k].score>myTime){
								//alert(JSON.stringify(json)+"\n"+json.list[k].score+"--"+myTime);
								jsonFlag=1;
							}
							else{
								json.list.splice(k,1);
								//alert(JSON.stringify(json));
							}
							break;
						}
					}
					if(jsonFlag==0){
						for(k=0;k<json.list.length;k++){
							if(json.list[k].score<myTime){
								json.list.splice(k,0,{name:uName,score:myTime});
								break;
							}
						}
					}
				}
				//if(json.list.length>50)
				//	json.list.splice(50,json.list.length-50);
				myAjax(json);

				addLeaderBoard(json,1);
				addTwitterFacebook(1);
				$(document).unbind('mousemove',addMyEvent);
				$("body").removeClass().addClass("end");
				$("body").append("<img src='nw.png' id='lost' style='position:fixed;top:"+(y-10)+"px;left:"+(x-10)+"px;width:30px'/>");
				$("#lost").animate({
					height: 100,
					width: 100,
					top: '-=50px',
					left: '-=50px'
					},2000,function(){
						//callback
					});
				setTimeout('$("#lost").attr("src","nwb1.png");',500);
				setTimeout('$("#lost").attr("src","nwb2.png");',850);
				setTimeout('$("#lost").attr("src","nwb3.png");',950);
				setTimeout('$("#lost").attr("src","nwb4.png");',1050);
				setTimeout('$("#lost").attr("src","nwb5.png");',1150);
				setTimeout('$("#lost").attr("src","nwb6.png");',1250);
				setTimeout('$("#lost").attr("src","nwb7.png");',1350);
				setTimeout('$("#lost").attr("src","nwb8.png");',1450);

				scoreText="oops, you lost";					
				if(myTime<3)
					scoreText="That's all you Got???";
				else if(myTime<9)
					scoreText="You can do better than that";
				else if(myTime<30)
					scoreText="Good try :) but is that your best?";
				else if(myTime>30 && myTime<40)
					scoreText="try try try"
				else if(myTime>50)
					scoreText="OMG :-O Make sure your names's on the LeaderBoard";

				str="<div id='lostMsg' style='position:fixed;top:-40px;left:40%;background:white;border-radius:10px;opacity:0.7;border:3px solid black;'><center> &nbsp "+scoreText+" &nbsp <br> &nbsp <b style='color:red'>Just Click</b> to Play Again &nbsp <br><b>"+(myTime)+"</b> s</center></div>";
				$("body").append(str);
				$("#lostMsg").animate({top:"80px"},500,function(){
					$(this).animate({top:"40px"},500,function(){
						$(this).animate({top:"60px"},500);
					});
				});
				$(document).click(function(){
					lost=0;
					//startDa();
					window.location.reload();
				});
		}
	}

	setInterval(function(){
		if (lost==0) {
			el=document.elementFromPoint(x,y);
			if($(el).is("div .dot")){
				//lost
				endGame();
			}
		}
	},1);

	tresTimer=setInterval(function(){trespass();},1000);

trespass=function(){
		<?php
			if (isset($_GET['q'])){
				if($_GET['q']=="trespass"){
					?>
					endTimeT=new Date();
					myEndTime=(((endTimeT.getHours()*60 + endTimeT.getMinutes())*60 + endTimeT.getSeconds())*1000)+endTimeT.getMilliseconds()-myTime;
					myEndTime=Math.floor(myEndTime)/1000;
					if(myEndTime>30){
						alert("The key is:\n----------------------\nsherlock\n------------------");
						window.location="http://trespass.paradigm2k12.com/play.php";
						clearInterval(tresTimer);
					}
					<?php
				}
			}
		?>
return 0;
}

	window.onblur=function(){blurred=1;}
	window.onfocus=function(){if(blurred==1 && lost==0){blurred=0;endGame()};}
	
}

mover=function(tim,n,xx,yy){
	/*dir=parseInt(Math.random()*10)%4;
	xx=parseInt(Math.random()*100)%5;
	yy=parseInt(Math.random()*100)%5;
	if (dir==0) {xx=-xx};
	dir=parseInt(Math.random()*10)%4;
	if (dir==0) {yy=-yy};
	//alert(dir)*/
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
	if(lost==0)
		setTimeout("mover("+tim+","+n+","+xx+","+yy+")",tim);
}

move=function(tim,n,xdisp,ydisp){
	distX=0;
	distY=0;
//	alert($("#d"+n).css("top"));
	x2=parseInt($("#d"+n).css("left"))+7;
	y2=parseInt($("#d"+n).css("top"))+7	;
	var m=(y-y2)/(x-x2);
	//alert(x2+"--"+y2+"\n"+x+"--"+y+"\n"+m);
	//has to write for m=1 and -1
	if(m==1){
		//
		if(x>x2){
			distX=xdisp;
			distY=ydisp;}
		else{
			distX=-xdisp;
			distY=-ydisp;}
	}
	else if(m==-1){
		//
		if(x>x2){
			distX=xdisp;
			distY=-ydisp;}
		else{
			distX=-xdisp;
			distY=ydisp;}
	}
	else if(m<1 && m>-1){
		//move x
		if(x>x2)
			distX=xdisp
		else
			distX=-xdisp
		//distY=parseInt(m*distX + y2)-y2;
		//alert(distY)
		//alert(x2+"--"+y2+"\n"+x+"--"+y+"\n"+distX+"--"+distY+"\n"+m+"--"+parseInt(m*distX + y2))
	}
	else{
		//move y
		if(y>y2)
			distY=ydisp
		else
			distY=-ydisp
		//distX=(parseInt((distY+m*x2)/m)-x2);
	}
	$("#d"+n).css({
		top:function(index,value){
			return parseInt(value)+distY;		
		},
		left:function(index,value){
			return parseInt(value)+distX;
		}
	});
//	if(tim>50)
//		tim-=10;
	if (lost==0)
		setTimeout("move("+tim+","+n+","+xdisp+","+ydisp+");",tim);
}

$(document).click(function(event){
	//alert(x+","+y+"\n"+$('#d0').css('left')+","+$('#d0').css('top'));
});

addLeaderBoard=function(json,open){
	str="<div id='topScore' style='position:fixed;top:"+parseInt((myHeight-355)/2)+"px;right:-200px;background:white;border-radius:5px;border:2px solid black;opacity:0.8;cursor:url(ws.png),auto;display:none'><img id='scoreHandle' src='topScoreOut.png' style='position:absolute;left:-45px;top:120px;cursor:pointer;'/> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <b style='font-size:20px'>Leader Board</b> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<br><div style='width:100%;background:green'><br><div class='wdot' style='position:relative;left:20px;top:-10px;border:1px solid green'><div class='dot'></div></div><div class='wdot' style='float:left;position:relative;left:110px;top:-25px;border:1px solid green'><div class='dot'></div></div><div class='wdot' style='float:left;position:relative;left:50px;top:-25px;border:1px solid green'><div class='dot'></div></div></div><table border='0' style='position:relative;left:10px'>";
	for(k=0;k<10;k++){
		if(!json.list[k]){
			str+="<tr><td>---</td><td>: ---</td></tr>";
			continue;}
		if(k==0){
			str+="<tr style='color:red;font-weight:bold'><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
			continue;
		}
		if(k==1){
			str+="<tr style='color:green;font-weight:bold'><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
			continue;
		}if(k==2){
			str+="<tr style='color:blue;font-weight:bold'><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
			continue;
		}
		str+="<tr><td>"+json.list[k].score+"</td><td>: "+json.list[k].name+"</td></tr><tr><td></td><td></td></tr>";
	}
	str+="</table> <br><center><a href='scoreBoard.php'>Full ScoreBoard</a></center> </div>"
	$("body").append(str);
	topScoreWidth=parseInt($("#topScore").css('width'))-5;
	$("#topScore").css("right",-(topScoreWidth)+"px").fadeIn("slow");
	$("#topScore").click(function(){
		if(parseInt($("#topScore").css("right"))==0){
			$("#topScore").animate({right:-(topScoreWidth)+"px"},500);
			$("#topScore").css("cursor","url(ws.png),auto");
			$("#scoreHandle").attr("src","topScoreOut.png");
		}
		else{
			$("#topScore").animate({right:"0px"},500);
			$("#topScore").css("cursor","url(es.png),auto");
			$("#scoreHandle").attr("src","topScoreIn.png");
		}
	});
	if(open==1){
		$("#topScore").animate({right:"0px"},1000);
		$("#topScore").css("cursor","url(es.png),auto");
	}	
}
function myAjax(json)
{
var xmlhttp;
var params = 'uName=' + JSON.stringify(json);
/*json=JSON.stringify(json);
json=eval("("+json+")");
alert(json);*/
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    json2=xmlhttp.responseText;
	}
  }
xmlhttp.open("POST","updateBoard.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
   //xmlhttp.setRequestHeader("Content-length", params.length);
    //xmlhttp.setRequestHeader("Connection", "close");
xmlhttp.send(params);
}

addTwitterFacebook=function(tval){
	//250x80
	fb=' &nbsp <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Ftheparadigm2k12&amp;send=false&amp;layout=standard&amp;width=250&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=segoe+ui&amp;height=80&amp;appId=355894807818946" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:80px;" allowTransparency="true"></iframe> &nbsp ';
	$("body").append("<div id='fb' style='position:fixed;top:100px;left:-260px;border:2px solid black;overflow:hidden;background:white;border-radius:5px;opacity:0.8'>"+fb+"</div>");
	if(tval==0)
		tw='<blockquote class="twitter-tweet tw-align-left" width="350"><p>Check out this Awesome mouse Game <a href="https://t.co/9nK1dRLn" title="https://paradigm2k12.com/mouseGame">paradigm2k12.com/mouseGame</a> and relax yourself for the hot and live treasure hunt <a href="http://t.co/tSV6Rl9Y" title="http://trespass.paradigm2k12.com">trespass.paradigm2k12.com</a></p>&mdash; Paradigm (@paradigm2k12) <a href="https://twitter.com/paradigm2k12/status/236872288635592704" data-datetime="2012-08-18T17:08:49+00:00">August 18, 2012</a></blockquote>';
	else
		tw='<iframe allowtransparency="true" frameborder="0" scrolling="no"  src="//platform.twitter.com/widgets/follow_button.html?screen_name=paradigm2k12" style="width:300px; height:20px;"></iframe>'
	$("body").append("<div id='tw' style='position:fixed;top:250px;left:-360px;opacity:0.8'>"+tw+"</div>");
	$("#fb").animate({
		left: '40px'
	},500,function(){
		$("#fb").animate({left:'20px'},500);
		$("#tw").animate({
			left: '40px'
		},500,function(){
			$("#tw").animate({left: '20px'},500);
		});
	});
}

initTime=function(timer){
	$("body").html("").append("<div id='timer' style='font-size:150px;color:black;position:fixed;top:"+(parseInt(myHeight-150)/2-10)+"px;left:"+(parseInt(myWidth-150)/2+30)+"px;'>"+timer+"</div>");
	$("#timer").fadeOut(1000);
	timer-=1;
	if(timer!=0)
		setTimeout(function(){initTime(timer);},1000);
}
</script>
<script src="//platform.twitter.com/widgets.js" id='twScript' charset="utf-8"></script>
<body class="e" style="background:darkgreen;overflow:hidden;background-image: -ms-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);background-image: -moz-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);background-image: -o-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);background-image: -webkit-gradient(radial, center center, 0, center center, 433, color-stop(0, #009900), color-stop(1, #002100));background-image: -webkit-radial-gradient(center, circle farthest-corner, #009900 0%, #002100 100%);">
<div style='position:fixed;width:100%;height:100%;z-index:-1'>
</body>
<script type="application/javascript" src="http://jsonip.appspot.com/?callback=getip"></script>
</html>