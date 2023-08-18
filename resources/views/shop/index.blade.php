<!DOCTYPE html>
<html>
<head>
    <title>Shop | SHD Cloud Integrated Platform</title>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
</head>
<body>
@livewire('navigation-menu')

                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('商店') }}
        </h2>
                    </div>
                </header>
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col flex-wrap justify-center items-center text-white" style="padding-bottom:3rem">
    @foreach ($products as $product)
        <div class="bg-white dark:bg-gray-800 rounded-lg mx-auto flex flex-col justify-center items-center" style="margin-top:3rem; width:70vw; padding:1rem;">
            <h1>{{ $product->name }}</h1>
            <br>
            <p>{{ $product->description }}</p>
            <br>
            <p>價格：{{ $product->price }} $IPC</p>
            <br>
            @if ($hasDiscordId)
                <form class="mx-auto flex flex-col justify-center items-center" method="POST" action="{{ route('shop.buy', $product) }}">
                    @csrf
                    <x-label for="quantity">數量：
                    <x-input type="number" name="quantity" min="1" value="1" />
                    </x-label>
                    <br>
                    <x-button class="mx-auto" type="submit">購買</x-button>
                </form>
            @else
                <p class="text-red-500 font-semibold">請登入並綁定 Discord 帳號後再進行購買</p>
            @endif
        </div>
    @endforeach
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('modals')
    @livewireScripts
@include('sweetalert::alert')

@if (session('success'))
  <script>
      Swal.fire({
          title: '成功啦!',
          text: '{{ session('success') }}',
          icon: 'success',
          showConfirmButton: false,
          timer: '5000',
          timerProgressBar: true,
      });
  </script>
@endif

  @if (session('error'))
    <script>
        Swal.fire({
            title: '哎呀, 出錯了!',
            text: '{{ session('error') }}',
            icon: 'error',
            showConfirmButton: false,
            timer: '5000',
            timerProgressBar: true,
        });
    </script>
@endif
@if (session('info'))
    <script>
        Swal.fire({
            title: '提醒您!',
            text: '{{ session('info') }}',
            icon: 'info',
            showConfirmButton: false,
            timer: '5000',
            timerProgressBar: true,
        });
    </script>
@endif
</body>

</html>
