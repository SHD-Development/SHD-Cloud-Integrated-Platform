<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desktop App | SHD Cloud Integrated Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@livewire('navigation-menu')

<div class="flex flex-col justify-center items-center mt-10">
<x-authentication-card-logo class="block h-9 w-auto"  />
<h1 class="mx-auto tycswyd">體驗前所未有的</h1><h1 class="mx-auto jjjh">極致整合</h1>
<div style="margin-top: 3rem">
<a href="{{ route('download-file', ['filename' => 'SCIPSetup.exe']) }}">
<x-button2><p style="font-weight: bold;">立即下載</p></x-button2>
</a>
</div>
</div>
<style>
body {
    background: rgb(0,0,0);
}
.tycswyd {
    text-shadow: 0 10px 30px rgba(252, 252, 252, 1);
}
h1 {
    font-weight: bold;
    font-size: 96px;
    color: white;
}
.jjjh {
    font-weight: bold;
    font-size: 96px;
    background: linear-gradient(-90deg, rgba(0,254,255,1) 0%, rgba(0,255,106,1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 10px 30px rgba(0, 255, 154, 1);
}
</style> 
</body>
</html>