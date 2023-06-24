<div class="container2">

{{ $slot }}
</div>
<style>
.container2 {
    font-size:xx-large;
    display:flex;
    padding-bottom:30vh;
    justify-content:center;
    align-items:center;
    height: 750px;
    width: 700px;
    margin-top: 10px;
    margin-left: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.3);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

</style>