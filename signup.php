<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "config.php";

$redirecturl = "http://localhost:8080/Hypertube/fb-callback.php";
$permissions = ['email'];
$loginurl = $helper->getLoginUrl($redirecturl, $permissions);

$gloginurl = $client->createAuthUrl();
$loginurl42 = "https://api.intra.42.fr/oauth/authorize?client_id=61d50a325b359a90c18726e2bf5c95c8c914ce04f80cd5a0b26c7a0af166d397&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2FHypertube%2F42-callback.php&response_type=code";
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
.tablink {
  background-color: rgb(66, 66, 68);
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 50%;
}

.tablink:hover {
  background-color: grey;
}

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}

/* style the container */
.container {
  position: relative;
  background-color: grey;
  padding: 20px 0 30px 0;
} 

/* style inputs and link buttons */
input,
.btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* add appropriate colors to fb, twitter and google buttons */
.fb {
  background-color: #3B5998;
  color: white;
}

.twitter {
  background-color: #55ACEE;
  color: white;
}

.google {
  background-color: #dd4b39;
  color: white;
}

/* style the submit button */
input[type=submit] {
  background-color: rgb(66, 66, 68);
  color: white;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: rgb(66, 66, 68);
}

/* Two-column layout */
.col {
  float: left;
  width: 50%;
  margin: auto;
  padding: 0 50px;
  margin-top: 6px;
  background-color: grey; /*change second background*/
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* vertical line */
.vl {
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  border: 2px solid #ddd;
  height: 175px;
}

/* text inside the vertical line */
.vl-innertext {
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
  background-color: grey; /*change middle or*/
  border: 1px solid #ccc;
  border-radius: 50%;
  padding: 8px 10px;
}

/* hide some text on medium and large screens */
.hide-md-lg {
  display: none;
}

/* bottom container */
.bottom-container {
  text-align: center;
  background-color: #666;
  border-radius: 0px 0px 4px 4px;
}

/* Responsive layout - when the screen is less than 650px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 650px) {
  .col {
    width: 100%;
    margin-top: 0;
  }
  /* hide the vertical line */
  .vl {
    display: none;
  }
  /* show the hidden text on small screens */
  .hide-md-lg {
    display: block;
    text-align: center;
  }
}

#Sign-in {background-color: rgb(66, 66, 68);}
#Sign-up {background-color: rgb(66, 66, 68);}

</style>
</head>
<body>

<button class="tablink" onclick="openPage('Sign-in', this, 'black')" id="defaultOpen">Sign-in</button>
<button class="tablink" onclick="openPage('Sign-up', this, 'black')">Sign-up</button>

<div id="Sign-in" class="tabcontent">
  <br /><br /><br /><br /><br /><br />
  <div class="container">
  <form action="/action_page.php">
    <div class="row">
      <h2 style="text-align:center">Sign-in with Social Media or Manually</h2>
      <div class="vl">
        <span class="vl-innertext">or</span>
      </div>

      <div class="col">
        <a href="<?php echo $loginurl ?>" class="fb btn">
          <i class="fa fa-facebook fa-fw"></i> Sign-in with Facebook
         </a>
        <a href="<?php echo $loginurl42 ?>" class="twitter btn">
          <i class="fa fa-twitter fa-fw"></i> Sign-in with WeThinkCode_
        </a>
        <a href="<?php echo $gloginurl ?>" class="google btn"><i class="fa fa-google fa-fw">
          </i> Sign-in with Google
        </a>
      </div>

      <div class="col">
        <div class="hide-md-lg">
          <p>Or Sign-in manually:</p>
        </div>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Sign-in">
      </div>
      
    </div>
  </form>
</div>

<div class="bottom-container">
  <div class="row">
    <div class="col">
      <a href="#" style="color:white" class="btn">Sign-up</a>
    </div>
    <div class="col">
      <a href="#" style="color:white" class="btn">Forgot password?</a>
    </div>
  </div>
</div>
</div>

<div id="Sign-up" class="tabcontent">
  <br /><br /><br /><br /><br /><br />
  <div class="container">
  <form action="register.php" method="POST">
    <div class="row">
      <h2 style="text-align:center">Sign-up with Social Media or Manually</h2>
      <div class="vl">
        <span class="vl-innertext">or</span>
      </div>

      <div class="col">
        <a href="<?php echo $loginurl ?>" class="fb btn">
          <i class="fa fa-facebook fa-fw"></i> Sign-up with Facebook
         </a>
        <a href="<?php echo $loginurl42 ?>" class="twitter btn">
          <i class="fa fa-twitter fa-fw"></i> Sign-up with WeThinkCode_
        </a>
        <a href="<?php echo $gloginurl ?>" class="google btn"><i class="fa fa-google fa-fw">
          </i> Sign-up with Google
        </a>
      </div>

      <div class="col">
        <div class="hide-md-lg">
          <p>Or Sign-up manually:</p>
        </div>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" placeholder="First Name" name="first_name" required>
        <input type="text" placeholder="Last Name" name="last_name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password2" placeholder="Repeat Password" required>
        <input type="submit" value="Sign-up">
      </div>
      
    </div>
  </form>
</div>

<div class="bottom-container">
  <div class="row">
    <div class="col">
      <a href="#" style="color:white" class="btn">Sign-in</a>
    </div>
    <div class="col">
      <a href="#" style="color:white" class="btn">Forgot password?</a>
    </div>
  </div>
</div>
</div>

<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
   
</body>
</html>

