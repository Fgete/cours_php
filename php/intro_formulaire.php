<!DOCTYPE html>
<html>
	<head>
		<title>Intro formulaire</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/x-icon" href="../images/logo.png">
		<link rel="stylesheet" type="text/css" href="../css/intro_formulaire.css">
	</head>
	<body>

		<h1>Formulaire type</h1>

		<fieldset>
			<legend>Identité</legend>
			<form method="get" action="#">

				<div>
					<label for="nom">Nom :</label>
					<input type="text" name="nom" id="nom" placeholder="Smith" required="required" autocomplete="name">
				</div>

				<div>
					<label for="prenom">Prenom :</label>
					<input type="text" name="prenom" id="prenom" placeholder="John" autocomplete="username">
				</div>

				<div>
					<label for="mail">Email :</label>
					<input type="email" name="mail" id="mail" placeholder="j.smith@gmail.com" required="required">
				</div>

				<div>
					<label for="naissance">Date de naissance :</label>
					<input type="date" name="naissance" id="naissance">
				</div>
				
				<div>
					<input type="radio" name="sexe" id="homme" value="homme" checked>
					<label for="homme">Homme</label>
					<br>
					<input type="radio" name="sexe" id="femme" value="femme">
					<label for="femme">Femme </label>
				</div>

				<div>
					<label for="localite">Dans quel continent habitez-vous ?</label>
				    <select name="localite" id="localite">
			           <option value="ame_nord">Amerique du Nord</option>
			           <option value="ame_sud">Amerique du Sud</option>
			           <option value="afrique">Afrique</option>
			           <option value="asie">Asie</option>
			           <option value="europe">Europe</option>
			       </select>
				</div>

				<div>
					<input type="submit" name="submit" id="submit" value="Submit">
					<input type="reset" name="reset" id="reset" value="Reset">
				</div>

			</form>
		</fieldset>

	</body>
</html>	