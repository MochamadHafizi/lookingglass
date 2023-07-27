@extends('layouts/app')
@section('content')
<section>
    <div class="flex justify-center mt-28">	
        <form class="w-1/2 shadow-md my-5 py-5 px-5 bg-gray-50" method="POST" action="{{ route('web.post') }}" id="myForm">
            @csrf
                <img src="/img/logo/jh.png" alt="Image" width="50" height="50" class="mx-auto mb-4 mt-5 rounded-full">
                    <div class="relative z-0 w-full mb-6 group">
                        <input value="{{ $domain }}" type="text" name="domain" id="domain" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-orange-500 peer" placeholder=" " required/>
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
                    @if ($result)
                    <div>
                        <h2>Hasil Whois:</h2>
                        <pre>
                            {{ json_encode($result, JSON_PRETTY_PRINT) }}
                        </pre>
                    </div>
                @endif
                </form>	
       
    </div>
</section>

@endsection