<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
    <title>Account Linking | SHD Cloud Integrated Platform</title>
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('帳號綁定') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            
        <x-action-section>
    <x-slot name="title">
        {{ __('Discord 帳號綁定') }}
    </x-slot>

    <x-slot name="description">
        {{ __('綁定您的 Discord 帳號以開啟更多功能') }}
    </x-slot>

    <x-slot name="content">
        
    @if ($user->discord_id)
    <p class="text-green-500 font-semibold">您已經綁定 Discord 帳號</p>
    @else
    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
    {{ __('您還沒有綁定 Discord 帳號。') }}
    </h3>

    <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ __('點擊下方的按鈕進行綁定，綁定後可解鎖更多功能。') }}
            </p>
    </div>
    <div class="mt-5">
    <x-button onclick="location.href='/link/discord'">
                    {{ __('綁定') }}
    </x-button>
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
          timer: '3000'
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
            timer: '3000'
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
            timer: '3000'
        });
    </script>
@endif
</body>
</html>