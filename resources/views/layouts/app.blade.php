<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="/img/logo/jh.png" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <title>Looking Glass</title>
</head>
    <!-- component -->
<body>
	<nav class="fixed top-0 left-0 w-full px-4 py-4 flex justify-between items-center bg-orange-400 shadow z-10">
		<a class="px-3 py-3" href="#">
		<img src="/img/logo/jagoanhosting.png" class="bg-white rounded-full" width="45" height="45" alt="">
		</a>
		<div class="lg:hidden">
			<button class="navbar-burger flex items-center text-white p-3">
				<svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<title>Mobile menu</title>
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</button>
		</div>
		<ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:flex lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-10">
			<li><a class="text-sm font-bold text-white hover:text-gray-200" href="{{route('network.index')}}">Network Tools</a></li>
			<li><a class="text-sm font-bold text-white hover:text-gray-200" href="{{ route('web.index') }}">Web Tools</a></li>
			<li><a class="text-sm font-bold text-white hover:text-gray-200" href="#">Speed Test</a></li>
		</ul>
	</nav>
	<div class="navbar-menu relative z-50 hidden">
		<div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
		<nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
			<div class="flex items-center mb-8">
				<a class="mr-auto" href="#">
					<img src="/img/logo/jagoanhosting.png" width="45" height="45" alt="">
				</a>
				<button class="navbar-close">
					<svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>
			<div>
				<ul>
					<li class="mb-1">
						<a class="block p-4 text-sm font-bold text-gray-400 hover:bg-orange-50 hover:text-orange-600 rounded" href="{{ route('network.index') }}">Network Tools</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-bold text-gray-400 hover:bg-orange-50 hover:text-orange-600 rounded" href="{{ route('web.index') }}">Web Tools</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-bold text-gray-400 hover:bg-orange-50 hover:text-orange-600 rounded" href="#">Speed Test</a>
					</li>
				</ul>
			</div>
			<div class="mt-auto">		
			</div>
		</nav>
	</div>
	@yield('content')
	
<footer class="bg-orange-500 shadow">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="/" class="flex items-center mb-4 sm:mb-0">
                <img src="img/logo/jagoanhosting.png" class="h-8 mr-3 bg-white rounded-full" alt="Flowbite Logo" />
                <span class="self-center text-white text-2xl font-bold whitespace-nowrap">Jagoanhosting</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white sm:mb-0">
                <li>
                    <a href="/" class="mr-4 hover:underline md:mr-6 ">Network Tools</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Speed Test</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-white sm:mx-auto lg:my-8" />
        <span class="block text-sm text-white sm:text-center">© 2023 <a href="https://lg.jagoanhosting.com/" class="hover:underline">Jagoanhosting</a>. All Rights Reserved.</span>
    </div>
</footer>


</body>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>

<script>
// Burger menus
document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }
});
</script>

</html>