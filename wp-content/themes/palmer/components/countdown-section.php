<?php //echo $args['datetime'];
//echo $args['expiration_text'];
 ?>
<section class="countdown-section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div id="timer">
					
				</div>
        <div id="onexpired" class="text-center"></div>
			</div>
		</div>
	</div>
</section>
 

<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $args['datetime']; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
 document.getElementById("timer").innerHTML = "<div class='unit'><p>" + days + "</p><p>Days</p></div><div class='unit'><p>" + hours + "</p><p>Hours</p></div> <div class='unit'><p> " + minutes + "</p><p>Minutes</p></div>";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "";
    document.getElementById("onexpired").innerHTML = "<p class='h1'><?php echo $args['expiration_title']; ?> </p> <div class='msg'><?php echo  trim(preg_replace('/\s+/', ' ', $args["expiration_text"])); ?></div>";
  }
}, 1000);
</script>