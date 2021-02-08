<?php
	ob_start();
	session_start();
	$pageTitle = 'Create New AD';
	include 'init.php';
	if (isset($_SESSION['user'])) {

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$formErrors = array();

			$name 		= filter_var($_POST['name'], FILTER_SANITIZE_STRING);					
			$category 	= filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);			
			$subcategory 	= filter_var($_POST['subcategory'], FILTER_SANITIZE_NUMBER_INT);
			$desc 		= filter_var($_POST['description'], FILTER_SANITIZE_STRING);	

			if($subcategory !=0){
				$category =$subcategory;
			}

			$jobtype = "";
			$adtype = "" ;
			$status = 0;
			$amount = 0;
			if($category == 20){ // jobs				
				$amount = filter_var($_POST['amount'], FILTER_SANITIZE_STRING);
				$jobtype = filter_var($_POST['jobtype'], FILTER_SANITIZE_STRING);
			} else if ($category == 19){ // coomuinty
				$adtype = filter_var($_POST['adtype'], FILTER_SANITIZE_STRING);
			} else if($category != 19){ 
				$amount = filter_var($_POST['amount'], FILTER_SANITIZE_STRING);
				$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);					
			} 


			if($category == 19 || $category == 20 ){ // Community
				$location 	= filter_var($_POST['location'], FILTER_SANITIZE_STRING);	
			} else {
				$location 	=NULL;
			}


			if($category == 19){
			$date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
			}else{
			$date =date('Y-m-d');
			}
			
		
			$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);


			$tags = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);
			$titleimage = filter_var($_POST['title-image'], FILTER_SANITIZE_STRING);
			$descriptionimage = filter_var($_POST['description-image'], FILTER_SANITIZE_STRING);
			 

			if (strlen($name) < 2) {
				$formErrors[] = 'Title Must Be At Least 2 Characters';
			}

			if ($category == 0) {
				$formErrors[] = 'You Must Choose the <strong>Category</strong>';
			}

			if (strlen($desc) < 4) {
				$formErrors[] = 'Description Must Be At Least 4 Characters';
			}
 
			if (empty($amount) && $category == 20) {
				$formErrors[] = 'You Must Enter the Salary ';
			} if (empty($amount) && $category != 20 && $category != 19) {
				$formErrors[] = 'You Must Enter the Price ';
			}
			 
			if (strlen($location) < 2 && ($category == 20 || $category == 19)) {
				$formErrors[] = 'Location Must Be At Least 2 Characters';
			}

			if ($status == 0 && $category != 20  && $category != 19) {
				$formErrors[] = 'You Must Choose the <strong>Status</strong>';
			}
  

			if (empty($date) && $category == 19) {
				$formErrors[] = 'You Must Enter the <strong>Date</strong>';
			} 
			 
			if (strlen($jobtype) == 0 && $category == 20 ) {
				$formErrors[] = 'You Must Choose the <strong>Job Type</strong>'  ;
			}

			if (strlen($adtype) == 0 && $category == 19 ) {
				$formErrors[] = 'You Must Choose the <strong>Ad Type</strong>'  ;
			}	

			if (empty($email) && $category != 19) {
				$formErrors[] = 'You Must Enter the <strong>Email</strong>';
			}
			
		
			if(isset($_FILES['image']) && $category != 20  && $category != 19){
				$errors= array();
				$file_name = $_FILES['image']['name'];
				if(empty($file_name)){
				$file_size =$_FILES['image']['size'];
				$file_tmp =$_FILES['image']['tmp_name'];
				$file_type=$_FILES['image']['type'];
				@$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
				
				$extensions= array("jpeg","jpg","png");
				
				if(in_array($file_ext,$extensions)=== false){
				   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
				}
				
				if($file_size > 2097152){
				   	$errors[]='File size must be excately 2 MB';
				}
				
				if(empty($errors)==true){
				   move_uploaded_file($file_tmp,"images/".$file_name);
				   $image = "images/".$file_name;
				}else{
					$image ="images/img.png";
				}

				}else{
					$image ="images/img.png";
				}
			 } else {
				$image ="images/img.png";
			 }

			// Check If There's No Error Proceed The Update Operation

			if (empty($formErrors)) {

				// Insert Userinfo In Database

				$stmt = $con->prepare("INSERT INTO 

					items(Name, Description, Amount,Email, Status, Add_Date, Cat_ID, Member_ID, tags
					,title_image,description_image,image,location,CommunityDate,JobType, AdType)

					VALUES(:zname, :zdesc, :zamount,:zemail, :zstatus, now(), :zcat, :zmember, :ztags
					, :ztitleimage, :zdescriptionimage, :zimage, :zlocation, :zdate, :zjobtype , :zadtype)");

				$stmt->execute(array(

					'zname' 	=> $name,
					'zdesc' 	=> $desc,
					'zamount' 	=> $amount,
					'zemail' => $email,					
					'zstatus' 	=> $status,
					'zcat'		=> $category,
					'zmember'	=> $_SESSION['uid'],
					'ztags'		=> $tags,
					'ztitleimage'		=> $titleimage,
					'zdescriptionimage'		=> $descriptionimage,
					'zimage'		=> $image,
					'zlocation' 	=> $location,
					'zdate'		=> $date,
					'zjobtype'		=> $jobtype,
					'zadtype'		=> $adtype
					

				));
	 
				// Echo Success Message

				if ($stmt) {

					$succesMsg = 'Item Has Been Added';
					
				}

			}

		}

