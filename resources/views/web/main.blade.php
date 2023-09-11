@extends('layouts/app')
@section('content')
<section>
    <div class="flex justify-center mt-28">	
        <form class="w-1/2 shadow-md my-5 py-5 px-5 bg-gray-50" method="POST" id="myForm">
            @csrf
                <div class="relative z-0 w-full mb-6 group">
                        <input value="" type="text" name="requestUrl" id="domain" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" " required  onchange="validateDomainOrIP(this.value)"/>
                        <label for="domain" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-orange-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Domain / URL</label>
                        {{-- <div id="error-message" class="text-red-500 mt-2"></div> --}}
                    </div>
                    <div class="g-recaptcha relative z-0 w-full mb-6 group" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaCallback"></div>
                    <div class="flex items-start mb-6"></div>
                    <button onclick="submitForm()" type="submit" id="submitBtn" class="cursor-not-allowed relative inline-flex items-center justify-center p-5 px-6 py-2 overflow-hidden font-bold text-orange-600 transition duration-300 ease-out border-2 border-orange-500 rounded-full shadow-md group" disabled>
                    <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-orange-500 group-hover:translate-x-0 ease">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </span>
                    <span class="absolute flex items-center justify-center w-full h-full text-orange-500 transition-all duration-300 transform group-hover:translate-x-full ease">Kirim</span>
                    <span class="relative invisible">Kirim</span>
                    </button>
                    @if (isset($result))
                        <h2 class="text-xl font-semibold mb-4">Domain WHOIS Information:</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border rounded-lg shadow-lg">
                                <tbody>
                                    @foreach ($result as $key => $value)
                                        @if ($key === 'billing')
                                            @continue
                                        @endif
                                        @if (is_array($value))
                                            <tr>
                                                <td colspan="2" class="py-2 px-4 bg-gray-100 font-semibold">{{ $key }}</td>
                                            </tr>
                                            @foreach ($value as $innerKey => $innerValue)
                                                <tr>
                                                    <td class="py-2 px-4 border-t">{{ $innerKey }}</td>
                                                    <td class="py-2 px-4 border-t">{{ $innerValue }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="py-2 px-4 border-t">{{ $key }}</td>
                                                <td class="py-2 px-4 border-t">{{ $value }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(isset($hasilhttp))
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border rounded-lg shadow-lg">
                            <tbody>
                                @foreach ($hasilhttp as $key => $value)
                                    <tr>
                                        <td class="py-2 px-4 bg-gray-100 font-semibold">{{ $key }}</td>
                                        <td class="py-2 px-4">
                                            @if (is_array($value))
                                                <pre>{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
                                            @else
                                                {{ $value }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                    @if (isset($isBrotliCompressed) == true)
                        @if (isset($isBrotliCompressed))
                        <div class="bg-green-100 mt-5 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">URL domain menggunakan kompresi Brotli</strong>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                              <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                          </div>
                        @else
                        <div class="bg-red-100 mt-5 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">URL domain tidak menggunakan kompresi Brotli</strong>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                              <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                          </div>
                        @endif
                    @endif
                    @if(isset($resultdns))
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg shadow-lg">
            <tbody>
                @php
                    $groupedRecords = [];
                    foreach ($resultdns as $record) {
                        $recordType = $record['record_type'];
                        unset($record['record_type']);
                        if (!isset($groupedRecords[$recordType])) {
                            $groupedRecords[$recordType] = [];
                        }
                        $groupedRecords[$recordType][] = $record;
                    }
                @endphp

                @foreach ($groupedRecords as $recordType => $records)
                    <tr>
                        <td colspan="2" class="py-2 px-4 bg-gray-100 font-semibold">{{ $recordType }}</td>
                    </tr>
                    @foreach ($records as $record)
                        @foreach ($record as $key => $value)
                            <tr>
                                <td class="py-2 px-4 bg-gray-100 font-semibold">{{ $key }}</td>
                                <td class="py-2 px-4">{{ $value }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@if(isset($pageSpeedData))
            <p class="mb-2">URL: {{ $pageSpeedData['id'] }}</p>
            <p class="mb-4">Performance Score: {{ $pageSpeedData['lighthouseResult']['categories']['performance']['score'] }}</p>
            
            <h2 class="text-lg font-semibold mb-2">Page Stats</h2>
            <ul class="list-disc pl-6 mb-4">
                <li>First Contentful Paint: {{ $pageSpeedData['loadingExperience']['metrics']['FIRST_CONTENTFUL_PAINT_MS']['percentile'] }} ms</li>
                <li>First Input Delay: {{ $pageSpeedData['loadingExperience']['metrics']['FIRST_INPUT_DELAY_MS']['percentile'] }} ms</li>
                <!-- Add more page stats as needed -->
            </ul>

            <h2 class="text-lg font-semibold mb-2">Opportunities for Improvement</h2>
            @foreach($pageSpeedData['lighthouseResult']['audits'] as $audit)
                @if($audit['score'] < 1)
                    <div class="mb-4">
                        <p class="text-red-600 font-semibold">{{ $audit['title'] }} - Score: {{ $audit['score'] }}</p>
                        <p>{{ $audit['description'] }}</p>
                    </div>
                @endif
            @endforeach
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

      if (selectedAction === "wst") {
        // Arahkan form ke ping controller
        form.action = "/wst";
      } else if (selectedAction === "pt") {
        // Arahkan form ke traceroute controller
        form.action = "/pt";
      } else if (selectedAction === "httphc") {
        // Arahkan form ke dnslookup controller
        form.action = "/httphc";
      } else if (selectedAction === "dnslookup") {
        // Arahkan form ke dnslookup controller
        form.action = "/dnslookup";
      } else if (selectedAction === "brotli") {
        // Arahkan form ke dnslookup controller
        form.action = "/brotli";
      } else if (selectedAction === "whois") {
        // Arahkan form ke dnslookup controller
        form.action = "/whois";
      }

      form.submit();
    }
  </script>
  {{-- <script>
    var domainRegex = /^(?:(?=[a-zA-Z0-9-]{1,63}\.)[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*\.)+[a-zA-Z]{2,63}$/;
    var ipv4Regex = /^(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
    var ipv6Regex = /^(?:[a-fA-F0-9]{1,4}:){7}[a-fA-F0-9]{1,4}$/;
  
    function validateDomainOrIP(inputValue) {
        var errorMessageElement = document.getElementById("error-message");
        errorMessageElement.innerText = ""; // Hapus pesan error sebelumnya
  
        if (!domainRegex.test(inputValue) && !ipv4Regex.test(inputValue) && !ipv6Regex.test(inputValue)) {
            errorMessageElement.innerText = "Input tidak valid. Masukkan domain atau IP yang valid.";
        }
    }
  </script> --}}

@endsection