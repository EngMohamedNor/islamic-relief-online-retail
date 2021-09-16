@extends('layout')

@section('title', 'Cart')

@section('content')

    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $total = 0 ?>

        @if(session('cart'))
            @foreach(session('cart') as $id => $details)

                <?php $total += $details['price'] * $details['qty'] ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="qty">
                        <input type="number" value="{{ $details['qty'] }}" class="form-control quantity" />
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['qty'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
       
       
       
     

         

        </tfoot>
    </table>

 
    <table class="table table-hover table-condensed"> 
    <tr>
            <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
          
            
            

            <td>   Your Name
    <input type="text" readonly class="form-control"  value="{{ Auth::user()->name }}"/>

    Your Phone
    <input type="text"   class="form-control" id="customer_phone"/>
    Delivery Address
    <input type="text"  class="form-control" id="delivery_address"/>
</td>
<td class="text-center">
           
         
<strong>Total ${{ $total }}</strong> <hr>

    <button class="btn btn-success" style="width:100%" onclick="checkout_with_evc()" >
        Checkout with EVC Plus
</button> <br>
<button class="btn btn-primary" style="width:100%"  onclick="checkout_with_paypal()" >
        Checkout with PayPal
</button>
        </td>

        </tr>
</table>

@endsection




@section('scripts')

 
    <script type="text/javascript">


document.addEventListener("DOMContentLoaded", function(event) { 
 

});

function checkout_with_evc(){
    // validate
    if($("#delivery_address").val()=="" || $("#customer_name").val()=="" || $("#customer_phone").val()=="")
{
    
    alert("Please Enter Reuired Information, Your  Phone and Address");

return;
}

 

var dialog = bootbox.dialog({
    title: 'Processing Your Order',
   closeButton: false
, message: '<h4><i class="fa fa-spin fa-spinner"></i> Processing with Evc API .., please accept the payment from your phone... [ Here we can integrate with EVC PLUS API ]   </h4>'
});
dialog.init(function(){
    setTimeout(function(){
        dialog.find('.bootbox-body').html(`<i class='fa fa-check-circle'> </i> Successfully Paid with EVC API `);

        setTimeout(() => {
            bootbox.hideAll();
            submit_order("EVC PLUS API");
        }, 2000);
     

    }, 4000);
});

}



function checkout_with_paypal(){
    // validate
if($("#delivery_address").val()=="" || $("#customer_name").val()=="" || $("#customer_phone").val()=="")
{alert("Please Enter Reuired Information, Your  Phone and Address");

return;
}
var dialog = bootbox.dialog({
    title: 'Processing Your Order',
   closeButton: false
, message: '<h4><i class="fa fa-spin fa-spinner"></i> Processing with PAYPAL.. PLease Wait [ Here we can integrate with Paypal API ]   </h4>'
});
dialog.init(function(){
    setTimeout(function(){
        dialog.find('.bootbox-body').html(`<i class='fa fa-check-circle'> </i> Successfully Paid Paypal `);

        setTimeout(() => {
            bootbox.hideAll();
            submit_order("PAYPAL");
        }, 2000);
     

    }, 4000);
});

}


function submit_order(payment_method){
    $.ajax({
               url: '{{ url('/orders/submit-order') }}',
               method: "post",
               data: {
                   _token: '{{ csrf_token() }}', 
               delivery_address: $("#delivery_address").val(), 
               payment_method:payment_method,
              
               customer_phone:$("#customer_phone").val()
              },
               success: function (response) {
                  
                   window.location.href="/orders/receipt/"+response.order_id;
               }
            });
}

        $(".update-cart").click(function (e) {
           e.preventDefault();

           var ele = $(this);

            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>

@endsection

 