<?php
	ob_start();
	session_start();
	$pageTitle = 'Show Items';
	include 'init.php';

	// Check If Get Request item Is Numeric & Get Its Integer Value
	$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

	// Select All Data Depend On This ID
	$stmt = $con->prepare("SELECT 
								items.*, 
								categories.Name AS category_name, 
								users.Username  
							FROM 
								items
							INNER JOIN 
								categories 
							ON 
								categories.ID = items.Cat_ID 
							INNER JOIN 
								users 
							ON 
								users.UserID = items.Member_ID 
							  
							WHERE 
								Item_ID = ?
							AND 
								Approve = 1");

	// Execute Query
	$stmt->execute(array($itemid));

	$count = $stmt->rowCount();

	if ($count > 0) {


	// Fetch The Data
	$item = $stmt->fetch();
	if (isset($_SESSION['user'])) { 
	$stmtFavourite = $con->prepare("SELECT COUNT(Favourite) AS Favourite  FROM  favourite 
	WHERE  ItemID = ? AND UserID = ?  AND Favourite = 1 ");

		// Execute Query
		$stmtFavourite->execute(array($itemid , $_SESSION['uid']));

	// Fetch The Data
	$Favourite = $stmtFavourite->fetch();
	}
?>
<br><br>

<input type = "hidden" id= "itemid" value ="<?php echo $itemid; ?>" />
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail center-block" src=<?php echo $item['Image'] ?> alt="" />
		</div>
		<div class="col-md-9 item-info">
			<h2><?php echo $item['Name'] ?></h2>
			<p><?php echo $item['Description'] ?></p>
			<ul class="list-unstyled">
				<li>
					<i class="fa fa-calendar fa-fw"></i>
					<span>Added Date</span> : <?php echo $item['Add_Date'] ?>
				</li>
				<li>
					<i class="fa fa-money-bill fa-fw"></i>
					<span>Price</span> : <?php echo $item['Amount'] ?>
				</li>
				<!-- <li>
					<i class="fa fa-building fa-fw"></i>
					<span>Made In</span> : <?php echo $item['location'] ?>
				</li> -->
				 <li>
					<i class="fa fa-tags fa-fw"></i>
					<span>Category</span> : <a href="Categories.php?pageid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['category_name'] ?></a>
				</li> 
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span>Added By</span> : <?php echo $item['Username'] ?>
				</li>
				<li>
					<i class="fa fa-envelope fa-fw"></i>
					<span>Email</span> : <?php echo $item['Email'] ?>
				</li>
				<li class="tags-items">
					<i class="fa fa-tags fa-fw"></i>
					<span>Tags</span> : 
					<?php 
						$allTags = explode(",", $item['tags']);
						foreach ($allTags as $tag) {
							$tag = str_replace(' ', '', $tag);
							$lowertag = strtolower($tag);
							if (! empty($tag)) {
								echo "<a href='tags.php?name={$lowertag}'>" . $tag . '</a>';
							}
						}
					?>
				</li>

			 
			</ul>

			<?php if (isset($_SESSION['user'])) { ?>
				 
				<input type="checkbox" name="favourite" id="favourite" <?php if($Favourite['Favourite']) echo 'checked ' ?>onChange="Changefavourite()">
			
				<label for="favourite">
					<span class="fa">
						<i class="fa-star-o"></i>
						<i class="fa-star"></i>
						<i class="fa-star fx"></i>
					</span>
					<span class="do">Favourite</span>
					<span class="done">Favourited</span>
				</label>

			<?php } ?>
		</div>
	</div>
	<hr class="custom-hr">
	<?php if (isset($_SESSION['user'])) { ?>
	<!-- Start Add Comment -->
	<div class="row">
		<div class="col-md-offset-3">
			<div class="add-comment">
				<h3>Add Your Comment</h3>
				<form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['Item_ID'] ?>" method="POST">
					<textarea name="comment" required></textarea>
					<input class="btn btn-primary" type="submit" value="Add Comment">
				</form>
				<?php 
					if ($_SERVER['REQUEST_METHOD'] == 'POST') {

						$comment 	= filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
						$itemid 	= $item['Item_ID'];
						$userid 	= $_SESSION['uid'];

						if (! empty($comment)) {

							$stmt = $con->prepare("INSERT INTO 
								comments(comment, status, comment_date, item_id, user_id)
								VALUES(:zcomment, 1, NOW(), :zitemid, :zuserid)");

							$stmt->execute(array(

								'zcomment' => $comment,
								'zitemid' => $itemid,
								'zuserid' => $userid

							));

							if ($stmt) {

								echo '<div class="alert alert-success">Comment Added</div>';

							}

						} else {

							echo '<div class="alert alert-danger">You Must Add Comment</div>';

						}

					}
				?>
			</div>
		</div>
	</div>
	<!-- End Add Comment -->
	<?php } else {
		echo '<a href="login.php">Login</a> or <a href="login.php">Register</a> To Add Comment';
	} ?>
	<hr class="custom-hr">
		<?php

			// Select All Users Except Admin 
			$stmt = $con->prepare("SELECT 
										comments.*, users.Username AS Member  
									FROM 
										comments
									INNER JOIN 
										users 
									ON 
										users.UserID = comments.user_id
									WHERE 
										item_id = ?
									AND 
										status = 1
									ORDER BY 
										c_id DESC");

			// Execute The Statement

			$stmt->execute(array($item['Item_ID']));

			// Assign To Variable 

			$comments = $stmt->fetchAll();

		?>
	
	<?php foreach ($comments as $comment) { ?>
		<div class="comment-box">
			<div class="row">
				<div class="col-sm-2 text-center">
					<img class="img-responsive img-thumbnail img-circle center-block" src="img.png" alt="" />
					<?php echo $comment['Member'] ?>
				</div>
				<div class="col-sm-10">
					<p class="lead"><?php echo $comment['comment'] ?></p>
				</div>
			</div>
		</div>
		<hr class="custom-hr">
	<?php } ?>
</div>
<?php
	} else {
		echo '<div class="container">';
			echo '<div class="alert alert-danger">There\'s no Such ID Or This Item Is Waiting Approval</div>';
		echo '</div>';
	}
	include $tpl . 'footer.php';
	ob_end_flush();
?>


<script>

function Changefavourite(){

	if($("#favourite").is(":checked")){
		Favourite = 1 ;
	} else {
		Favourite = 0 ;
	}
 
	var postData = {
		"MethodName" : 'UpdateFavourite',
		"ItemID" :  $("#itemid").val(),
		"UserID" : <?php echo $_SESSION['uid']; ?>,
		"Favourite" :  Favourite
		
	};

	$.ajax({ // reqest to get data from data base 
	url: 'admin/getData.php', 
	type: 'post',  
	data: postData,     
	success: function(response){  
		//alert(response);	
	}
});

}

</script>