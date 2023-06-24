
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - User Management - Create | SHD Cloud Integrated Platform</title>
</head>
<body style="
background-color: #2c2f33; 
font-family: sans-serif; 
color:white;
display:flex;
flex-direction: row;
">
  <x-admin-sidebar />
  <x-admin-container-2>
  <form method="POST" action="{{ route('admin.user.store') }}" class="create-form">
  @csrf
  <style media="screen">
    

.create-form{
    height: 520px;
    width: 400px;
    background-color: #ffffff;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
.create-form *{
    font-family: 'Poppins',sans-serif;
    color: gray;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
.create-form{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

.lb{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
.inputslot{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
    border: 2px solid gray;
}
::placeholder{
    color: #e5e5e5;
}
.create-btn{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}


    </style>
  <div style="margin-bottom:30px">
    <label for="email" class="lb">Email</label>
    <input type="email" name="email" id="email" class="inputslot" required>
  </div>
  
  <div style="margin-bottom:30px">
    <label for="name" class="lb">Username</label>
    <input type="text" name="name" id="name" class="inputslot" required>
  </div>
  
  <div style="margin-bottom:30px">
    <label for="password" class="lb">Password</label>
    <input type="password" name="password" id="password" class="inputslot" required>
  </div>
  
  <div style="margin-bottom: 30px">
    <label for="role" class="lb">Role</label>
    <select name="role[]" id="role" multiple>
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>


  
  <button type="submit" class="create-btn">Create User</button>
</form>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
  </x-admin-container-2>
  <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
@include('sweetalert::alert')

  @if (session('success'))
    <script>
        Swal.fire({
            title: 'Success',
            text: '{{ session('success') }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 3000 
        });
    </script>
@endif

</body>
</html>