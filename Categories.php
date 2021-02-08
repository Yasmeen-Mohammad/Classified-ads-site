<?php 
	session_start();
	include 'init.php';
?>

 
<style>

.bg-gradient {
background: #C9D6FF;
background: -webkit-linear-gradient(to right, #E2E2E2, #C9D6FF); 
background: linear-gradient(to right, #E2E2E2, #C9D6FF);
} 
ul li {
  /*margin-bottom:1.4rem;*/
}
.pricing-divider {
border-radius: 20px;
background: #C64545;
padding: 1em 0 4em;
position: relative;
}
.blue .pricing-divider{
background: #2D5772; 
}
.green .pricing-divider {
background: #1AA85C; 
}
.red b {
  color:#C64545
}
.blue b {
  color:#2D5772
}
.green b {
  color:#1AA85C
}
.pricing-divider-img {
	position: absolute;
	bottom: -2px;
	left: 0;
	width: 100%;
	height: 80px;
}
.deco-layer {
	-webkit-transition: -webkit-transform 0.5s;
	transition: transform 0.5s;
}
.btn-custom  {
  background:#C64545; color:#fff; border-radius:20px
}

.img-float {
  width:50px; position:absolute;top:-3.5rem;right:1rem
}

.princing-item {
  transition: all 150ms ease-out;
}
.princing-item:hover {
  transform: scale(1.05);
}
.princing-item:hover .deco-layer--1 {
  -webkit-transform: translate3d(15px, 0, 0);
  transform: translate3d(15px, 0, 0);
}
.princing-item:hover .deco-layer--2 {
  -webkit-transform: translate3d(-15px, 0, 0);
  transform: translate3d(-15px, 0, 0);
}



</style>

 

<div class="container">
	 <br>
	<div class="row">


		<?php
		  if (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) {
			$category = intval($_GET['pageid']);


			if($_GET['pageid'] == 19){
					 
				$allIEvents = getAllFrom("*", "items", "where Cat_ID = {$category}", "AND Approve = 1 AND AdType = 'Events'", "Item_ID");	
				$allICources = getAllFrom("*", "items", "where Cat_ID = {$category}", "AND Approve = 1 AND AdType = 'Courses'", "Item_ID");
				$allIAnno = getAllFrom("*", "items", "where Cat_ID = {$category}", "AND Approve = 1 AND AdType = 'University Announcements'", "Item_ID");
			
			} else {
				$allItems = getAllFrom("*", "items", "where Cat_ID = {$category}", "AND Approve = 1", "Item_ID");
			}

			
			if($_GET['pageid'] == 20 ){
				echo '<div class="container-fluid">';

					echo '<!-- Carousel container -->';
					echo '<div id="my-pics" class="carousel slide" data-ride="carousel" style="width: 1140px;height: 500px;margin:auto;">';
					
					echo '<!-- Indicators -->';
					echo '<ol class="carousel-indicators">';
					echo '<li data-target="#my-pics" data-slide-to="0" class="active"></li>';
					echo '<li data-target="#my-pics" data-slide-to="1"></li>';
					echo '<li data-target="#my-pics" data-slide-to="2"></li>';
					echo '</ol>';
					
					echo '<!-- Content -->';
					echo '<div class="carousel-inner" role="listbox">';
					
					 
					echo '<!-- Slide 1 -->';
					echo '<div class="item active">';
					echo '<img src="images/100712870_247337573192423_2293608958079795200_n.jpg" class = "image-slide" alt="">';
					echo '</div>';

					echo '<!-- Slide 2 -->';
					echo '<div class="item">';
					echo '<img src="images/84577373_295056858555946_4924401268694188032_n.jpg" class = "image-slide" alt="">';
					echo '</div>';
									
					echo '<!-- Slide 3 -->';
					echo '<div class="item">';
					echo '<img src="images/102952168_659170731302669_4901334942852822885_n.jpg"  class = "image-slide" alt="">';
					echo '</div>';
				 
					echo '</div>';
					
					echo '<!-- Previous/Next controls -->';
					echo '<a class="left carousel-control" href="#my-pics" role="button" data-slide="prev">';
					echo '<span class="icon-prev" aria-hidden="true"></span>';
					echo '<span class="sr-only">Previous</span>';
					echo '</a>';
					echo '<a class="right carousel-control" href="#my-pics" role="button" data-slide="next">';
					echo '<span class="icon-next" aria-hidden="true"></span>';
					echo '<span class="sr-only">Next</span>';
					echo '</a>';
					
					echo '</div>';
					echo '</div>';
			}

			if($_GET['pageid'] == 19){ ?>


		<div class="row m-auto text-center w-75" style = "display: flex;justify-content: center;margin-top: 50px;">
        
        <div class="col-sm-4 princing-item red">
          <div class="pricing-divider ">
              <h3 class="text-light">Events</h3>
           
			<svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
			<path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
			c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
			<path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
			c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
			<path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
			H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
			<path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
			c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
			</svg>
          </div>
          <div class="card-body bg-white mt-0 shadow">
			 <?php 
			 
			 foreach ($allIEvents as $Event) {

				echo '<div class="col-sm-12">';
					echo '<div class="thumbnail item-box" style="border: 0px solid;
					border-bottom: 4px solid #c64545;
					border-radius: 0;">';
						echo '<div class="caption" style ="min-height:105px;text-align: left;">';
							echo '<p><label class = "title-name-label" >Title:&nbsp;</label>
							<a style="font-size:14px" class = "title-name" href="Community.php?itemid='. $Event['Item_ID'] .'">' . $Event['Name'] .'</a>';
							echo '<br><label class = "title-name-label" >Location:&nbsp;</label>' . $Event['location'] . '';
							echo '<br><label class = "title-name-label" >Date:&nbsp;</label>' . date('Y-m-d H:i:s',strtotime($Event['CommunityDate'])) . '</p>';
							 
						echo '</div>';
					echo '</div>';
				echo '</div>';
			 }
			 
			 ?>
          </div>
        </div>
        
        <div class="col-sm-4 princing-item blue">
          <div class="pricing-divider ">
              <h3 class="text-light">Courses</h3>
            
			<svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
			<path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
			c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
			<path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
			c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
			<path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
			H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
			<path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
			c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
			</svg>
          </div>

          <div class="card-body bg-white mt-0 shadow">
		  <?php 
			  	   
			 foreach ($allICources as $Cources) {

				echo '<div class="col-sm-12">';
					echo '<div class="thumbnail item-box" style="border: 0px solid;
					border-bottom: 4px solid #2d5772;
					border-radius: 0;">';
						echo '<div class="caption" style ="min-height:105px;text-align: left;">';
							echo '<p><label class = "title-name-label" >Title:&nbsp;</label>
							<a style="font-size:14px" class = "title-name" href="Community.php?itemid='. $Cources['Item_ID'] .'">' . $Cources['Name'] .'</a>';
							echo '<br><label class = "title-name-label" >Location:&nbsp;</label>' . $Cources['location'] . '';
							echo '<br><label class = "title-name-label" >Date:&nbsp;</label>' . date('Y-m-d H:i:s',strtotime($Cources['CommunityDate'])) . '</p>';
							 
						echo '</div>';
					echo '</div>';
				echo '</div>';
			 }
			 
			 ?>
          </div>
        </div>
         
        <div class="col-sm-4 princing-item green">
          <div class="pricing-divider ">
              <h3 class="text-light">University Announcements</h3>
            
			<svg class='pricing-divider-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
			<path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
			c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
			<path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
			c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
			<path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
			H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
			<path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
			c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
			</svg>
          </div>

          <div class="card-body bg-white mt-0 shadow">
		  <?php 
			 
			 foreach ($allIAnno as $Anno) {

				echo '<div class="col-sm-12">';
					echo '<div class="thumbnail item-box" style="border: 0px solid;
					border-bottom: 4px solid #1aa85c;
					border-radius: 0;">';
						echo '<div class="caption" style ="min-height:105px;text-align: left;">';
							echo '<p><label class = "title-name-label" >Title:&nbsp;</label>
							<a style="font-size:14px" class = "title-name" href="Community.php?itemid='. $Anno['Item_ID'] .'">' . $Anno['Name'] .'</a>';
							echo '<br><label class = "title-name-label" >Location:&nbsp;</label>' . $Anno['location'] . '';
							echo '<br><label class = "title-name-label" >Date:&nbsp;</label>' . date('Y-m-d H:i:s',strtotime($Anno['CommunityDate'])) . '</p>';
							 
						echo '</div>';
					echo '</div>';
				echo '</div>';
			 }
			 
			 ?>

		   </div>
        	</div>       
      		</div>

			<?php 
				echo '<br/>';	
				
			}
			if($_GET['pageid'] != 19){


			foreach ($allItems as $item) {

				if($_GET['pageid'] == 20){

		 
					 
					echo '<br/>';				 
					 
					echo '<div class="col-sm-12">';
					echo '<div class="thumbnail item-box">';
						echo '<div class="caption" style ="text-align:right">';
							echo '<p><a class = "title-name"  href="ApplyJobs.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></h3>';
							echo '<p>' .    $item['Description'] . '</p>';
							echo '<div class="date" style ="text-align:left">' . $item['Add_Date'] . '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				} else if($_GET['pageid'] != 20 && $_GET['pageid'] != 19){


				echo '<div class="col-sm-6 col-md-3">';
					echo '<div class="thumbnail item-box">';
						echo '<span class="price-tag">' . $item['Amount'] . ' JD</span>';
						echo '<img class="img-responsive filter-image"  src="' . $item['Image'] . '" title="' . $item['title_image'] . '" alt="' . $item['Description_image'] . '" />';
						echo '<div class="caption">';
							echo '<p><a class = "title-name" href="items.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></h3>';
							//echo '<p>' . $item['Description'] . '</p>';
							echo '<div class="date">' . $item['Add_Date'] . '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

			}
			}
		}

		} else {
			echo 'You Must Add Page ID';
		}


		function is_arabic($string)
		{
			return (preg_match("/^\p{Arabic}/i", $string) > 0);
		}

		?>
	</div>
</div>

<?php include $tpl . 'footer.php'; ?>

 