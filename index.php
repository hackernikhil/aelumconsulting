<!DOCTYPE html>
<html lang="en">
<head>
  <title>AELUM CONSULTING Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
</head>
<body onload="createCaptcha();">

<div class="container">

  <p style="margin-top: 10px;">AELUM CONSULTING</p>

  <p class="alertMsg">Registration closes in <span id="time">03:00</span> minutes!</p>

  <div class="row">
    <div class="col">
      <div class="alert alert-info errMsg" id="errMsg" style="background:#5bc0de;color:#fff;border-radius: 0px;padding:10px;display:none;">Invalid Captcha. try Again</div>
    </div>
   </div>

  <form onsubmit="return validateCaptcha();" name="myForm" id="myForm">
    <div class="row">
       <div class="col">
        <input type="text" class="form-control" placeholder="Enter name" autocomplete="off" name="Name" required>
      </div>
      <div class="col">
        <input type="email" class="form-control" autocomplete="off" placeholder="Enter email" name="EmailAddress" required>
      </div>
      <div class="col">
        <input type="text" class="form-control" autocomplete="off" id="datepicker" placeholder="Enter dob" name="pswd" required>
      </div>
    </div>

    <div class="row" style="margin-top: 20px;">
      <div class="col">
        <textarea class="form-control" placeholder="Enter description" autocomplete="off" name="description"></textarea>
      </div>
    </div>

    <div class="row" style="margin-top: 20px;">
       <div class="col-2">
        <div id="captcha"></div>
      </div>
      <div class="col">
        <input type="text" class="form-control" placeholder="Enter Captcha" autocomplete="off" id="cpatchaTextBox">
      </div>
      <div class="col">
        <button type="submit" class="btn btn-primary btn-flat" id="btn-submit">Submit</button>
      </div>
    </div>
  </form>

</div>
<script>
var code;
var threeMinutes = 60 * 3,
display = document.querySelector('#time');
startTimer(threeMinutes, display);
$("#datepicker").datepicker({autoclose: true,});

function createCaptcha() {
  //clear the contents of captcha div first 
  document.getElementById('captcha').innerHTML = "";
  var charsArray ="023456789abcdefghijklmnoprstuvwxyABCDEFGHIJKLMNOPRSTUVWXY@!#$%^&*";
  var lengthOtp = 6;
  var captcha = [];

  for (var i = 0; i < lengthOtp; i++) {
    //below code will not allow Repetition of Characters
    var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
    if (captcha.indexOf(charsArray[index]) == -1)
      captcha.push(charsArray[index]);
    else i--;
  }

  var canv = document.createElement("canvas");
  canv.id = "captcha";
  canv.width = 100;
  canv.height = 50;
  var ctx = canv.getContext("2d");
  ctx.font = "25px Georgia";
  ctx.strokeText(captcha.join(""), 0, 30);
  //storing captcha so that can validate you can save it somewhere else according to your specific requirements
  code = captcha.join("");
  document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}

function startTimer(duration, display) {
  var timer = duration, minutes, seconds;
  setInterval(function () {
   minutes = parseInt(timer / 60, 10)
   seconds = parseInt(timer % 60, 10);

   minutes = minutes < 10 ? "0" + minutes : minutes;
   seconds = seconds < 10 ? "0" + seconds : seconds;

   display.textContent = minutes + ":" + seconds;

    if (--timer < 0) { 
      $('.alertMsg').html('Registration close now.'); 
      document.getElementById("btn-submit").disabled = true;
    }
  }, 1000);
}

function validateCaptcha() {
  if (document.getElementById("cpatchaTextBox").value != code) {
     $("#errMsg").show('slow');
     createCaptcha();
     return false;
  } else {
    $("#myForm").hide();
    $(".alertMsg").hide();
    $(".errMsg").show('slow').html('Your form has been subitted successfully.');
    return false;
  }
}

</script>
</body>
</html>