?>

<style>
	
element.style {
    max-width: 1336px;
}
.selectboxit-container span, .selectboxit-container .selectboxit-options a {
    height: 39px;
    line-height: 30px;
    display: block;
}
element.style {
}
label.col-sm-3.control-label {
    text-align: left;
    padding-left: 50px;
}
</style>
<!-- <h1 class="text-center"><?php echo $pageTitle ?></h1> -->
<div class="create-ad block">
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo $pageTitle ?></div>
			<div class="panel-body">
				<div class="row">
				<form class="form-horizontal main-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"
						enctype="multipart/form-data">
					<div class="col-md-8">
						
							<!-- Start Name Field -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Title</label>
								<div class="col-sm-10 col-md-9">
									<input 
										pattern=".{2,}"
										title="This Field Require At Least 2 Characters"
										type="text" 
										name="name" 
										class="form-control input-md live"  
										placeholder="Please Enter Title"
										data-class=".live-title"
										required />
								</div>
							</div>
							<!-- End Name Field -->

							<!-- Start Categories Field -->
							<div class="form-group">
							<label class="col-sm-3 control-label">Category</label>
							<div class="col-sm-10 col-md-9">
								<select name="category" id = "category" onchange="ShowHideCategory(this);getSubCargories()">
									<option value="">...</option>
									<?php
										$cats = getAllFrom('*' ,'categories', 'where parent = 0 and ID not in (18)', '', 'ID');
										foreach ($cats as $cat) {
											echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
										}
									?>
								</select>
							</div>
							</div>
							<!-- End Categories Field -->

							<!-- Start Sub Categories Field -->
							<div class="form-group">
							<label class="col-sm-3 control-label">Sub Category</label>
							<div class="col-sm-10 col-md-9">
								<select name="subcategory" id = "subcategory">
									<option value="0">...</option>  
								</select>
							</div>
							</div>
							<!-- End Sub Categories Field -->
							
							<!-- Start Description Field -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Description</label>
								<div class="col-sm-10 col-md-9">
									<input 
										pattern=".{4,}"
										title="This Field Require At Least 4 Characters"
										type="text" 
										name="description" 
										class="form-control input-md live"   
										placeholder="Please Enter Description" 
										data-class=".live-desc"
										required />
								</div>
							</div>
							<!-- End Description Field -->

							<!-- Start Amount Field -->
							<div class="form-group" id="DivAmount">
								<label class="col-sm-3 control-label">Price</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="text" 
										name="amount"
										id="amount" 
										class="form-control input-md live" 
										placeholder="Please Enter Price" 
										data-class=".live-price"  required   />
								</div>
							</div>
							
							<!-- End Amount Field -->							 

							<!-- Start location Field -->
							<div class="form-group" id="DivLocation" style="display:none">
								<label class="col-sm-3 control-label">Location</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="text" 
										name="location" 										
										id="location"  
										class="form-control input-md" 
										placeholder="Please Enter Location" 
										required />
								</div>
							</div>
							<!-- End location Field -->

							<!-- Start Date Field -->
							<div class="form-group" id="DivDate" style="display:none">
								<label class="col-sm-3 control-label">Date</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="datetime-local" 
										name="date"
										id="date"  
										class="form-control input-md" 
										placeholder="Please Enter Date" 
										required />
								</div>
							</div>
							<!-- End Date Field -->

							<!-- Start Status Field -->
							<div class="form-group" id="Divstatus">
								<label class="col-sm-3 control-label">Status</label>
								<div class="col-sm-10 col-md-9">
									<select name="status" class="form-control input-md" >
										<option value="">...</option>
										<option value="1">New</option>
										<option value="2">Like New</option>
										<option value="3">Used</option>
										<option value="4">Very Old</option>
									</select>
								</div>
							</div>
							<!-- End Status Field -->


							<!-- Start Job Type Field -->
							<div class="form-group" id="DivJobType" style= "display:none">
								<label class="col-sm-3 control-label">Job Type</label>
								<div class="col-sm-10 col-md-9">
									<select name="jobtype" class="form-control input-md" >
										<option value="">...</option>
										<option value="Full Time">Full Time</option>
										<option value="Part Time">Part Time</option>										 
									</select>
								</div>
							</div>
							<!-- End Job Type Field -->
						 

							<!-- Start Ad Type Field -->
							<div class="form-group" id="DivAdType" style= "display:none">
								<label class="col-sm-3 control-label">ِAd Type</label>
								<div class="col-sm-10 col-md-9">
									<select name="adtype" class="form-control input-md" >
										<option value="">...</option>
										<option value="Events">Events</option>
										<option value="Courses">Courses</option>	
										<option value="University Announcements">University Announcements</option>									 
									</select>
								</div>
							</div>
							<!-- End Ad Type Field -->

							<!-- Start Email Address Field -->
							<div class="form-group" id="DivEmail">
								<label class="col-sm-3 control-label">Email Address</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="email" 
										name="email" 
										id="email" 
										class="form-control input-md" 
										placeholder="Please Enter Email Address" 
										required />
								</div>
							</div>
							<!-- End Email Address Field -->

							<!-- Start Tags Field -->
							<div class="form-group" id ="Divtags">
								<label class="col-sm-3 control-label">Tags</label>
								<div class="col-sm-10 col-md-9">
									<input 
										type="text" 
										name="tags" 
										class="form-control input-md" 
										placeholder="Separate Tags With Comma (,)" />
								</div>
							</div>
							<!-- End Tags Field -->
							<!-- Start Submit Field -->
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<input type="submit" value="Add Item" class="btn btn-primary btn-sm" />
								</div>
							</div>
							<!-- End Submit Field -->
						
					</div>
					<div class="col-md-4" id="Divimage">
						<div class="thumbnail item-box live-preview">
							<span class="price-tag">
								<span class="live-price">0 JD</span>
							</span>
							<img class="img-responsive" src="img.png" alt="" />
							<div class="caption">
								 
								<input type="text" name="title-image" class="form-control input-md" 
								placeholder="Please Enter Title Image" style = "margin-bottom: 10px;"  />

								<input type="file" name="image" class="form-control input-md" 
								style = "margin-bottom: 10px;"  />
								<input type="text" name="description-image" class="form-control input-md" 
								placeholder="Please Enter Description Image" style = "margin-bottom: 10px;"   />     
							</div>  
					</div>
					</div>
				</div>
				</form>
				<!-- Start Loopiong Through Errors -->
				<?php 
					if (! empty($formErrors)) {
						foreach ($formErrors as $error) {
							echo '<div class="alert alert-danger">' . $error . '</div>';
						}
					}
					if (isset($succesMsg)) {
						echo '<div class="alert alert-success">' . $succesMsg . '</div>';
					}
				?>
				<!-- End Loopiong Through Errors -->
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


