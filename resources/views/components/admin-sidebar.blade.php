<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /><div style="background-color: #5865f2; width:300px; height:300vh; border-radius:15px; display:flex; justify-content:center;box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.3);flex-direction-column;">

<link href="https://cdn.jsdelivr.net/npm/font-awesome-animation@1.1.1/css/font-awesome-animation.min.css" rel="stylesheet">
<div style="display:flex;flex-direction:column;align-items:center;">
        <h1 style="font-family:sans-serif;color:white">SHD Cloud</h1>
        <h3 style="font-family:sans-serif;color:white">歡迎回來! {{ Auth::user()->name }}</h2>
        <hr style="width:15vw">
        <a href="" class="btnop faa-parent animated-hover"><p class="faa-tada animated-hover" style="display:flex;align-items:center;justify-content:center;height:0px"><i class="fa-solid fa-house-chimney"></i>&nbsp;主頁</p></a>
        <p style="color:#AAAFC1;">系統管理</p>
        <a href="/admin/apikey" class="btnop faa-parent animated-hover"><p class="faa-tada animated-hover" style="display:flex;align-items:center;justify-content:center;height:0px"><i class="fa-solid fa-key"></i>&nbsp;金鑰</p></a>
        <p style="color:#AAAFC1;">用戶管理</p>
        <a href="/admin/user/create" class="btnop faa-parent animated-hover"><p class="faa-tada animated-hover" style="display:flex;align-items:center;justify-content:center;height:0px"><i class="fa-solid fa-user-plus bounce"></i>&nbsp;新增</p></a>
        <a href="" class="btnop faa-parent animated-hover"><p class="faa-tada animated-hover" style="display:flex;align-items:center;justify-content:center;height:0px"><i class="fa-solid fa-user-minus"></i>&nbsp;移除</p></a>
        <a href="" class="btnop faa-parent animated-hover"><p class="faa-tada animated-hover" style="display:flex;align-items:center;justify-content:center;height:0px"><i class="fa-solid fa-user-pen"></i>&nbsp;更改</p></a>
        <a href="" class="btnop faa-parent animated-hover"><p class="faa-tada animated-hover" style="display:flex;align-items:center;justify-content:center;height:0px"><i class="fa-solid fa-users"></i>&nbsp;列表</p></a>
        <p style="color:#AAAFC1;">代碼管理</p>
        <a href="/admin/code/create" class="btnop faa-parent animated-hover"><p class="faa-tada animated-hover" style="display:flex;align-items:center;justify-content:center;height:0px"><i class="fa-solid fa-tag"></i>&nbsp;新增</p></a>
    </div>
    <style>
        .btnop{
            background-color: margin-top:3px;transition:0.4s;width:200px;margin-bottom:3px;color: #ffffff; font-size: 18px; font-style: normal; text-decoration: none; padding: 14px 15px; border: 0px solid #000; border-radius: 0px;display: flex; align-items:center;justify-content:center;;
        }
        .btnop:hover{
            color:#ffffff;
            background-color: #7289da;
            border-radius:15px;
        }
        
    
    </style>
</div>