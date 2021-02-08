<?php
	ob_start();
	session_start();
	$pageTitle = 'Buy and Sell';
	include 'init.php';
?>
<div class="container">

	<div class="row">
		<form  id="myForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
		<div class=" search-box">
	
		<input type="text" name = "search-text" class="search-field" placeholder="Search for anything..."
		onkeyup="if event.keyCode === 13 document.getElementById('myForm').submit();" />
	
	<!-- <button type="button" ><i class="fas fa-search"></i></button> -->
	</div>

		<?php
			$name  = "" ;
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$name 	= filter_var($_POST['search-text'], FILTER_SANITIZE_STRING);
			}
			
			$allItems = getAllFrom('*', 'items', 'where Approve = 1 ' , ' AND  Name like ("%'.$name.'%") AND cat_id not in(20,19)', 'Item_ID');
			foreach ($allItems as $item) { 

				echo '<div class="col-sm-6 col-md-3">'; 
					echo '<div class="thumbnail item-box">';
						echo '<span class="price-tag">' . $item['Amount'] . ' JD</span>';
						echo '<img class="img-responsive filter-image"  src="' . $item['Image'] . '" alt="" />';
						echo '<div class="caption">';
							echo '<p><a class = "title-name" href="items.php?itemid='. $item['Item_ID'] .'">' . $item['Name'] .'</a></h3>';
							//echo '<p>' . $item['Description'] . '</p>';
							echo '<div class="date">' . $item['Add_Date'] . '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		?>

		</form>
	</div>
</div>

<?php
	include $tpl . 'footer.php'; 
	ob_end_flush();
?>


 