<script>
$('#date , #location').removeAttr('required');

function ShowHideCategory(ID){

$('#email , #date , #location').removeAttr('required');

if(ID.value == 20){
 
$("#DivDate , #Divstatus , #DivAdType  , #Divtags , #Divimage").hide();
$("#DivJobType , #DivAmount ,#DivLocation ").show();
$("#DivAmount > label").text("Salary");
$("#DivAmount > div > input").attr("placeholder", "Please Enter Salary");
$("#amount").val(0); 
$('#email, #location').attr("required", "true");
 
}else if(ID.value == 19){ 

$("#DivJobType , #Divstatus , #DivAmount, #Divtags , #Divimage").hide();
$("#DivDate , #DivAdType , #DivLocation").show();
$("#amount").val(0); 
$('#date , #location').attr("required", "true");
} else {

$("#DivJobType , #DivAdType , #DivDate ,#DivLocation").hide();
$("#DivAmount ,#Divstatus , #Divtags , #Divimage").show();
$("#DivAmount > label").text("Price");
$("#DivAmount > div > input").attr("placeholder", "Please Enter Price"); 
$('#email').attr("required", "true");

}
ReFillreqired();
}

function ReFillreqired(){
	$('span.asterisk').remove();
	$('input').each(function () {

	if ($(this).attr('required') === 'required') {

	$(this).after('<span class="asterisk">*</span>');

	}

	});
}

function getSubCargories(){

$("#subcategory").data("selectBox-selectBoxIt").remove();
var postData = {
	"MethodName" : 'SubCategories',
	"ParentID" :  $("#category").val(),
};

$.ajax({ // reqest to get data from data base 
url: 'admin/getData.php', 
type: 'post',  
data: postData,     
success: function(response){  
 
	var Obj = $.parseJSON(JSON.parse(JSON.stringify(response)));
	console.log(Obj);
	if(Obj.length == 0){
		$("#subcategory").data("selectBox-selectBoxIt").add([{value: "0", text: "..."}]);
	}else {
		$("#subcategory").data("selectBox-selectBoxIt").add(Obj);
	}
	
}
});

}
</script>