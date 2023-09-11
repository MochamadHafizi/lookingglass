@extends('layouts/app')
@section('content')

<section>
    <div class="flex justify-center" style="margin-top: 5em; margin-left: 5em;">	
        <form class="w-3/4 shadow-md my-5 py-2 px-2 bg-gray-50" method="POST" action="{{route('web.brotli')}}">
            @csrf             
            <h3 class="font-black text-xs text-orange-400">Brotli Checker</h3>
            <div class="flex items-center">
                <!-- Inputan Domain / IP -->
                <div class="relative z-0 w-full group flex-1">
                  <input type="text" name="requestUrl" id="domain" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer text-xs" placeholder=" " required onchange="validateDomainOrIP(this.value)"/>
                  <label for="domain" style="font-size: 11px;" class="peer-focus:font-medium absolute text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Masukan URL</label>
                  <div id="error-message" class="text-red-500 mt-2"></div>
                </div>
              
                <!-- Captcha -->
                <div class="relative z-0 w-1/2 group text-sm">
                    <div class="ml-2 g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaCallback" style="transform: scale(0.6);"></div>
                </div>
                
                <!-- Tombol Submit -->
                <button style="margin-left: -7em;" type="submit" id="submitBtn" class="cursor-not-allowed relative inline-flex items-center justify-center p-2 px-4 overflow-hidden font-bold text-orange-600 transition duration-300 ease-out border-2 border-orange-500 rounded-full shadow-md mb-5 group text-sm" disabled>
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-orange-500 group-hover:translate-x-0 ease">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                    <span class="absolute flex items-center justify-center w-full h-full text-orange-500 transition-all duration-300 transform group-hover:translate-x-full ease">Kirim</span>
                    <span class="relative invisible text-sm">Kirim</span>
                  </button>
                  
              </div>
              @if (isset($isBrotliCompressed) == true)
              @if (isset($isBrotliCompressed))
              <div class="bg-green-100 mt-5 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                  <strong class="font-bold text-xs">URL domain menggunakan kompresi Brotli</strong>
                  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                  </span>
                </div>
              @else
              <div class="bg-red-100 mt-5 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                  <strong class="font-bold text-xs">URL domain tidak menggunakan kompresi Brotli</strong>
                  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                  </span>
                </div>
              @endif
          @endif
 

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