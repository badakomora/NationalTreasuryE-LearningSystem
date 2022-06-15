<script>

        function doFirst(){
            barSize=600;
            myMovie=document.getElementById('myMovie<?php echo $_SESSION['user_id'];?>');
            playButton=document.getElementById('playButton');
            bar=document.getElementById('defaultBar');
            progressBar=document.getElementById('progressBar');
        
            playButton.addEventListener('click', playOrPause, false);
            bar.addEventListener('click', clickedBar, false);
        }

        function playOrPause() {
            if (!myMovie.paused && !myMovie.ended){
                myMovie.pause();
                playButton.innerHTML='Play';
                window.clearInterval(updateBar);
            } else {
                myMovie.play();
                playButton.innerHTML='Pause';
                updateBar=setInterval(update, 500);
            }
        }

        function update() {
            if (!myMovie.ended) {
                var size=parseInt(myMovie.currentTime*barSize/myMovie.duration);
                progressBar.style.width=size+'px';
            } else {
                progressBar.style.width='0px';
                playButton.innerHTML='Play';
                window.clearInterval(updateBar);
            }
        }

        function clickedBar(e){
            if(!myMovie.paused && !myMovie.ended){
                var mouseX=e.pageX-bar.offsetLeft;
                var newtime=mouseX*myMovie.duration/barSize;
                myMovie.currentTime=newtime;
                progressBar.style.width=mouseX+'px';
            }
        }
        window.addEventListener('load',doFirst,false);



        localStorage.setItem('user_id', '<?php echo $_SESSION['user_id'];?>');  

        if ("user_id" in localStorage) {

                let video = document.getElementById("myMovie<?php echo $_SESSION['user_id'];?>");

                if (localStorage.hasOwnProperty("time")) { //if time was set before adjust the video to it
                video.currentTime = localStorage.getItem("time");
                }
                
                let timer = setInterval(getTimestamp,1000);

                function getTimestamp(){
                localStorage.setItem("time", video.currentTime);
                console.log(localStorage.getItem("time"));
                }
 
            } else {
                alert('no');
            }




                
  


    </script>







<style>
section,footer,aside,nav,article,hgroup {
	display: block;
}
#skin {
	width:700px;
	margin:10px auto;
	padding:5px;
	background:black;
	border:4px solid black;
	border-radius:10px;
}
nav {
	margin: 5px 0px;
}
#buttons {
	float:left;
	width:70px;
	height:22px;
}
#defaultBar {
	position:relative;
	float:left;
	width:600px;
	height:16px;
	padding:4px;
	border: 2px solid black;
	background:#1D2231;
}
#progressBar {
	position:absolute;
	width:0px;
	height:16px;
	background:#8390A2;
}
</style>