<?php
	ob_start();
	session_start();
	$pageTitle = 'Profile';
	include 'init.php';
	if (isset($_SESSION['user'])) {
		$getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
		$getUser->execute(array($_SESSION['user']));
		$info = $getUser->fetch();
		$userid =  $info['UserID'] ;
?>

<style>
body {
  font-family: "Nunito", sans-serif;
  font-weight: 100;
  color: #0e0e0e;
}
.content {
  max-width: 90%;
  margin: 50px auto;
}
table {
  width: 100%;
  border-collapse: collapse;
}
thead {
  text-transform: uppercase;
  border-bottom: 1px solid #0e0e0e;
  th {
    padding: 5px;
    text-align: left;
  }
}
tr {
  transition: opacity 0.5s ease;
  &.hide {
    opacity: 0;
    height: 0;
  }
}
td {
  padding: 5px;
  border-bottom: 1px solid #d6d6d6;
}
tr:hover td {
  background: #e6e6e6;
}
#text-search {
  max-width: 240px;
  display: block;
  width: 100%;
  height: 44px;
  padding: 0 10px;
  margin: 0;
  border: 1px solid #cccccc;
  outline: none;
  color: #5f6a7d;
  font: 13px;
  font-family: "Nunito", sans-serif;
  font-weight: 100;
  margin-bottom: 15px;
  float: right;
}

.main-table > thead > tr:first-child td {
    background-color: #333 !important;
	color: #FFF !important;
	text-transform:none !important;
}
.img-responsive.filter-image {
    height: 200px !important;
    width: auto;
    min-width: 253px;
    max-width: 252px;
    min-height: 261px;
}

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
 
<div class="information block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Information</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<li>
						<i class="fa fa-unlock-alt fa-fw"></i>
						<span>Login Name</span> : <?php echo $info['UserID'] ?>
					</li>
					<li>
						<i class="fa fa-envelope-o fa-fw"></i>
						<span>Email</span> : <?php echo $info['Email'] ?>
					</li>
					<!--<li>
						<i class="fa fa-user fa-fw"></i>
						<span>Full Name</span> : <?php echo $info['FullName'] ?>
					</li>-->
					<li>
						<i class="fa fa-calendar fa-fw"></i>
						<span>Registered Date</span> : <?php echo $info['Date'] ?>
					</li>
					<!--<li>
						<i class="fa fa-tags fa-fw"></i>
						<span>Fav Category</span> :
					</li> -->
				</ul>
				<!--<a href="#" class="btn btn-default">Edit Information</a>-->
			</div>
		</div>
	</div>
</div>

