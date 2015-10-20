<html>
<head>
    <title>Zendcon</title>
</head>
<body>
	@if (count($errors) > 0)
		<ul>
    		@foreach ($errors->all() as $error)
    			<li>{{ $error }}</li>
    		@endforeach
		</ul>
	@endif

    <form method="POST" action="/form">
        {!! csrf_field() !!}

        <div>
            Name
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            Votes
            <input type="number" name="votes" value="{{ old('votes') }}">
        </div>

        <div>
        	Passphrase
            <input type="password" name="passphrase">
        </div>

        <div>
        	Confirm Passphrase
            <input type="password" name="passphrase_confirmation">
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
