<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Poweradmin 3</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	<div class="welcome">
		<a href="http://www.poweradmin.org" title="Poweradmin 3"><img src="data:image/png;base64,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" alt="Poweradmin 3"></a>
		<h1>Poweradmin 3</h1>
	</div>
</body>
</html>
