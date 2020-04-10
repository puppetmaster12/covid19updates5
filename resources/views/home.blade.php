@extends('layouts.app')
<style>
    .total_block{
        margin: 20px;
        padding: 20px;
    }
    /* .dataTable{
        table-layout: fixed;
        overflow-x: auto;
        white-space: nowrap;
    } */
    .container{
        margin-bottom: 40px;
    }
    /* .dataTable td, th{
        text-overflow: scroll;
    } */
</style>
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="total_block">
                    <h4>Total Confirmed Cases</h4>
                    <h5>{{$total_confirmed}}</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="total_block">
                    <h4>Total Deaths</h4>
                    <h5>{{$total_deaths}}</h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="total_block">
                    <h4>Total Recovered</h4>
                    <h5>{{$total_recovered}}</h5>
                </div>
            </div>
        </div>
        <table id="countries" class="table dataTable" width="100%;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Country</th>
                <th scope="col">New Confirmed</th>
                <th scope="col">Total Confirmed</th>
                <th scope="col">New Deaths</th>
                <th scope="col">Total Deaths</th>
                <th scope="col">New Recovered</th>
                <th scope="col">Total Recovered</th>
              </tr>
            </thead>
            <tbody class="country-data">
              
            </tbody>
          </table>
    </div>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<script>
    
    var datatable = $('.dataTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: '{{('get-all-countries')}}',
      columns: [
          {data: 'Country', name: 'Country'},
          {data: 'NewConfirmed', name: 'NewConfirmed'},
          {data: 'TotalConfirmed', name: 'TotalConfirmed'},
          {data: 'NewDeaths', name: 'NewDeaths'},
          {data: 'TotalDeaths', name: 'TotalDeaths'},
          {data: 'NewRecovered', name: 'NewRecovered'},
          {data: 'TotalRecovered', name: 'TotalRecovered'},
          
      ]
    });
</script>
@endsection