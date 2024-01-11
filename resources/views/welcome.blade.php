<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Adminbigbrew</title>

    <!-- Fonts -->
    <link rel="preconnect"
        href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div class="py-2 bg-gray-100 text-gray-900 min-h-screen">

            <header class="px-5 sm:px-10 md:px-10 md:py-5 lg:px-20 flex items-center justify-between">
              <div>
                <img src="{{ asset('storage/img/bigbrew-tp-logo.png') }}" class="w-48">
              </div>
              @if (Route::has('login'))
            <livewire:welcome.navigation />
             @endif
            </header>

            <main>
              <div id="hero" class="pt-5 lg:flex items-center">
                <div class="px-5 sm:px-10 md:px-10 md:flex lg:block lg:w-1/2 lg:max-w-3xl lg:mr-8 lg:px-20">
                  <div class="md:w-1/2 md:mr-10 lg:w-full lg:mr-0">
                    <h1 class="text-3xl xl:text-4xl font-black md:leading-none xl:leading-tight">
                      Welcome to BigBrew
                    </h1>
                    <p class="mt-4 xl:mt-2">
                        BigBrew serves coffee, tea, and snacks that are "big" in taste but "bit" in price.
                    </p>
                  </div>

                  <div class="flex-1">
                  </div>
                </div>
                <div class="mt-6 w-full flex-1 lg:mt-0">
                  <div></div>
                  <img class="rounded-lg" src="{{ asset('storage/img/bigbrew-landing-img.png') }}" />
                </div>
              </div>






            </main>

            <footer class="px-5 sm:px-10 md:px-20 py-8">
              <div class="flex flex-col items-center lg:flex-row-reverse justify-between">
                <div class="">
                  <a class="mx-4 text-sm font-bold text-amber-600 hover:text-amber-800" href="#">bigbrew@gmail.com</a>
                  <!-- <a href="#">About Us</a> -->
                  <!-- <a href="#">Careers</a> -->
                </div>
                <div class="mt-4">
                  <img src="{{ asset('storage/img/bigbrew-tp-logo.png') }}" class="w-32">
                </div>
                <div class="mt-4 text-xs font-bold text-gray-500">
                  &copy; 2023 BIGBREW | All Rights Reserved
                </div>
              </div>
            </footer>
          </div>
    </div>
</body>

</html>
