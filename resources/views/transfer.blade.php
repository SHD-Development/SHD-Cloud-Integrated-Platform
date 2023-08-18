<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
</head>
<body>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('轉帳') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            
        <x-action-section>
    <x-slot name="title">
        {{ __('IPC 轉帳') }}
    </x-slot>

    <x-slot name="description">
        {{ __('IPC 是這個平台上最普及的貨幣，您可以透過這個頁面將 IPC 轉帳給其他人。') }}
    </x-slot>
    <x-slot name="content">
    <div class="flex flex-col mx-auto justify-center items-center">
    <form action="{{ route('process-transfer') }}" method="POST">
    @csrf
    <x-label for="recipient">收帳者</x-label>
    <select class="rounded-lg" style="margin-bottom:1.5rem" name="recipient" id="recipient">
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    
    <x-label for="amount">金額</x-label>
    <x-input type="number" name="amount" id="amount" step="0.01" min="0.01" max="10.00"></x-input>
    
    <x-button type="submit">轉帳</x-button>
</form>
</div>
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