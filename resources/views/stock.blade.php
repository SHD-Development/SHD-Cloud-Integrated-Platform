<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock | SHD Cloud Integrated Platform</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('股票系統') }}
        </h2>
    </x-slot>

<div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col flex-wrap justify-center items-center text-white" >
    <div class="bg-white dark:bg-gray-800 rounded-lg mx-auto flex flex-col justify-center items-center">
    <canvas id="stockChart" width="800" height="400">></canvas>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg mx-auto flex flex-col justify-center items-center mt-5" style="width: 50rem; height:20rem">
        <h1>股票持有數量</h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th>股票名稱</th>
                    <th>數量</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userStocks as $stock)
                    <tr>
                        <td>{{ $stock->stock->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
table {
  border-spacing: 0;
  width: 100%;
}
tr {
  text-align: center;
}
th {
  padding: 10px;
}

table thead {
  background-color: blue;
  color: white;
}
table thead th:first-child {
  border: 1px solid blue;
}
table thead th:last-child {
  border-right: 1px solid blue;
}
table tbody tr:last-child td:first-child {
  border-radius: 0 0 0 5px;
}

table tbody tr:last-child td:last-child {
  border-radius: 0 0 5px 0;
}
</style>
    

<div class="bg-white dark:bg-gray-800 rounded-lg mx-auto flex flex-col justify-center items-center mt-5" style="width: 50rem; height:20rem">
    <form class="flex flex-col justify-center items-center" action="{{ route('buy-stock') }}" method="POST">
        @csrf
        <select class="rounded-lg" name="stock_id">
            @foreach($stocks as $stock)
                <option value="{{ $stock->id }}">{{ $stock->name }}</option>
            @endforeach
        </select>
        <br>
        <x-input type="number" name="quantity" placeholder="數量"></x-input>
        <br>
        <x-button type="submit">購買</x-button>
    </form>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg mx-auto flex flex-col justify-center items-center mt-5" style="width: 50rem; height:20rem">
    <form class="flex flex-col justify-center items-center" action="{{ route('sell-stock') }}" method="POST">
    @csrf
    <select class="rounded-lg" name="stock_holding_id">
        @foreach($user->stocks as $stockHolding)
            <option value="{{ $stockHolding->id }}">{{ $stockHolding->stock->name }}</option>
        @endforeach
    </select>
    <br>
    <x-input type="number" name="quantity" placeholder="數量"></x-input>
    <br>
    <x-button type="submit">售出</x-button>
    </form>
</div>


    </x-app-layout>
    <script>
        var stockNames = {};
    @foreach($stocks as $stock)
        stockNames[{{ $stock->id }}] = '{{ $stock->name }}';
    @endforeach
        var ctx = document.getElementById('stockChart').getContext('2d');
        var apiKey = '{{ $apiKey }}'
        fetch('/api/stock/get', { headers: {'Authorization': apiKey} })  
            .then(response => response.json())
            .then(stockData => {
                
                var stockIds = Object.keys(stockData);
                var stockPrices = Object.values(stockData);

                var labels = stockPrices[0].map((_, index) => `Data ${index + 1}`);

                var datasets = stockIds.map((stockId, index) => ({
                    label: stockNames[stockId],
                    data: stockPrices[index],
                    borderColor: getRandomColor(),
                    borderWidth: 1,
                    fill: false
                }));

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true, 
                    },
                    
                });
            })
            .catch(error => console.error('Error fetching stock prices:', error));

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css
" rel="stylesheet">
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
