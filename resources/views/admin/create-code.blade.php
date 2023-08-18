<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
    <title>Admin Panel - Code Management - Create | SHD Cloud Integrated Platform</title>
</head>
<body style="display:flex; flex-direction:column; background-color: #2c2f33; display:flex;flex-direction:row;">
<x-admin-sidebar />
<br>

<form method="POST" action="{{ route('admin.code.store') }}">
    @csrf
    <h1></h1>
    <br>
    <input type="text" name="code" placeholder="兌換代碼">
    <br>
    <input type="text" name="reward" placeholder="獎勵代幣">
    <br>
    <input type="text" name="expiration" placeholder="過期時間">
    <br>
    <input type="text" name="limit" placeholder="可兌換次數">
    <br>
    <button type="submit">新增</button>
    </form>


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

</body>
</html>
