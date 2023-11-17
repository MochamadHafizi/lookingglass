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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <title>Looking Glass</title>
</head>
    <!-- component -->
<body>
	<nav class="fixed top-0 left-0 w-full flex justify-between items-center bg-orange-400 shadow z-10">
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
			{{-- <li><a class="text-xs font-bold text-white hover:text-gray-200" href="{{route('network.index')}}">Network Tools</a></li>
			<li><a class="text-sm font-bold text-white hover:text-gray-200" href="{{ route('web.index') }}">Web Tools</a></li>
			<li><a class="text-sm font-bold text-white hover:text-gray-200" href="{{route('speed.index')}}">Speed Test</a></li> --}}
			<li><span class="text-white text-sm font-bold">Your IP Address <span id="userIpAddress"></span></span></li>
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
						<a class="block p-4 text-sm font-bold text-gray-400 hover:bg-orange-50 hover:text-orange-600 rounded" href="{{ route('web.webspeedview') }}">Web Tools</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-bold text-gray-400 hover:bg-orange-50 hover:text-orange-600 rounded" href="{{route('speed.index')}}">Speed Test</a>
					</li>
				</ul>
			</div>
			<div class="mt-auto">		
			</div>
		</nav>
	</div>
    <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-56 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow-lg" aria-label="Sidebar">
		<div class="h-full px-3 py-4 overflow-y-auto bg-white">
			<img src="/img/logo/jh.png" class="mx-auto rounded-full d-block" width="50" alt="">
			<h1 class="text-orange-400 font-black text-center m-2 text-lg">Looking glass</h1>
		   <ul class="space-y-2 font-medium mt-10">
			  <li>
				 <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-orange-50" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
					<i style="font-size: 1em;" class="bi bi-hdd-network text-orange-400"></i>
					   <span class="flex-1 ml-3 text-left whitespace-nowrap text-orange-400 font-bold text-xs">Network Tools</span>
					   <svg class="w-3 h-3 text-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
						  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
					   </svg>
				 </button>
				 <ul id="dropdown-example" class="hidden py-2 space-y-2">
					   <li>
							<a href="{{route('network.index')}}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-4-circle mr-2"></i>Ping IPV4</a>
					   </li>
					   <li>
						<a href="{{route('network.ping6view')}}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-6-circle mr-2"></i>Ping IPV6</a>
				  		</li>
					   <li>
						  <a href="{{route('network.traceview')}}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-4-circle mr-2"></i>Traceroute IPV4</a>
					   </li>
					   <li>
						<a href="{{route('network.traceview6')}}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-6-circle mr-2"></i>Traceroute IPV6</a>
					 	</li>
					   <li>
						  <a href="{{route('network.ipinfoview')}}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-globe-americas mr-2"></i>IP Info</a>
					   </li>
				 </ul>
			  </li>
			  <li>
				<button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-orange-50" aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
					<i style="font-size: 1em;" class="bi bi-tv text-orange-400"></i>
					  <span class="flex-1 ml-3 text-left whitespace-nowrap text-orange-400 text-bold text-xs font-bold">Web Tools</span>
					  <svg class="w-3 h-3 text-orange-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
						 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
					  </svg>
				</button>
				<ul id="dropdown-example2" class="hidden py-2 space-y-2">
					  <li>
						 <a href="{{ route('web.webspeedview') }}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-speedometer mr-2"></i>Web Test</a>
					  </li>
					  <li>
						 <a href="{{ route('web.httpview') }}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-file-lock mr-2"></i>Http Check</a>
					  </li>
					  <li>
						 <a href="{{ route('web.dnsview') }}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-binoculars mr-2"></i>DNS Lookup</a>
					  </li>
					  <li>
						<a href="{{ route('web.brotliview') }}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-patch-check mr-2"></i>Brotli</a>
					 </li>
					 <li>
						<a href="{{ route('web.whoisview') }}" class="flex items-center text-xs w-full p-2 text-orange-400 transition duration-75 rounded-lg pl-11 group hover:bg-orange-50 font-bold"><i style="font-size: 1em;" class="bi bi-globe2 mr-2"></i>Whois</a>
					 </li>
				</ul>
			 </li>
			 <li>
				<a href="{{ route('speed.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-orange-50 group">
				   <i style="font-size: 1em;" class="bi bi-speedometer2 text-orange-400"></i>
				   <span class="ml-3 text-orange-400 text-xs font-bold">Speed Test</span>
				</a>
			 </li>
		   </ul>
		</div>
	 </aside>
    
     
	@yield('content')



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
<script>
	// Fungsi untuk mengambil alamat IP klien dari layanan pihak ketiga
	function getUserIpAddress() {
		fetch('https://api.ipify.org?format=json')
			.then(response => response.json())
			.then(data => {
				document.getElementById('userIpAddress').textContent = data.ip;
			})
			.catch(error => {
				console.error('Gagal mengambil alamat IP:', error);
			});
	}

	// Panggil fungsi untuk mengambil dan menampilkan alamat IP saat halaman dimuat
	window.onload = getUserIpAddress();
</script>

</html>