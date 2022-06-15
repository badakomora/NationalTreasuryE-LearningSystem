<?php require_once("header.php");?>
<main>





    <article class="video-sec-wrap">
			<div class="video-sec">
                <h3><?php 
                if(isset($_GET['course']) && $_GET['course'] != ''){
                $_GET['course'];
            }
            echo "Welcome to ".$_GET['course'];?></h3>
            <p><b>Lessons</b></p>
				<ul class="video-sec-middle" id="vid-grid">
                <?php 
                        $lessons = mysqli_query($con, "SELECT lessons.id as lii, lessons.lesson_title, lessons.lesson_post, lessons.course_id, courses.id as cid, courses.course
                        FROM lessons
                        INNER JOIN courses on courses.id = lessons.course_id where lessons.course_id = '".$_GET['id']."'");
                        $no = 1;
                        if(mysqli_num_rows($lessons) >= 1){
                        while($row = mysqli_fetch_array($lessons)){
                 ?>
                    <li class="thumb-wrap" style="position: relative;">
                    
                        <div class="thumb-info">
                        <p class="thumb-user show-read-more"><?php echo $row['lesson_title'];?></p>
                        <p>
                        <?php 
                                $lessonsNO = mysqli_query($con, "SELECT count(*) as count 
                                FROM assignments 
                                INNER JOIN lessons ON lessons.id = assignments.lesson_id
                                WHERE assignments.lesson_id ='".$row['lii']."'");
                                while($row2 = mysqli_fetch_array($lessonsNO)){
                                    echo $row2['count'];
                                }
                        ?> 
                        Questions
                        </p>
                        <a href="./?q=ViewQuestions&id=<?php echo $row['lii']?>"> view questions <i class="fa fa-arrow-right"></i></p></a>
                                     <!-- text length -->
                                      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                      <script>
                                      $(document).ready(function(){
                                          var maxLength = 35;
                                          $(".show-read-more").each(function(){
                                              var myStr = $(this).text();
                                              if($.trim(myStr).length > maxLength){
                                                  var newStr = myStr.substring(0, maxLength);
                                                  var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                                                  $(this).empty().html(newStr);
                                                  $(this).append(' <a href="javascript:void(0);" class="read-more">...</a>');
                                                  $(this).append('<span class="more-text">' + removedStr + '</span>');
                                              }
                                          });
                                          $(".read-more").click(function(){
                                              $(this).siblings(".more-text").contents().unwrap();
                                              $(this).remove();
                                          });
                                      });
                                      </script>
                                      <style>
                                      .show-read-more .more-text{
                                              display: none;
                                          }
                                      </style>
                      </div>
					    
                    </li>
                    <?php $no++; }}else{?>
        <div style="display:flex; justify-content:center;"><h5 style="color:red;">There are no lessons added to this course for assignment review!</h5></div>
        <?php }?>
				</ul>
				<a class="video-showmore">Show more</a>
			</div>
		</article>


















<style>

.video-sec-wrap {
	width: 100%;
	min-height: 100vh;
}
.video-sec {
	width: 85%;
	margin: 3em auto;
	border-bottom: 2px solid #353535;
	text-align: left;
}
.video-sec-middle {
	grid-template-columns: repeat(5,1fr);
	display: grid;
	justify-content: center;
	align-content: center;
	grid-template-rows: auto;
	grid-row-gap: 15px;
	grid-column-gap: 10px;
	padding: 20px 0;
}
.thumb-wrap {
	display: inline;
	cursor: pointer;
}
.thumb {
  padding: 10px;
  background-color: white;
	display: block;
	margin: .4em;
	width: 100%;
	box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
	opacity: 1;
	transition: all .2s ease-in-out;
}
.thumb:hover {
	opacity: .8;
	box-shadow: 0 5px 10px 0 rgba(0, 0, 0, .5);
}
.thumb-info {
	display: inline-block;
	height: 100%;
	width: 100%;
	padding: .4em;
}
.thumb-title {
	color: #f5f5f5;
	margin: 0;
	font-size: 1.2em;
}
.thumb-user {
	color: #7e7e7e;
	display: block;
	margin: 0;
	font-size: .9em;
}
.thumb-text {
	color: #7e7e7e;
	display: inline-block;
	margin: 0;
	font-size: .8em;
}
.video-sec-title {
	font-weight: bolder;
	font-size: 1.4em;
	color: #f5f5f5;
	margin: 5px 0 10px 10px;
}
.video-showmore {
	font-weight: bold;
	font-variant: all-petite-caps;
	display: block;
	color: #7e7e7e;
	padding: 10px;
	font-size: 1.2em;
}
@media only screen and (max-width: 1456px) {
	.video-sec-middle {
		grid-template-columns: repeat(4,1fr);
	}
}
@media only screen and (max-width: 1024px) {
	.video-sec-middle {
	  grid-template-columns: repeat(3,1fr);
	}
}
@media only screen and (max-width: 756px) {
  .video-sec-middle {
   grid-template-columns: repeat(2,1fr);
  }
}
@media only screen and (max-width: 496px) {
  .video-sec-middle {
   grid-template-columns: repeat(1,1fr);
  }
}
        </style>
        <script>
            var thumbTitle = $(".thumb-title");
for (var i = 0; i<= thumbTitle.length; i++){
    if(thumbTitle[i].innerHTML.length > 50){
        var shortendTitle =thumbTitle[i].innerHTML.slice(0, 50);
        thumbTitle[i].innerHTML = shortendTitle.concat("...");
    }
}
        </script>
</main>
