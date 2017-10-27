					var ctx=document.getElementById("example").getContext("2d");
						
							ctx.font='30px Arial';			
							
							var WIDTH= 800;
							var HEIGHT=600;
							var timeWhenGameStarted = Date.now();

							var frameCount=0;

							var score=0;

							
							var player ={
								x:50,
								spdX:30,
								y:40,
								spdY:5,
								name:'P',
								hp:10,
								width:20,
								height:20,
								color:'green',
							};
							var enemyList={};
							var upgradeList={};
							var bulletList={};
							
							getDistanceBetweenEntity = function (entity1,entity2){
								var vx = entity1.x - entity2.x;
								var vy = entity1.y - entity2.y;
								return Math.sqrt(vx*vx+vy*vy);
							}
							
							testCollisionEntity = function (entity1,entity2){
								var rect1 = {
									x:entity1.x-entity1.width/2,
									y:entity1.y-entity1.height/2,
									width:entity1.width,
									height:entity1.height,
								}
								var rect2 = {
									x:entity2.x-entity2.width/2,
									y:entity2.y-entity2.height/2,
									width:entity2.width,
									height:entity2.height,
								}
								return testCollisionRectRect(rect1,rect2);
							}
							
							Enemy = function (id,x,y,spdX,spdY,width,height){
								var enemy3 ={
									x:x,
									spdX:spdX,
									y:y,
									spdY:spdY,
									name:'E',
									id:id,
									width:width,
									height:height,
									color:'red',
								};
							enemyList[id] = enemy3;
 
							}
							Upgrade = function (id,x,y,spdX,spdY,width,height){
								var upgrade ={
									x:x,
									spdX:spdX,
									y:y,
									spdY:spdY,
									name:'E',
									id:id,
									width:width,
									height:height,
									color:'orange',
								};
							upgradeList[id] = upgrade;
 
							}
							Bullet = function (id,x,y,spdX,spdY,width,height){
								var upgrade ={
									x:x,
									spdX:spdX,
									y:y,
									spdY:spdY,
									name:'E',
									id:id,
									width:width,
									height:height,
									color:'black',
								};
							bulletList[id] = upgrade;
 
							}
							
							randomlyGenerateBullet =function(){
								var x=player.x;
								var y=player.y;
								var height=10;
								var width=10;
								var id=Math.random()*WIDTH;
								
								var angle= Math.random()*360;
								var spdX=Math.cos(angle/180*Math.PI)*5;
								var spdY=Math.sin(angle/180*Math.PI)*5;
								Bullet(id,x,y,spdX,spdY,width,height);
							}
							document.onmousemove = function(mouse){
								var mouseX = mouse.clientX;
								var mouseY = mouse.clientY;
          
									console.log('X= '+mouseX);
									console.log('Y= '+mouseY);
								//if mouse 
								if(mouseX < player.width/2)
									mouseX=player.width/2;
								if(mouseX> WIDTH-player.width/2)
									mouseX= WIDTH-player.width/2;
								if(mouseY<player.height/2)
									mouseY=player.height/2;
								if(mouseY>HEIGHT-player.height/2)
									mouseY=HEIGHT-player.height/2;
							
								player.x = mouseX;
								player.y = mouseY;
							}
													
							updateEntity = function (something){
								updateEntityPosition(something);
								drawEntity(something);
							}
							
							updateEntityPosition = function(something){
								something.x+=something.spdX;
								something.y+=something.spdY;
								
								if(something.x<0 || something.x>WIDTH)
								{
									something.spdX = -something.spdX;
								}
								if(something.y<0 || something.y>HEIGHT)
								{
									something.spdY = -something.spdY;
								}
							}
							
							testCollisionRectRect = function(rect1,rect2){
								return rect1.x <= rect2.x+rect2.width
									&& rect2.x <= rect1.x+rect1.width
									&& rect1.y <= rect2.y+rect2.height
									&& rect2.y <= rect1.y+rect1.height;
							}
							
							drawEntity = function(something){	// 2 sposob na zielnoe HP 
								ctx.save();
								ctx.fillStyle = something.color;
								ctx.fillRect(something.x-something.width/2,something.y-something.height/2,something.width,something.height);
								//ctx.fillStyle ='black';
								ctx.restore();
							}
							update = function (){
								ctx.clearRect(0,0,WIDTH,HEIGHT);
								
								frameCount++;
								score++;
								
								//spawn nowego przeciwnika co 4 sekundy
								if(frameCount%100===0)
									randomlyGenerateEnemy();

								if(frameCount%75===0)
									randomlyGenerateUpgrade();
								
								
								if(frameCount%25===0)
									randomlyGenerateBullet();

								for(var key in bulletList)
									{
										 updateEntity(bulletList[key]);
									}
								for(var key in upgradeList)
									{
										 updateEntity(upgradeList[key]);
										  var isColliding = testCollisionEntity(player,upgradeList[key]);
									   if(isColliding)
									     { 
												 score+=100;
												 delete upgradeList[key];
									     }
									}
								for(var key in enemyList)
								{
									updateEntity(enemyList[key]);
									
									var isColliding = testCollisionEntity(player,enemyList[key]);
									if(isColliding)
									{
										player.hp= player.hp-1;
									
									}
								}
									if(player.hp <=0)
										{
											var timeSurvived = Date.now() - timeWhenGameStarted;
											console.log("Przegrałeś! Udało Ci się przetrwać "+timeSurvived);
											
											startNewGame();
											//clear enemy 
										}
								drawEntity(player);
								ctx.fillText(player.hp + " Hp",0,30);
								ctx.fillText('Score: '+score, 600,30);
							}
							startNewGame =function(){
										player.hp=10;
										timeWhenGameStarted = Date.now();
										frameCount=0;
							     	enemyList={};
								    score=0;
								    upgradeList={};
								
							randomlyGenerateEnemy();
							randomlyGenerateEnemy();
							randomlyGenerateEnemy();
							}
							randomlyGenerateEnemy =function(){
								var x= Math.random()*WIDTH;
								var y=Math.random()*HEIGHT;
								var height=10 + Math.random()*30; //pomiedzy 10 a 40
								var width=10 + Math.random()*30; //pomiedzy 10 a 40
								var id=Math.random()*WIDTH;
								var spdX=5+ Math.random()*5;
								var spdY=5+ Math.random()*5;
								Enemy(id,x,y,spdX,spdY,width,height);
							}
							
							randomlyGenerateUpgrade =function(){
								var x= Math.random()*WIDTH;
								var y=Math.random()*HEIGHT;
								var height=10;
								var width=10;
								var id=Math.random()*WIDTH;
								var spdX=0;
								var spdY=0;
								Upgrade(id,x,y,spdX,spdY,width,height);
							}
						
							startNewGame();
							//wykonaj metode update co 500 ms
							setInterval(update,40);

