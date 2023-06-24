<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - Index | SHD Cloud Integrated Platform</title>
</head>
<body style="
background-color: #2c2f33; 
font-family: sans-serif; 
color:white;
display:flex;
flex-direction: row;
">

  <x-admin-sidebar />
  <x-admin-container-1>
  <h1 style="margin:10px">已註冊人數</h1>
  <div style="display:flex;align-items:center;justify-content:center;font-size:xx-large;"><h2>{{ $usersCount }}</h2></div>
  </x-admin-container-1>
</body>
</html>