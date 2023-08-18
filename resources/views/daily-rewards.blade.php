<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
    <title>Daily Rewards | SHD Cloud Integrated Platform</title>
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('每日獎勵') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            
        <x-action-section>
    <x-slot name="title">
        {{ __('每日免費 IPC 代幣') }}
    </x-slot>

    <x-slot name="description">
        {{ __('IPC 是這個平台上最普及的貨幣，您也可以將其兌換成 SRM') }}
    </x-slot>

    <x-slot name="content">
        
    @if ($claimed)
    <p class="text-red-500 font-semibold">您今天已經領取了每日 IPC</p>
    @else
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('您今天還沒領取每日 IPC 呢！') }}
    </h3>

    <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ __('請點擊下方按鈕領取。') }}
            </p>
    </div>
    <div class="mt-5">
    
        <form method="POST" action="{{ route('claim-daily-reward') }}">
            @csrf
            <x-button type="submit">
                {{ __('領取') }}
            </x-button>
        </form>
    
    </div>
    @endif
    
    </x-slot>
    </x-action-section>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@include('sweetalert::alert')

@if (session('success'))
  <script>
      Swal.fire({
          title: '成功啦!',
          text: '{{ session('success') }}',
          icon: 'success',
          showConfirmButton: false,
          timer: '3000',
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
            timer: '3000',
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
            timer: '3000',
            timerProgressBar: true,
        });
    </script>
@endif
</body>
</html>