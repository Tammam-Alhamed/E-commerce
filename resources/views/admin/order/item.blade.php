<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">


    <title>shop product detail - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #eee;
        }

        /*panel*/
        .panel {
            border: none;
            box-shadow: none;
        }

        .panel-heading {
            border-color: #eff2f7;
            font-size: 16px;
            font-weight: 300;
        }

        .panel-title {
            color: #2A3542;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 0;
            margin-top: 0;
            font-family: 'Open Sans', sans-serif;
        }

        /*product list*/

        .prod-cat li a {
            border-bottom: 1px dashed #d9d9d9;
        }

        .prod-cat li a {
            color: #3b3b3b;
        }

        .prod-cat li ul {
            margin-left: 30px;
        }

        .prod-cat li ul li a {
            border-bottom: none;
        }

        .prod-cat li ul li a:hover,
        .prod-cat li ul li a:focus,
        .prod-cat li ul li.active a,
        .prod-cat li a:hover,
        .prod-cat li a:focus,
        .prod-cat li a.active {
            background: none;
            color: #ff7261;
        }

        .pro-lab {
            margin-right: 20px;
            font-weight: normal;
        }

        .pro-sort {
            padding-right: 20px;
            float: left;
        }

        .pro-page-list {
            margin: 5px 0 0 0;
        }

        .product-list img {
            width: 100%;
            border-radius: 4px 4px 0 0;
            -webkit-border-radius: 4px 4px 0 0;
        }

        .product-list .pro-img-box {
            position: relative;
        }

        .adtocart {
            background: #fc5959;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            color: #fff;
            display: inline-block;
            text-align: center;
            border: 3px solid #fff;
            left: 45%;
            bottom: -25px;
            position: absolute;
        }

        .adtocart i {
            color: #fff;
            font-size: 25px;
            line-height: 42px;
        }

        .pro-title {
            color: #5A5A5A;
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
        }

        .product-list .price {
            color: #fc5959;
            font-size: 15px;
        }

        .pro-img-details {
            margin-left: -15px;
        }

        .pro-img-details img {
            width: 100%;
        }

        .pro-d-title {
            font-size: 16px;
            margin-top: 0;
        }

        .product_meta {
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            margin: 15px 0;
        }

        .product_meta span {
            display: block;
            margin-bottom: 10px;
        }

        .product_meta a,
        .pro-price {
            color: #fc5959;
        }

        .pro-price,
        .amount-old {
            font-size: 18px;
            padding: 0 10px;
        }

        .amount-old {
            text-decoration: line-through;
        }

        .quantity {
            width: 120px;
        }

        .pro-img-list {
            margin: 10px 0 0 -15px;
            width: 100%;
            display: inline-block;
        }

        .pro-img-list a {
            float: left;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .pro-d-head {
            font-size: 18px;
            font-weight: 300;
        }
        .save {
          float: right;
        }
    </style>
</head>

<body>
    <div class="container bootdey">
        <div class="col-md-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="pro-img-details">
                            <img src="{{URL('Bazar/items/'.$item->items_image_main)}}" alt>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="pro-d-title">
                            <a href="#" class>
                              {{$item->items_name}}
                            </a>
                        </h4>
                        <p>
                          {{$item->items_desc}}
                        </p>
                        <div class="product_meta">
                            <span class="posted_in"><strong>اللون:</strong> <a rel="tag">{{$item->cart_colors}}</a>.</span>
                            <span class="posted_in"><strong>المقاس:</strong> <a rel="tag">{{$item->cart_sizes}}</a>.</span>
                            <span class="posted_in"><strong>الخصم المطبق:</strong> <a rel="tag">%{{$item->items_discount}}</a>.</span>
                        </div>
                        <div class="m-bot15"> <strong>السعر : </strong> <span class="amount-old">${{$item->items_price_d}}</span> <span
                                class="pro-price"> {{$item->itemsprice_d}} ل.س</span></div>
                                <br>
                        <div class="form-group">
                            <label>الكميه</label>
                            <input type="quantiy" placeholder="{{$item->countitems}}" class="form-control quantity">
                        </div>

                        <form id="validate-form" class="form-group" enctype="multipart/form-data" method="POST" action="{{route('admin.order.update',$item->cart_id)}}" >
                          @csrf
                          @method('PUT')
                        @if ($item->items_delay == 1)
                        <div class="form-group" required>
                          <label> حالة المنتج </label>
                            <div class="col-12 pt-3">
                                <select  class="form-control" name="cart_status" required>
                                    <option @if($item->cart_status == "0") selected @endif value="0" > في انتظار الموافقه</option>
                                    <option @if($item->cart_status == "1") selected @endif value="1" >يتم تحضير الطلب </option>
                                    <option @if($item->cart_status == "2") selected @endif value="2" >طلبك جاهز للاستلام-ارسل اليك </option>
                                    <option @if($item->cart_status == "3") selected @endif value="3" >شكرا للتسوق في بازار </option>
                                    <option @if($item->cart_status == "4") selected @endif value="4" >أرشيف </option>
                                </select>
                            </div>
                        </div>
                        
                        
                                <div  class="card" >
                                    <div class="form-group ">
                                    <div class="form-group">
                                        <div class="form-group">
                                            الاشعار عربي
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="body"  maxlength="190" class="form-control" value="{{old('body')}}">
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <div class="form-group">
                                            الاشعار اجنبي
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="body_en"  maxlength="190" class="form-control" value="{{old('body_en')}}">
                                        </div>
                                    </div>
                    
                                    <div class="form-group">
                                        <div class="form-group">
                                            الاشعار روسي
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="body_ru" maxlength="190" class="form-control" value="{{old('body_ru')}}">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                        

                        @endif
                    </div>
                </div>
                
                <div class="save">
                  <button class="btn btn-success" id="submitEvaluation">حفظ</button>
              </div>
            </form>
            </section>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>
