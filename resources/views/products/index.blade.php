@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <img src="{{Storage::url($product->image)}}" class="card-img-top" alt="{{$product->name}}">
                    <h1 class="card-title">{{$product->name}}</h1>
                    <p class="card-text">{{$product->description}}</p>
                    <p class="card-text">{{$product->price}}</p>
                </div>
            </div>
            <div class="shipping">
                <form action="" method="post">
                    @csrf
                    <h2>Shipping Information</h2>
                    <div>
                        <label for="origin">Origin</label>
                        <select name="origin" id="origin" class="form-control">
                            <option value="">Choose an origin</option>
                            @foreach($cities as $city)
                            <option value="{{$city['city_id']}}">{{$city['city_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="destination">Destination</label>
                        <select name="destination" id="destination" class="form-control">
                            <option value="">Choose a destination</option>
                            @foreach($cities as $city)
                            <option value="{{$city['city_id']}}">{{$city['city_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="weight">Weight</label>
                        <input type="text" name="weight" id="weight" class="form-control">
                    </div>
                    <div>
                        <label for="courier">Courier</label>
                        <select name="courier" id="courier" class="form-control">
                            <option value="">Choose a courier</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="checkCost" class="btn btn-primary w-100">Get Shipping Cost Data</button>
                    </div>
                </form>
                <div>
                    @if(isset($resultCost))
                    <h2>Shipping Cost</h2>
                    <p>Courier: {{$resultCost['results'][0]['name']}}</p>
                    <p>Origin: {{$resultCost['origin_details']['city_name']}}</p>
                    <p>Destination: {{$resultCost['destination_details']['city_name']}}</p>
                    <p>Weight: {{$resultCost['query']['weight']}} gram</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Cost</th>
                                <th>Estimation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultCost['results'][0]['costs'] as $cost)
                            <tr>
                                <td>{{$cost['service']}}</td>
                                <td>{{$cost['description']}}</td>
                                <td>{{$cost['cost'][0]['value']}}</td>
                                <td>{{$cost['cost'][0]['etd']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" name="checkout" class="btn btn-primary w-100">Checkout</button>
            </div>
        </div>
    </div>
</div>
@endsection