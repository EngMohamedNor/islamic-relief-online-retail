@extends('layout')

@section('title', 'Products')

@section('content')


 








<div id="receipt">

</div>




@endsection








<script>
let id={{$id}}
 

document.addEventListener("DOMContentLoaded", function(event) { 
    $.ajax({
        url:'/api/orders/receipt/'+id,
       
       
        success:function(data){

 

let _details=``;
let i=0;
data.forEach((item)=>{
    i+=1;
      _details+=`<tr>
<td class="center">${i}</td>
<td class="left strong">${item.name}</td>
<td class="right">$${item.qty}</td>
<td class="right">$${item.price}</td>
<td class="right">$${item.sub_total}</td>
</tr>`;
})



let _html=`<div class="container" style="width:70%;margin:auto;">
  <div class="card">
<div class="card-header">
Invoice #
<strong>${data[0].id}</strong> 
  <span class="float-right"> <strong>Status:</strong> ${data[0].status}</span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
 
<div><h6 class="mb-3">FROM :</h6>
<strong>Webz Poland</strong>
</div>
<div>Madalinskiego 8</div>
<div>71-101 Szczecin, Poland</div>
<div>Email: info@webz.com.pl</div>
<div>Phone: +48 444 666 3333</div>
</div>

<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>${data[0].customer_name}</strong>
</div>
<div>${data[0].customer_address}</div>
<div>Email :${data[0].customer_email}</div>
<div>Phone: ${data[0].customer_phone}</div>
 
<div>Invoice Date: ${data[0].order_date}</div>
</div>



</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Item</th>
 
<th class="center">Qty</th>
<th class="right">Unit Price</th>

<th class="right">Total</th>
</tr>
</thead>
<tbody>

${_details}
 
 
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right"><strong>$${data[0].total}</strong></td>
</tr>
 
  
</tbody>
</table>

</div>

</div>

</div>
</div>
</div>`;

$("#receipt").html(_html);
   }
    });



});
    </script>