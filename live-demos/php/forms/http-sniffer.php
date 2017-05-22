<!DOCTYPE html>
<html>
<head>
	<title>HTTP Sniffer</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<a href="#" class="button" onClick="toggleAnimation();">OPEN</a>

	<h1>The server received the following:</h1>
	
	<div class="email">
	  <div class="envelope">
	    <div class="back paper"></div>
	    <div class="note">
	      <?php var_dump($_REQUEST); ?>
	    </div>
	    <div class="front paper">
	    	<?php var_dump(getallheaders()); ?>
	    </div>
	  </div>
	</div>
<script type="text/javascript">
	function toggleAnimation()
	{
		var btns = document.querySelectorAll(".back");
		var notes = document.querySelectorAll(".note");
		for(var i =0; i<btns.length;i++)
		{
			toggleClass(btns[i],'animate');
			toggleClass(notes[i],'animate');
		}

	}

	function toggleClass(elm,className)
	{
		if(!elm.classList.contains(className))
		{
		  elm.classList.add(className);
		}
		else
		{
		  elm.classList.remove(className);
		}
	}
</script>
</body>
</html>