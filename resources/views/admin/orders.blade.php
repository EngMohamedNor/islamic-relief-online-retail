@extends('admin_layout')

@section('title', 'Cart')


@section('content')
 

<div id="tbl">
</div>

@endsection


@section('scripts')
<script>

let dialog=null;
document.addEventListener("DOMContentLoaded", function(event) { 
    $.ajax({
        url:'/admin/get-orders/',
       
       
        success:function(data){

 

let _details=``;
let i=0;
let total=0;
data.forEach((item)=>{
    total+=Number(item.total);
    i+=1;
      _details+=`<tr>
 
<td class="left strong">${item.id}</td>
<td class="right">${item.order_date}</td>
<td class="right">${item.customer_name}</td>
<td class="right">${item.delivery_address}</td>
<td class="right">${item.payment_method}</td>
<td class="right">${item.status}</td>
<td class="right">$${item.total}</td>
<td><div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

  <a href='/orders/receipt/${item.id}'  display:inline;' class='btn btn-info'>View Receipt</a> 
<a href='#' onclick='update_status(${item.id})' style='display:inline;' class='btn  btn-primary'>Update Status</a>
 
  </div>
</div></td>
 
</tr>`;
})



let _html=`<div class="container" style="width:100%;margin:auto;">
  <div class="card">
<div class="card-header">
Order List
</div>
 

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">Invoice #</th>
<th>Order Date/time</th>
 
<th class="center">Customer Name</th>
<th class="right">Delivery Address</th>
<th class="right">Payment Method</th>
<th class="right">Status</th>
<th class="right">Total</th>
<th class="right">Actions</th>
</tr>
</thead>
<tbody>

${_details}
 
 
</tbody>
<tfoot>
<tr>
<td colspan="5" >

</td>
<td class="right">
<strong>Total</strong>
</td>
<td class="center"><strong>$${ total.toFixed(2)}</strong></td>
</tr></tfoot>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

 

</div>

</div>
</div>
</div>`;

$("#tbl").html(_html);
   }
    });



});








function update_status(id){
     dialog = bootbox.dialog({
    title: `Update Order # ${id} status`,
   closeButton: false
, message: 
`
<a href='#' onclick="update_order_status(${id},'Open')" class="btn-sm btn-secondary" style="display:inline">Open</a>
<a href='#' onclick="update_order_status(${id},'Cancelled')" class="btn-sm btn-danger" style="display:inline">Cancelled</a>
<a href='#' onclick="update_order_status(${id},'Processing')" class="btn-sm btn-info" style="display:inline">Processing</a>
<a href='#' onclick="update_order_status(${id},'Shipped')" class="btn-sm btn-primary" style="display:inline">Shipped</a>
<a href='#' onclick="update_order_status(${id},'Delivered')" class="btn-sm btn-success" style="display:inline">Delivered</a>
`
});
dialog.init(function(){
     
});
}


function update_order_status(id,status){
    dialog.find('.bootbox-body').html(`<i class="fa fa-spin fa-spinner"></i> Updating Order status...`);
    
    $.ajax({
               url: '{{ url('/orders/update-status') }}',
               method: "post",
               data: {
              _token: '{{ csrf_token() }}', 
               id: id,
               status: status
              },
               success: function (response) {
                   if(response.success)
                   {
                    bootbox.hideAll();
                location.reload();
                   }
                   else
                   {
                    bootbox.hideAll();
                    bootbox.alert("Something went wrong ,"+ response.message)
                   }
            

               },
               error:function (error){
                   console.log(error)
                bootbox.hideAll();
                    bootbox.alert("Something went wrong , try again")
               }
            });

  
}
</script>
@endsection