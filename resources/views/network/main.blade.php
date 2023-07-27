@extends('layouts/app')
@section('content')
<section>
    <div class="flex justify-center mt-28">	
<form class="w-1/2 shadow-md my-5 py-5 px-5 bg-gray-50" method="POST" id="myForm">
            @csrf
                <img src="/img/logo/jh.png" alt="Image" width="50" height="50" class="mx-auto mb-4 mt-5 rounded-full">
                <div class="grid mb-10 w-full place-items-center">
                  <div class="grid md:w-[40rem] grid-cols-1 md:grid-cols-3 gap-2 rounded-xl bg-gray-50 shadow-md p-2 mt-2">
                    <div>
                        <input type="radio" id="1" value="ping" name="action" class="peer hidden" checked />
                        <label for="1" class="block cursor-pointer select-none rounded-xl p-2 text-center">Ping</label>
                    </div>
                    <div>
                        <input type="radio" id="2" value="traceroute" name="action" class="peer hidden" />
                        <label for="2" class="block cursor-pointer select-none rounded-xl p-2 text-center">Traceroute</label>
                    </div>
                    <div>
                        <input type="radio" id="3" value="dnslookup" name="action" class="peer hidden" />
                        <label for="3" class="block cursor-pointer select-none rounded-xl p-2 text-center">DNS Lookup</label>
                    </div>
                  </div>
                </div> 
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="domain" id="domain" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" " required onchange="validateDomainOrIP()"/>
                        <label for="domain" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Domain / IP</label>
                        <div id="error-message" class="text-red-500 mt-2"></div>
                    </div>
                    {{-- <div class="g-recaptcha relative z-0 w-full mb-6 group" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    <div class="flex items-start mb-6">			
                    </div> --}}
                    <button onclick="submitForm()" type="submit" id="submitBtn" class="relative inline-flex items-center justify-center p-5 px-6 py-2 overflow-hidden font-bold text-orange-600 transition duration-300 ease-out border-2 border-orange-500 rounded-full shadow-md group">
                        <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-orange-500 group-hover:translate-x-0 ease">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                        <span class="absolute flex items-center justify-center w-full h-full text-orange-500 transition-all duration-300 transform group-hover:translate-x-full ease">Kirim</span>
                        <span class="relative invisible">Kirim</span>
                    </button>
                    @if(isset($output))
                    <h2>Hasil Ping:</h2>    
                    <pre>{{ $output }}</pre>
                    @endif
                    @if(isset($outputrace))
                    <h2>Hasil Traceroute {{ $domain }} : </h2>
                    <pre>{{ $outputrace }}</pre>
                    @endif
                    
                    {{-- @if (isset($ipAddresses))
                    @foreach ($ipAddresses as $ipType => $ipList)
                        <p>{{ $ipType }}</p>
                        <ul>
                            @foreach ($ipList as $ip)
                                <li>{{ $ip }}</li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif --}}
                @if (isset($resultdns))
                    <div>
                        <h2>Hasil Dns Lookup:</h2>
                        <pre>
                            {{ json_encode($resultdns, JSON_PRETTY_PRINT) }}
                        </pre>
                    </div>
                @endif
                </form>	
       
    </div>
</section>


<script>
    function submitForm() {
      var radios = document.getElementsByName("action");
    //   var radios = document.getElementsByName("action");
      var selectedAction;

      for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
          selectedAction = radios[i].value;
          break;
        }
      }

      var form = document.getElementById("myForm");

      if (selectedAction === "ping") {
        // Arahkan form ke ping controller
        form.action = "/ping";
      } else if (selectedAction === "traceroute") {
        // Arahkan form ke traceroute controller
        form.action = "/traceroute";
      } else if (selectedAction === "dnslookup") {
        // Arahkan form ke dnslookup controller
        form.action = "/dnslookup";
      }

      form.submit();
    }
  </script>
@endsection