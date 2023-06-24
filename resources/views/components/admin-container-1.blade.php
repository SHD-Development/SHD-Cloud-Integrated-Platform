<div class="container">
{{ $slot }}
</div>
<style>
.container {
    height: 200px;
    width: 350px;
    margin: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 15px 15px 15px -3px rgba(0,0,0,0.3);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

</style>