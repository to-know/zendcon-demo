<html>
	<head>
		<title>Zendcon</title>
	</head>
	<body>
		<h1>My Webpage</h1>

		<ul>
			@section('navigation')
				<li>Link One</li>
				<li>Link Two</li>
			@show
		</ul>

		<br>

		@yield('content')
	</body>
</html>
