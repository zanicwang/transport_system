

<div class="all_locations_div">
    <label>All locations</label>
    <button class="btn">
        <i class="left_arrow"><</i>
    </button>
</div>

<div class="filter_div">
    <input type="text" placeholder="Filter"/>
    <a href="" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-sort"></span> Sort
    </a>
</div>
afdeling
<div class="address_match_div">
    @foreach($orders as $order)
    <div class="row">
        <label>{{$order->address}}, {{$order->zipcode}} {{$order->town}}</label>
        <select id="select" style="">
            <option style="background-color:lightred">Aarhus</option>
            <option style="background-color:lightblue">Viborg</option>
            <option style="background-color:lightgreen">Videbak</option>
            <option style="background-color:purple">Varde</option>
            <option style="background-color:green">Ulfborg</option>
            <option style="background-color:darkyellow">Ringkobing</option>
            <option style="background-color:lightgrey">Not asigned</option>
            <option style="background-color:black">Delivered</option>
        </select>
    </div>
    @endforeach
</div>
