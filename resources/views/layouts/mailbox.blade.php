<!DOCTYPE html>
<html>
<head>
<title>LocalMail</title>
<link rel="icon" type="image/png" href="/email_icon.png">
<link rel="stylesheet" href="/css/normalize.min.css">
<link rel="stylesheet" type="text/css" href="/css/main.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
</head>
<body>

<div class="sidebar">
	<div class="logo">
		<i class="fa fa-envelope-o"></i> LocalMail
	</div>
	<ul class="mail-excerpts">
		@foreach($excerpts as $excerpt)
			<li class="mail-excerpt" data-messageid="{{ trim($excerpt->Msgno) }}">
				{{ $excerpt->fromaddress }}<br/>
				<span class="mail-excerpt-subject">{{ $excerpt->subject }}</span>
			</li>
		@endforeach
	</ul>
</div>

<div class="mail-header">No email selected</div>

<div class="content"></div>

<script src="/js/jquery.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>