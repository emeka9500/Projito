<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#f1a5a5] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <!--
          This example requires updating your template:
        
          ```
          <html class="h-full bg-white">
          <body class="h-full">
          ```
        -->
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
              <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
              <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your Portal</h2>
            </div>
          
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
              <form class="space-y-6" action="/auth.login" method="POST">
                @csrf
                <div>
                  <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                  <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  </div>
                </div>
          
                <div>
                  <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="text-sm">
                      <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                  </div>
                  <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  </div>
                </div>

                {{-- @error('status')
                <span class="text-red-400 ">{{ $message }}</span>     
                @enderror --}}
          
                <div>
                  <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                </div>
              </form>
          
              <p class="mt-10 text-center text-sm/6 text-gray-500">
                Don't have an account?
                <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-500">Register Here</a>
              </p>
            </div>
          </div>
</body>
</html>