
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="layout/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Texturina:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<style>
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
}
section{
    position: relative;
    display: flex;
    align-items: center;
    min-height: 100vh;
}
section h2{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    font-size: 12vw;
    font-weight: 900;
    -webkit-text-stroke: 1px crimson;
    color: transparent;
    opacity: .2;
    user-select: none;
    z-index: -1;
}
.container{
    width: 100%;
    max-width: 1160px;
    padding: 30px;
    margin: 0 auto;
}
.grid{
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 2.5rem;
    align-items: center;
}
.content h1{
    font-size: 2.8rem;
}
.content p{
    color: #747474;
    line-height: 1.6;
    margin: 3rem 0;
}
.content .social a{
    text-decoration: none;
    color: #fff;
    margin-right: 1rem;
    transition: color .3s ease;
    font-size: 1.3rem;
}
.content .social a:hover{
    color: crimson;
}

input,textarea{

    width: 100%;
    color: #fff;
    font-family: "Barlow" ,Open Sans;
    font-size: 17px;
    padding: .75rem;
    outline: none;
    border: none;
    border-bottom: 2px solid #333;
    margin: .6rem 0;
    border-radius: 2px;
    box-sizing: border-box;
    background: transparent;
    resize: vertical;
    transition: border .3s ease;
}
input:focus,textarea:focus{
    border-bottom-color: crimson;
}

.form .flex{
    display: flex;
    justify-content: space-between;
}
.flex>*{
    flex-basis: 49%;
}
::placeholder{
    color: #fff;
    font-weight: 400;
}

.form button{
    width: 150px;
    padding: .75rem 0;
    border: none;
    outline: none;
    background: black;
    color: #fff;
    font-size: 18px;
    transition: opacity .3s ease;
}
.form button:hover{
    opacity: .7;
}
.footer1{
  background:#bbbbbb;
    color: #fff;
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    box-sizing: border-box;
}




</style>
<body>
 
  <div id="main"> 
   <div class="navbar">
     <!-- <div class="logo">
       <h2 style="color: white;"> Hellohelp </h2> 
         
     </div>  -->
    
   </div>
   <div class="circle-box">
      <svg height="402"  width="402" > 
          <circle r="200"  cx="201" cy="201"  stroke-width="1px"  stroke=" gray"  opacity= " 0.3"  />
      </svg>
      <svg height="402"  width="402" > 
        <circle r="200"  cx="201" cy="201"  stroke-width="1px"  stroke=" white"   opacity= " 0.3"  id="svgcircle" />
    </svg>
  
   <div>
       <span id="step1"></span>
       <span id="step2"></span>
       <span id="step3"></span>
       <span id="step4"></span>
       <span id="step5"></span>
   </div>
    <div class="user-box" id="user_box">
    <div class="user">
    <h1 > <a class="navbar-brand" href="index.php" style= "font-size: 29px;color: white;">
		  <b style="color: #a4d9de;">H</b>ello <b style="color: #ececa9;">H</b>elp</a></h1>
    <p>Welcome to the largest classified ads website at the University of Jordan  </p> 
    </div>
    
   <div class="user">
    <h1> <a class="navbar-brand" href="Buy&Sell.php" style= "font-size: 29px;color: white;">
		  <b style="color: #a4d9de;">B</b>uy & <b style="color: #ececa9;">S</b>ell</a>
   </h1>
    <p>  Finding books, engineering tools and everything needed for the university, here you can advertise and search for everything. </p>
   </div>
   

<div class="user">
  <h1><a class="navbar-brand" href="Services/index.php"style= "font-size: 29px;color: white;">
		  <b style="color: #a4d9de;">S</b>ervice<b style="color: #ececa9;">s</b> </a>
   </h1>
  <p> There is an audio library here, now you can listen to books or volunteer with us. </p>

</div>

   
<div class="user">
  <h1><a class="navbar-brand" href="Categories.php?pageid=20"style= "font-size: 29px;color: white;">
		  <b style="color: #a4d9de;">J</b>o<b style="color: #ececa9;">b</b> </a>  </h1>
  <p> For business owners or job seekers, here you can advertise or search for jobs</p>
 
</div>

<div class="user">
  <h1><a class="navbar-brand"  href="Categories.php?pageid=19"style= "font-size: 29px;color: white;">
		  <b style="color: #a4d9de;">C</b>ommunit<b style="color: #ececa9;">y</b> </a></h1>
  <p>  Share with your friends, learn, do your hobbies  ,communicate, and stay informed. </p>
