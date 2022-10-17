@extends('user.layout.master');
@section('pageInfo','Shopping Cart')
@section('category')
    <div class="navbar-nav w-100">
        <a href="" class="nav-item nav-link">There is no category for this page</a>
    </div>
@endsection
@section('searchbar')
    <form action="{{ route('user#home') }}" method="get">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for products">
            <div class="input-group-append">
                <span class="input-group-text bg-transparent text-primary">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
    </form>
@endsection
@section('pages')
    <a href="{{ route('user#home') }}" class="nav-item nav-link ">Home</a>
    <a href="{{ route('user#shoppingCartPage') }}" class="nav-item nav-link active">My Cart</a>
    <a href="{{ route('user#orderHistory') }}" class="nav-item nav-link ">Orders</a>
    <a href="{{ route('user#contactPage') }}" class="nav-item nav-link">Contact</a>
@endsection
@section('content')
<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($data as $row)
                            <tr class=" product-row">
                                <td class=" text-start"><img src="{{ asset('storage/'.$row->image) }}" alt="" style="width: 50px;"> {{ $row->name }}</td>
                                <td class="align-middle">${{ $row->price }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class=" h-100 btn btn-sm btn-warning btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" min="0" class="form-control form-control-sm bg-secondary border-0 countItem text-center" value="{{ $row->qty }}">
                                        <div class="input-group-btn">
                                            <button class=" h-100 btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <input class=" d-none eachId" type="number" value="{{ $row->id }}">
                                <input class=" d-none eachTotal" type="number" value="{{ $row->qty * $row->price }}">
                                <input class="d-none user-id" type="number" value="{{ Auth::user()->id }}">
                                <input class="d-none product-id" type="number" value="{{ $row->product_id }}">
                                <input class=" d-none productPrice" type="number" value="{{ $row->price }}">
                                <td class="align-middle tableEachTotal">${{ $row->qty * $row->price }}</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h4 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h4>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">0</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">$8</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id='finalTotal'>0</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3 order-btn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-dark font-weight-bold my-3 py-3 clear-btn">Remove All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Cart End -->
@endsection
@section('scriptSource')
    <script>
            $(document).ready(function(){
                $('.quantity button').on('click', function () {
            var button = $(this);
            var oldValue = button.parent().parent().find('#Product_qty').val();
            if (button.hasClass('btn-plus')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            button.parent().parent().find('#Product_qty').val(newVal);
            });
            let idGroup = document.getElementsByClassName('eachId');//all tr rows id
            let productRow = document.getElementsByClassName('product-row');//all tr rows in foreach loop
            let minusBtnGroup = document.getElementsByClassName('btn-minus');//all minus-btns
            let plusBtnGroup = document.getElementsByClassName('btn-plus');//all plus-btns
            let removeBtnGroup = document.getElementsByClassName('btn-remove');//all remove-btns
            let countGroup = document.getElementsByClassName('countItem');//count input
            let eachTotal = document.getElementsByClassName('eachTotal');//to get each product total price
            let productPrice = document.getElementsByClassName('productPrice');//to get product price
            let tableEachTotal = document.getElementsByClassName('tableEachTotal');//to insert each product total price
            let userIdGroup = document.getElementsByClassName('user-id');//to get each user-id
            let productIdGroup = document.getElementsByClassName('product-id');//to get each product-id
            let subTotal;//to insert subtotal
            let orderList = [];
            let getSubTotal = function(){
                subTotal = 0;
                for (let i = 0; i < eachTotal.length; i++) {
                    subTotal += Number(eachTotal[i].value);
                }
                $('#subTotal').html('$'+subTotal);//to insert subtotal
                $('#finalTotal').html('$'+(subTotal + 8));// all cost with delivery fee
            }

            // function for don't repeat myself
            let mainProcess = function(i){
                let total = (Number(countGroup[i].value) * Number(productPrice[i].value));
                    tableEachTotal[i].innerText = ('$'+ total);
                    eachTotal[i].value = total;
            }

            // remove function
            let remove = function(i){
                productRow[i].classList.add('d-none');
                countGroup[i].value = 0;//qty is 0 all price for this product is also 0
                mainProcess(i);
                getSubTotal();
            }

            // qty change method
            let qtyChange = function(i){
                $request = {
                        'id' : idGroup[i].value,
                        'qty' : countGroup[i].value
                    }
                    $.ajax({
                        type : 'get',
                        url : '/ajax/qtyChange',
                        data : $request,
                        dataType : 'json',
                    })
            }
             // for loop start
            getSubTotal();
            for (let i = 0; i < countGroup.length; i++) {
                // add event for each plus btns
                plusBtnGroup[i].addEventListener('click',function(){
                    countGroup[i].value = Number(countGroup[i].value) + 1;
                    mainProcess(i);
                    getSubTotal();
                    qtyChange(i);
                });
                // add event for each minus btns
                minusBtnGroup[i].addEventListener('click',function(){
                    if (countGroup[i].value == 0) {
                        return
                    }
                    countGroup[i].value = Number(countGroup[i].value) - 1;
                    mainProcess(i);
                    getSubTotal();
                    qtyChange(i);
                });

                 // add event for each remove btns
                removeBtnGroup[i].addEventListener('click',function(){
                    remove(i);
                    $.ajax({
                        type : 'get',
                        url : '/ajax/remove',
                        data : {'id': idGroup[i].value},
                        dataType : 'json',
                    })
                })
            }
            // for loop end

            $('.order-btn').click(function(){
                $random = Math.floor(Math.random()*1000001);
            for (let i = 0; i < productRow.length; i++) {
                $total = (Number(countGroup[i].value) * Number(productPrice[i].value));
                orderList.push({
                    'user_id' : Number(userIdGroup[i].value),
                    'product_id' : productIdGroup[i].value,
                    'qty' : countGroup[i].value,
                    'total' : $total,
                    'order_code' : $random
                })
            }

            $.ajax({
                type : 'get',
                url : '/ajax/order/process',
                data : Object.assign({},orderList),
                dataType: 'json',
                success : function(response){
                    if (response.status == 'success') {
                        window.location.href = 'http://127.0.0.1:8000/user/home';
                    }
                }
            })
        })

        $('.clear-btn').click(function(){
            for (let i = 0; i < productRow.length; i++) {
                remove(i);
            }
            $.ajax({
                type : 'get',
                url : '/ajax/clearCart',
            })
        })

        })
    </script>
@endsection
