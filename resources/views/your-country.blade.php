@extends('layouts.app')
<style>
    .total_block{
        margin: 20px;
        padding: 20px;
    }
    .country-block{
        margin: 20px;
        padding: 20px;
    }
    .main-chart{
        margin-bottom: 40px;
    }
</style>
@section('content')
<div class="container">
<div class="country-block">
    <h4>{{$country_confirmed->Country}}</h4>
</div>

    <div class="row">
        <div class="col-md-4">
            <div class="total_block">
                <h4>Total Confirmed Cases</h4>
                <h5>{{$country_confirmed->Cases}}</h5>
            </div>
        </div>       
        <div class="col-md-4">
            <div class="total_block">
                <h4>Total Deaths</h4>
                <h5>{{$country_deaths->Cases}}</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="total_block">
                <h4>Total Recovered</h4>
                <h5>{{$country_recovered->Cases}}</h5>
            </div>
        </div>
    </div>
    <div class="main-chart">
        <canvas id="mainChart" width="400" height="400"></canvas>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script>
    let confirmed = {!!json_encode($country_confirmed_all)!!}
    let recovered = {!!json_encode($country_recovered_all)!!}
    let deaths = {!!json_encode($country_deaths_all)!!}

    let confirmed_data = getData(confirmed)
    let confirmed_labels = getLabels(confirmed)

    let recovered_data = getData(recovered)
    let recovered_labels = getLabels(recovered)

    let deaths_data = getData(deaths)
    let deaths_labels = getLabels(deaths)

    var ctx = document.getElementById('mainChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        maintainAspectRatio: false,
        data: {
            labels: confirmed_labels,
            datasets: [{
                label: '# Confirmed',
                data: confirmed_data,
                borderWidth: 3,
                borderColor: '#00adad',
                backgroundColor: '#f4f4f4'
            },
            {
                label: '# Recovered',
                data: recovered_data,
                borderWidth: 3,
                borderColor: '#b9f384',
                backgroundColor: '#f4f4f4'
            },
            {
                label: '# Deaths',
                data: deaths_data,
                borderWidth: 3,
                borderColor: '#990000',
                backgroundColor: '#f4f4f4'
            }],
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    }});

    function getData(data){
        data_array = []
        $.each(data, function(k, v){
            data_array.push(v.Cases)
        })
        return data_array
    }

    function getLabels(data){
        labels_array = []
        $.each(data, function(k, v){
            labels_array.push(v.Date.split('T')[0])
        })
        return labels_array
    }
</script>
@endsection