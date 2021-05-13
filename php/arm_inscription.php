<!DOCTYPE html>
<html>
	<head>
		<title>ARM - Inscription</title>
		<meta charset="utf-8"/>
		<link id="shortcutIcon" rel="shortcut icon" type="image/x-icon" href="../images/arm/iconeArm.png"/>
		<link rel="stylesheet" type="text/css" href="../css/arm_agency.css">
		<link rel="stylesheet" type="text/css" href="../css/arm_inscription.css">
	</head>
	<body onload="PrintSplittedUrl()">

		<header>
			<a href="./arm_access.html">
				<img src="../images/arm/iconeArm.png">
			</a>
			<h1>Inscription</h1>
		</header>
		
		<div id="firstStep" class="mainPanel">
			<!-- Wellcome give us some informations -->
			<h1 id="title">Register</h1>
			<h2 id="date"></h2>
			<p>You are insterested in having a job at ARM agency. Complete following informations requiered in order to access the inscription process :</p>
			<fieldset>
				<legend>Informations</legend>
				<form id="firstStepForm" action="#" method="get">
					
					<div id="commonInfo">
						<label>Firstname</label>
						<input type="text" name="firstname" id="firstnameInput" minlength="4" maxlength="17" size="10" placeholder="John" required>
						<label>Lastname</label>
						<input type="text" name="lastname" id="lastnameInput" minlength="4" maxlength="17" size="10" placeholder="Smith" required>
						<label>Email address</label>
						<input type="email" name="email" id="emailInput" size="21" placeholder="j.smith@arm-agency.gov" required>
					</div>

					<div id="agreement">
						<input type="checkbox" name="agreement" required>
						<label>I have read and agree to the terms of the <a href="../images/arm/protocole0.png" title="ARM acknowledgement of receipt of Policy" target="blank">ARM acknowledgement of receipt of Policy</a>.</label>
					</div>

					<input type="reset" name="reset" value="Reset">
					<input type="submit" name="submit" value="Submit" required>

				</form>
			</fieldset>
		</div>

		<script type="text/javascript">
			
			var infoUrl = document.location.search;
			var listInfoUrl = null;

			// Split and print url
			function PrintSplittedUrl(){
				if (infoUrl != ""){
					listInfoUrl = infoUrl.split('&');
					for (var i = 0; i <= listInfoUrl.length-1; i++)
						console.log(listInfoUrl[i].split('='));
					if (infoUrl != null)
						ChangeTitle();
				}
			}

			// Change title with user name
			function ChangeTitle(){
				var title = document.getElementById("title");

				title.innerHTML = "Hello " + listInfoUrl[0].split('=')[1] + " " + listInfoUrl[1].split('=')[1];
			}

			// Apply today date
			var d = new Date();
			var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
			document.getElementById("date").innerHTML = "We are the " + days[d.getDay()] + " " + d.getDate() + " " + months[d.getMonth()] + " " + (d.getYear()+1900);

		</script>

		<footer>
			<!-- Access link & contact link -->
			<a href="./arm_access.html">Log in</a>
			<a href="./contact.html">Contact us</a>
		</footer>
	</body>
</html>