<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SHD Cloud Integrated Platform</title>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('儀表板') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
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