</div>
</div>
   </div>

   

  </div> 
  <div class="container">


  <div class="sec" style="margin: 50px;margin-bottom:0px">
  <br>    
 
  <br>  <br>    
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <div class="col">
        <div class="card"  style=" border: grey;">
          <img src="images/voice.jpg" class="card-img-top" width="250px">
          <div class="card-body">
            <h5 class="card-title">Do Something great!</h5>
          
          </div>
        </div>
      </div>
      <div class="col" >
        <div class="card" style=" border: grey;">
          <img src="images/make-mony.jpg" class="card-img-top" width="250px">
          <div class="card-body">
            <h5 class="card-title text-center">Make Money </h5>
        
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card"  style=" border: grey;">
          <img src="images/com.jpg" class="card-img-top" width="250px">
          <div class="card-body">
            <h5 class="card-title text-center">be informed about </h5>
           
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card"  style=" border: grey;">
          <img src="images/findjob.jpg" class="card-img-top" width="250px">
          <div class="card-body">
            <h5 class="card-title text-center">Find a Job </h5>
          
          </div>
        </div>
      </div>
      </div>
    </div>

      






<!-- 

    <div class="sec2">
    <h2> HelloHelp better when you’re a member</h2>
    <p>See more relevant listings, find what you’re looking for quicker, and more!</p>
    <button type="button" class="btn btn-outline-secondary">
    <a href="login.php" style="color: #6c757d;text-decoration: none;">Sign In</a></button>

    </div> -->


    </div>
 
  </div>

  <section class="footer1">
        <div class="container">
            <div class="grid">
                <div class="content">
                    <h1><a class="navbar-brand" href="index.php" style= "font-size: 29px;color: white;">
		  <b style="color: #a4d9de;">H</b>ello <b style="color: #ececa9;">H</b>elp</a></h1>
                    <p>HelloHelp is the student's largest classifieds site with lots of live ads in a wide range of categories housing, jobs,
 community, and everything in between. ِa new ads are posted every second! We’re proud to provide a platform that connects 
 students, helping them to buy great items in their community, make money off unused possessions cluttering up houses, 
 and find audiobooks that help blind Students in their studies.</p>
                    <div class="social">
                        <a href="#"><i class="fa fa-facebook-square"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-linkedin-square"></i></a>
                    </div>
                </div>
                <div class="form">
                    <form action="#">
                        <div class="flex">
                            <input type="text" name="" id="" placeholder="Your Name">
                            <input type="email" name="" id="" placeholder="Your Email">
                        </div>
                        <input type="text" name="" id="" placeholder="Your Subject">
                        <textarea name="" id="" cols="30" rows="8" placeholder="Your Message"></textarea>
                        <button type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    
    </section>
   
  
  <script>
      var svgcircle =document.getElementById("svgcircle");
      var step1 =document.getElementById("step1");
      var step2 =document.getElementById("step2");
      var step3 =document.getElementById("step3");
      var step4 =document.getElementById("step4");
      var step5 =document.getElementById("step5");
      var main =document.getElementById("main");
      var user_box =document.getElementById("user_box");
      
     main.style.backgroundImage = " url(images/back.jpg)";

      step1.addEventListener('click',()=>{
          svgcircle.style.strokeDashoffset ="1004";
          main.style.backgroundImage = " url(images/1.jpg)";
          user_box.style.top ="-350px";
         });
         step2.addEventListener('click',()=>{
          svgcircle.style.strokeDashoffset ="753";
          main.style.backgroundImage = " url(images/2.jpg)";
          user_box.style.top ="-800px";
         });
         step3.addEventListener('click',()=>{
          svgcircle.style.strokeDashoffset ="502";
          main.style.backgroundImage = " url(images/3.jpg)";
          user_box.style.top ="-1250px";
         });
         step4.addEventListener('click',()=>{
          svgcircle.style.strokeDashoffset ="201";
          main.style.backgroundImage = " url(images/4.jpg)";
          user_box.style.top ="-1700px";
         });
        
         step5.addEventListener('click',()=>{
          svgcircle.style.strokeDashoffset ="0";
           main.style.backgroundImage = " url(images/back.jpg)";
           user_box.style.top ="100px";
         });
  </script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 
</body>
</html>