<div id="my-ads" class="my-ads block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Items</div>
			<div class="panel-body">
			<?php
				$myItems = getAllFrom("*", "items", "where Member_ID = $userid", "", "Item_ID");
				if (! empty($myItems)) {
					echo '<div class="row">';
					foreach ($myItems as $item) {
						echo '<div class="col-sm-6 col-md-3">';
							echo '<div class="thumbnail item-box">';
								if ($item['Approve'] == 0) { 
									echo '<span class="approve-status">Waiting Approval</span>'; 
								}
								echo '<span class="price-tag">' . $item['Amount'] . ' JD</span>';
								echo '<img class="img-responsive filter-image"  src="' . $item['Image'] . '" alt="" />';
								echo '<div class="caption">';
									echo '<p><a class = "title-name" href="items.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></p>';
									//echo '<p>' . $item['Description'] . '</p>';
									echo '<div class="date">' . $item['Add_Date'] . '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				} else {
					echo 'Sorry There\' No Ads To Show, Create <a href="newad.php">New Ad</a>';
				}
			?>
			</div>
		</div>
	</div>
</div>


<div id="my-ads1" >
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Favourites (Buy & Sell)</div>
			<div class="panel-body">
			<?php
				$myBuyAndSell = getAllFrom("items.*, 
				Favourite", "items 
				right JOIN favourite 
				on items.Item_ID = favourite.ItemID", "where UserID = $userid"
				, " AND CAT_ID NOT IN(18,19,20) AND Favourite=1", "Item_ID");
				
				if (!empty($myBuyAndSell)) {
					echo '<div class="row">';
					foreach ($myBuyAndSell as $item) {
						echo '<div class="col-sm-6 col-md-3">';
							echo '<div class="thumbnail item-box">';
								 
								echo '<span class="price-tag">' . $item['Amount'] . ' JD</span>';
								echo '<img class="img-responsive filter-image"  src="' . $item['Image'] . '" alt="" />';
								echo '<div class="caption">';
									echo '<p><a class = "title-name" href="items.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></p>';
									//echo '<p>' . $item['Description'] . '</p>';
									echo '<div class="date">' . $item['Add_Date'] . '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				} else {
					//echo 'Sorry There\' No Ads To Show, Create <a href="newad.php">New Ad</a>';
					echo 'No Data Found';
				}
			?>
		</div>
		</div>
	</div>
</div>


<div id="my-ads2" >
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Favourites (Community)</div>
			<div class="panel-body">

		<div class="row m-auto text-center w-75" style = "display: flex;justify-content: center;margin-top: 50px;">
        
		<div class="col-sm-4 princing-item red">
			<div class="pricing-divider">
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
			$allIEvents = getAllFrom("items.*, 
			Favourite", "items 
			right JOIN favourite 
			on items.Item_ID = favourite.ItemID", "where UserID = $userid"
			, " AND CAT_ID IN(19) AND AdType = 'Events' AND Favourite=1", "Item_ID");
			
			if (!empty($allIEvents)) {
				echo '<div class="row">';
				foreach ($allIEvents as $item) {
					echo '<div class="col-sm-12">';
					echo '<div class="thumbnail item-box" style="border: 0px solid;
					border-bottom: 4px solid #1aa85c;
					border-radius: 0;">';
						echo '<div class="caption" style ="min-height:105px;text-align: left;">';
							echo '<p><label class = "title-name-label" >Title:&nbsp;</label>
							<a style="font-size:14px" class = "title-name" href="Community.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a>';
							echo '<br><label class = "title-name-label" >Location:&nbsp;</label>' . $item['location'] . '';
							echo '<br><label class = "title-name-label" >Date:&nbsp;</label>' . date('Y-m-d H:i:s',strtotime($item['CommunityDate'])) . '</p>';
							
						echo '</div>';
					echo '</div>';
				echo '</div>';
				}
				echo '</div>';
			} else {
				//echo 'Sorry There\' No Ads To Show, Create <a href="newad.php">New Ad</a>';
				echo 'No Data Found';
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
			$allICources = getAllFrom("items.*, 
			Favourite", "items 
			right JOIN favourite 
			on items.Item_ID = favourite.ItemID", "where UserID = $userid"
			, " AND CAT_ID IN(19) AND AdType = 'Courses' AND Favourite=1", "Item_ID");
			
			if (!empty($allICources)) {
				echo '<div class="row">';
				foreach ($allICources as $item) {
					echo '<div class="col-sm-12">';
					echo '<div class="thumbnail item-box" style="border: 0px solid;
					border-bottom: 4px solid #1aa85c;
					border-radius: 0;">';
						echo '<div class="caption" style ="min-height:105px;text-align: left;">';
							echo '<p><label class = "title-name-label" >Title:&nbsp;</label>
							<a style="font-size:14px" class = "title-name" href="Community.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a>';
							echo '<br><label class = "title-name-label" >Location:&nbsp;</label>' . $item['location'] . '';
							echo '<br><label class = "title-name-label" >Date:&nbsp;</label>' . date('Y-m-d H:i:s',strtotime($item['CommunityDate'])) . '</p>';
							
						echo '</div>';
					echo '</div>';
					echo '</div>';				
				}
				echo '</div>';
			} else {
				//echo 'Sorry There\' No Ads To Show, Create <a href="newad.php">New Ad</a>';
				echo 'No Data Found';
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
			$allIAnno = getAllFrom("items.*, 
			Favourite", "items 
			right JOIN favourite 
			on items.Item_ID = favourite.ItemID", "where UserID = $userid"
			, " AND CAT_ID IN(19) AND AdType = 'University Announcements' AND Favourite = 1", "Item_ID");
			
			if (!empty($allIAnno)) {
				echo '<div class="row">';
				foreach ($allIAnno as $item) {
					echo '<div class="col-sm-12">';
					echo '<div class="thumbnail item-box" style="border: 0px solid;
					border-bottom: 4px solid #1aa85c;
					border-radius: 0;">';
						echo '<div class="caption" style ="min-height:105px;text-align: left;">';
							echo '<p><label class = "title-name-label" >Title:&nbsp;</label>
							<a style="font-size:14px" class = "title-name" href="Community.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a>';
							echo '<br><label class = "title-name-label" >Location:&nbsp;</label>' . $item['location'] . '';
							echo '<br><label class = "title-name-label" >Date:&nbsp;</label>' . date('Y-m-d H:i:s',strtotime($item['CommunityDate'])) . '</p>';
							
						echo '</div>';
					echo '</div>';
				echo '</div>';
				}
				echo '</div>';
			} else {
				//echo 'Sorry There\' No Ads To Show, Create <a href="newad.php">New Ad</a>';
				echo 'No Data Found';
			}
		?>
		</div>
		</div>

		</div>
 
		 
			</div>
		</div>
	</div>
</div>

<div id="my-ads3" >
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">My Favourites (Jobs)</div>
			<div class="panel-body">
			<?php
				$myBuyAndSell = getAllFrom("items.*, 
				Favourite", "items 
				right JOIN favourite 
				on items.Item_ID = favourite.ItemID", "where UserID = $userid"
				, " AND CAT_ID IN(20)", "Item_ID");
				
				if (!empty($myBuyAndSell)) {
					echo '<div class="row">';
					foreach ($myBuyAndSell as $item) {
						echo '<div class="col-sm-12">';
						echo '<div class="thumbnail item-box">';
							echo '<div class="caption" style ="text-align:right">';
								echo '<p><a class = "title-name"  href="ApplyJobs.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></h3>';
								echo '<p>' .    $item['Description'] . '</p>';
								echo '<div class="date" style ="text-align:left">' . $item['Add_Date'] . '</div>';
							echo '</div>';
						echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				} else {
					echo 'No Data Found';
				}
			?>

			

			</div>
		</div>
	</div>
</div>



<div class="my-comments block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">Latest Comments</div>
			<div class="panel-body">
			<?php
				$myComments = getAllFrom("comment", "comments", "where user_id = $userid", "", "c_id");
				if (! empty($myComments)) {
					foreach ($myComments as $comment) {
						echo '<p>' . $comment['comment'] . '</p>';
					}
				} else {
					echo 'There\'s No Comments to Show';
				}
			?>
			</div>
		</div>
	</div>
</div>

<div class="my-resume block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">Latest Resume</div>
			<div class="panel-body">
			<?php
				$myresume = getAllFrom("*", "jobs", "where UserID = $userid", "", "ID");
				if (! empty($myresume)) {
					echo '<div class="table-responsive">';
					echo '<table class="main-table text-center table table-bordered">';
					echo '<thead>';
					echo '<tr>';
					echo '<td title="ID">ID</td>';
					echo '<td title="Full Name">Full Name</td>';
					echo '<td title="Email Address">Email Address</td>';
					echo '<td title="Resume File">Resume File</td>';
					echo '</tr>';
					echo '</thead>';
					echo '<tbody>';

					foreach ($myresume as $resume) {

					
						echo '<tr>';
						echo '<td>'.$resume['ID'].'</td>';
						echo '<td>'.$resume['FullName'].'</td>';
						echo '<td>'.$resume['Email'].'</td>';
						echo '<td><a href="'.$resume['File'].'" dwonload> Download </a></td>';
						echo '</tr>';
					}
					echo '</tbody>';
					echo '</table>';
					echo '</div>';
				} else {
					echo 'There\'s No Resume to Show';
				}
			?>
			</div>
		</div>
	</div>
</div>
<?php
	} else {
		header('Location: login.php');
		exit();
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>