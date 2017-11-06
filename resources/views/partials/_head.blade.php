
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="@yield('description') ">
<meta name="author" content="www.twebox.com">
<meta name="theme-color" content="#202e3d" />
<title> @yield('title') | twebox </title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/semantic.min.css" rel="stylesheet">


<link href="/css/styles.css" rel="stylesheet">
<link href="/css/notify.css" rel="stylesheet">

<!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.28/css/uikit.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Josefin+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<!-- facebook meta tags -->
  <meta property="og:url"           content="@yield('og-url') " />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="@yield('og-title')  " />
  <meta property="og:description"   content="@yield('og-description') " />
  <meta property="og:image"         content="@yield('og-image') " />
<!-- ends facobook meta tags -->

<link rel="icon" type="image/png" href="/images/tb.png">


  @yield('stylesheets')

