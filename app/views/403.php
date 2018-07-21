<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<style>
		body {
		  font-size: 50pt;
		  padding: 10px;
		  background-color: rgb(30, 33, 37);
		  font-family: monospace;
		  text-align: center;
		  color: #ccc;
		}

		section p,
		span {
		  margin: 0;
		  padding: 0;
		  font-size: 15px;
		  font-style: italic;
		  font-weight: 300;
		  line-height: 25px;
		  color: #666666;
		}

		span{
		  font-size: 10pt;
		  color: white;
		}

		h3 {
		  font-size: 35px;
		  margin: 0;
		  padding: 0;
		}
	</style>

	<section class="forbidden">
	  <h3>403</h3>
	  <p>You do not have permission to view this directory.</p>
	  <span id='r'>Returning to home page: <i>-</i></span>
	</section>

<script type="module">
	$(document).ready(function() {
  var i = 6;
  setInterval(function() {
    i--;
    if (i < 1) {
      window.location = "/sportbuddy";
    }
    $("#r i").text(i);
  }, 1000);
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</body>
</html>

