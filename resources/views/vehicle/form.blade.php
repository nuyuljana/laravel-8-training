@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vehicle') }}</div>

                <div class="card-body">

                    <h2>Car Information Form</h2>
        <form action="
        @if($edit)
        {{ route('vehicle.update', $vehicle->id) }}
        @else
        {{ route('vehicle.save') }}
        @endif"
        method="post">
            @csrf
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter Brand" value="@if($edit){{ $vehicle->brand }} @endif">
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Enter Model" value="@if($edit){{ $vehicle->model }} @endif">
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="Enter Type" value="@if($edit){{ $vehicle->type }} @endif">
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="text" class="form-control" id="year" name="year" placeholder="Enter Year" value="@if($edit){{ $vehicle->year }} @endif">
                @if($edit)
                <input type="hidden" id="vehicleId" value="{{ Crypt::encrypt($vehicle->id) }}">
                @endif
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
        <button class="btn btn-warning" id="ajaxDelete">AJAX Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    $("#ajaxDelete").on("click", function (e){
        var vehicleId = $("#vehicleId").val();
        //alert(vehicleId);

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: "/vehicle/delete/ajax/" +vehicleId ,
            success: function(data){
                alert("SUCCESS DELETE");
                window.location.href="/vehicle";
            },
            error: function() {

            }
        });
    });
</script>
@endsection
