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


	$stmtFavourite = $con->prepare("SELECT COUNT(Favourite) AS Favourite  FROM  favourite 
	WHERE  ItemID = ? AND UserID = ?  AND Favourite = 1 ");

		// Execute Query
		$stmtFavourite->execute(array($itemid , $_SESSION['uid']));

	// Fetch The Data
	$Favourite = $stmtFavourite->fetch();

?>
<br><br>
<input type = "hidden" id= "itemid" value ="<?php echo $itemid; ?>" />
<div class="container">
	<div class="row">
		 
		<div class="col-md-12 item-info">
			<h2><?php echo $item['Name'] ?></h2>
			<p><?php echo $item['Description'] ?></p>
			<ul class="list-unstyled">
			
				<li>
					<i class="fa fa-user fa-fw"></i>
					<span>Added By</span> : <?php echo $item['Username'] ?>
				</li>
				<li>
					<i class="fa fa-map-marker fa-fw"></i>
					<span>Location</span> : <?php echo $item['location'] ?>
				</li>
				<li>
					<i class="fa fa-calendar fa-fw"></i>
					<span>Date</span> : <?php echo $item['CommunityDate'] ?>
				</li>

				<li>
					<i class="fa fa-calendar fa-fw"></i>
					<span>Added Date</span> : <?php echo $item['Add_Date'] ?>
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
	<?php if (isset($_SESSION['user'])) { 
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$formErrors = array();
			

			$itemid 	= $item['Item_ID'];
			$userid 	= $_SESSION['uid'];
			$FullName 	= filter_var($_POST['FullName'], FILTER_SANITIZE_STRING);
			$Email 	= filter_var($_POST['Email'], FILTER_SANITIZE_STRING);

			if (empty($FullName)) {
				$formErrors[] = 'Full Name Can\'t Be Empty';
			}

			if (empty($Email)) {
				$formErrors[] = 'Email Address Can\'t Be Empty';
			}

			if(isset($_FILES['File'])){
				$errors= array();
				$file_name = $_FILES['File']['name'];
				$file_size =$_FILES['File']['size'];
				$file_tmp =$_FILES['File']['tmp_name'];
				$file_type=$_FILES['File']['type'];
				@$file_ext=strtolower(end(explode('.',$_FILES['File']['name'])));
				
				$extensions= array("pdf","docx" , "doc");
				
				if(in_array($file_ext,$extensions)=== false){
				   $formErrors[]="extension not allowed, please choose a pdf or docx or doc  file.";
				}
				
				if($file_size > 2097152){
					   $formErrors[]='File size must be excately 2 MB';
				}
				
				if(empty($errors)==true){
				   move_uploaded_file($file_tmp,"uploads/".$file_name);
				   $File = "uploads/".$file_name;
				}else{
				   print_r($errors);
				}
			 } else {
				$formErrors[]='Please Upload Resume';
			 }

	
			if (empty($formErrors)) {
			 
				$stmt = $con->prepare("INSERT INTO 
					jobs(UserID, ItemID, FullName, Email, File)
					VALUES(:zuserid,:zitemid,:zfullname,:zemail , :zfile)");

				$stmt->execute(array(

					'zuserid' => $userid,
					'zitemid' => $itemid,
					'zfullname' => $FullName,
					'zemail' => $Email,
					'zfile' => $File

				));

				if ($stmt) {

					echo '<div class="alert alert-success">Apply Job Successfully</div>';
					
				}

				
			} else if (! empty($formErrors)) {
				foreach ($formErrors as $error) {
					echo '<div class="alert alert-danger">' . $error . '</div>';
				}
			}
			
			  

		}
		
	?>
 
	<?php } ?>
	 
	
 
</div>
<?php
	} 
	include $tpl . 'footer.php';
	ob_end_flush();
?>

<script>
function disable_f5(e)
{
  if ((e.which || e.keyCode) == 116)
  {
      e.preventDefault();
  }
}

$(document).ready(function(){
    $(document).bind("keydown", disable_f5);   
	$(".alert").hide(3000);
});
 

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