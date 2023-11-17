@extends('layouts/app')
@section('content')

<section>
    <div class="flex justify-center" style="margin-top: 5em; margin-left: 5em;">	
        <form class="w-3/4 shadow-md my-5 py-2 px-2 bg-gray-50" method="POST" action="{{route('network.ping')}}">
            @csrf             
            <h3 class="font-black text-xs text-orange-400">Ping IPV4</h3>
            <div class="flex items-center justify-center space-x-2">
                <!-- Inputan Domain / IP -->
                <div class="relative z-0 w-full group flex-2">
                  <input type="text" name="domain" id="domain" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer text-xs" placeholder=" " required onchange="validateDomainOrIP(this.value)"/>
                  <label for="domain" style="font-size: 11px;" class="peer-focus:font-medium absolute text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Domain / IP</label>
                  <div id="error-message" class="text-red-500 mt-2"></div>
                </div>
              
                <!-- Captcha -->
                <div class="relative z-0 w-1/2 group text-sm">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaCallback" style="transform: scale(0.6);"></div>
                </div>
                
                <!-- Tombol Submit -->
                <div style="margin-right:2em; ">
                    <button  type="submit" id="submitBtn" class="cursor-not-allowed relative inline-flex items-center justify-center p-2 px-4 overflow-hidden font-bold text-orange-600 transition duration-300 ease-out border-2 border-orange-500 rounded-full shadow-md mb-5 group text-sm" disabled>
                        <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-orange-500 group-hover:translate-x-0 ease">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                        <span class="absolute flex items-center justify-center w-full h-full text-orange-500 transition-all duration-300 transform group-hover:translate-x-full ease">Kirim</span>
                        <span class="relative invisible text-sm">Kirim</span>
                    </button>
                </div>  
              </div>
              
                    @if(isset($pingResults))
                        <h2 class="text-sm font-semibold mb-4">Hasil Ping:</h2>
                        <div class="overflow-x-auto">
                            <table class="table-auto min-w-full border-collapse text-xs">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 bg-gray-200 text-left">Attempt</th>
                                        <th class="px-4 py-2 bg-gray-200 text-left">Ping Time</th>
                                        <th class="px-4 py-2 bg-gray-200 text-left">IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pingResults as $resultping)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $resultping['attempt'] }}</td>
                                            <td class="border px-4 py-2">{{ $resultping['pingTime'] }} ms</td>
                                            <td class="border px-4 py-2">{{ $resultping['ipAddress'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    {{-- @if(isset($outputrace))
                    <h2>Hasil Traceroute {{ $domain }} : </h2>
                    <pre>{{ $outputrace }}</pre>
                    @endif
                    @if(isset($outputrace6))
                    <h2>Hasil Traceroute {{ $domain }} : </h2>
                    <pre>{{ $outputrace6 }}</pre>
                    @endif
                    @if (isset($api_result))

    <h2 class="text-xl font-semibold mb-4">IP Location Information:</h2>

    <div class="overflow-x-auto">

        <table class="min-w-full bg-white border rounded-lg shadow-lg">

            <thead class="bg-gray-100">

                <tr>

                    <th class="py-2 px-4 text-left">Field</th>

                    <th class="py-2 px-4 text-left">Value</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($api_result as $key => $value)

                    <tr>

                        <td class="py-2 px-4 border-t font-bold">{{ $key }}</td>

                        <td class="py-2 px-4 border-t text-green-600">{{ is_array($value) ? json_encode($value) : $value }}</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endif

                    @if (isset($result))
                    <h2>Ping Result:</h2>
                    <p>IPv6 Address: {{ $domain }}</p>
                    <pre>{{ $result }}</pre>
                    @endif --}}

                </form>	
       
    </div>
</section>

{{-- <script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad" async defer></script> --}}
<script>
    // Callback saat reCAPTCHA selesai dicentang
    function onRecaptchaCallback() {
      const submitButton = document.getElementById('submitBtn');
      submitButton.disabled = false; // Tombol diaktifkan ketika reCAPTCHA telah dicentang
      submitButton.classList.remove('cursor-not-allowed'); // Menghapus class cursor-not-allowed
    }
  
    // Panggil fungsi untuk menonaktifkan tombol saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
      const submitButton = document.getElementById('submitBtn');
      submitButton.disabled = true;
    });
  
  </script>
{{-- 
<script>
  function submitForm() {
      var radios = document.getElementsByName("action");
      var ip = document.getElementsByName("ip");
      var selectedAction;
      var selectedIp;

      // Cari tindakan dan alamat IP yang dipilih
      for (var i = 0; i < radios.length; i++) {
          if (radios[i].checked) {
              selectedAction = radios[i].value;
              break;
          }
      }

      for (var i = 0; i < ip.length; i++) {
          if (ip[i].checked) {
              selectedIp = ip[i].value;
              break;
          }
      }

      var form = document.getElementById("myForm");

      if (selectedAction === "ping" && selectedIp === "ipv4") {
          // Arahkan form ke ping controller (untuk ping dengan IPv4)
          form.action = "/ping";
      } else if (selectedAction === "ping" && selectedIp === "ipv6") {
          // Arahkan form ke ping6 controller (untuk ping dengan IPv6)
          form.action = "/ping6";
      } else if (selectedAction === "traceroute" && selectedIp ==="ipv4") {
          // Arahkan form ke traceroute controller
          form.action = "/traceroute";
      } else if (selectedAction === "traceroute" && selectedIp ==="ipv6") {
          // Arahkan form ke traceroute controller
          form.action = "/traceroute6";
      }  
        else if (selectedAction === "ipinfo") {
          // Arahkan form ke ipinfo controller
          form.action = "/ipinfo";
      }

      form.submit();
  }
</script> --}}
<script>
    // Regex untuk validasi domain, alamat IPv4, dan alamat IPv6
    var domainRegex = /^(?:(?=[a-zA-Z0-9-]{1,63}\.)[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*\.)+[a-zA-Z]{2,63}$/;
    var ipv4Regex = /^(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
    // var ipv6Regex = /^((?:(?:(?:[a-fA-F0-9]{1,4}:){6}(?:[a-fA-F0-9]{1,4}:)?|::(?:[a-fA-F0-9]{1,4}:){5}(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4})?|(?:[a-fA-F0-9]{1,4})?::(?:[a-fA-F0-9]{1,4}:){4}(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}){0,2}|(?:[a-fA-F0-9]{1,4}){0,1}::(?:[a-fA-F0-9]{1,4}:){3}(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}){0,3}|(?:[a-fA-F0-9]{1,4}){0,2}::(?:[a-fA-F0-9]{1,4}:){2}(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}){0,4}|(?:[a-fA-F0-9]{1,4}){0,3}::(?:[a-fA-F0-9]{1,4}:)(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}){0,5}|(?:[a-fA-F0-9]{1,4}){0,4}::(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}:)(?:[a-fA-F0-9]{1,4}){0,6}|(?:[a-fA-F0-9]{1,4}){0,5}::(?:[a-fA-F0-9]{1,4}:)(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}){0,7}|(?:[a-fA-F0-9]{1,4}){0,6}::(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}){0,8}|(?:[a-fA-F0-9]{1,4}){0,7}::(?:[a-fA-F0-9]{1,4}:)(?:[a-fA-F0-9]{1,4}){0,9}|(?:[a-fA-F0-9]{1,4}){0,8}::(?:[a-fA-F0-9]{1,4}:)?(?:[a-fA-F0-9]{1,4}){0,10})(?:[a-fA-F0-9]{1,4}:[a-fA-F0-9]{1,4}|(?<=:):(?=:)|(?<=:):|:(?=:|$))|[a-fA-F0-9]{1,4}(?::[a-fA-F0-9]{1,4}){1,5}|(?:(?:(?:(?::[a-fA-F0-9]{1,4}){1,6})?:[a-fA-F0-9]{1,4})|(?:(?:(?::[a-fA-F0-9]{1,4}){1,6})?::(?:(?::[a-fA-F0-9]{1,4}){1,6})?)))(?<![^:])$/;
  
    function validateDomainOrIP(inputValue) {
      var errorMessageElement = document.getElementById("error-message");
      errorMessageElement.innerText = ""; // Hapus pesan error sebelumnya
  
      if (!domainRegex.test(inputValue) && !ipv4Regex.test(inputValue) && !ipv6Regex.test(inputValue)) {
        errorMessageElement.innerText = "Input tidak valid. Masukkan domain atau IP yang valid.";
      }
    }
  </script>
  

@endsection