<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>兌換代碼頁面</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">



</head>
<body>

<header>
    <h1>兌換代碼頁面</h1>
      <form method="POST" action="{{ route('redeem-code') }}">
    @csrf
    <input type="text" name="code" placeholder="輸入兌換代碼">
    <br>
    <button type="submit">兌換</button>
</form>
  </header>
  
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
</body>
</html>
