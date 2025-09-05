<!DOCTYPE html>
<html lang="en">

<head>
    @include('site.partials.head')

    <link rel="stylesheet" href="/site/css/bootstrap.min.css"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" href="/site/css/font-awesome.min.css"><!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" href="/site/css/owl.carousel.min.css"><!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" href="/site/css/magnific-popup.min.css"><!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" href="/site/css/swiper-bundle.min.css"><!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="/site/css/style.css"><!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" href="/site/css/bootstrap-icons.css"><!-- BOOTSTRAP ICON STYLE SHEET -->
    <link rel="stylesheet" href="/site/css/lc_lightbox.css"><!-- Lc light box popup -->
    <link rel="stylesheet" href="/site/css/bootstrap-slider.min.css"><!-- Price Range Slider -->
    <link href="/site/css/callbutton.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    @yield('css')

    <!-- Angular Js -->
    <script src="{{ asset('libs/angularjs/angular.js?v=222222') }}"></script>
    <script src="{{ asset('libs/angularjs/angular-resource.js') }}"></script>
    <script src="{{ asset('libs/angularjs/sortable.js') }}"></script>
    <script src="{{ asset('libs/dnd/dnd.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular-sanitize.js"></script>
    <script src="{{ asset('libs/angularjs/select.js') }}"></script>
    <script src="{{ asset('js/angular.js') }}?version={{ env('APP_VERSION', '1') }}"></script>
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script> --}}
    <script>
        app.controller('AppController', function($rootScope, $scope, cartItemSync, $interval, $compile) {
            $scope.currentUser = @json(Auth::guard('client')->user());
            $scope.isAdminClient = @json(Auth::guard('client')->check());
            // $scope.showMenuAdminClient = localStorage.getItem('showMenuAdminClient') ? localStorage.getItem('showMenuAdminClient') : false;

            // const currentUrl = window.location.href;
            // if (currentUrl != "{{ route('front.client-account') }}" && currentUrl != "{{ route('front.user-order') }}" && currentUrl != "{{ route('front.user-revenue') }}" && currentUrl != "{{ route('front.user-level') }}") {
            //     $scope.showMenuAdminClient = false;
            //     localStorage.removeItem('showMenuAdminClient');
            // }

            // $scope.changeMenuClient = function($event, url){
            //     $event.preventDefault();
            //     $scope.showMenuAdminClient = !$scope.showMenuAdminClient;
            //     if(url == '{{ route('front.user-order') }}' || url == '{{ route('front.user-revenue') }}' || url == '{{ route('front.user-level') }}') {
            //         $scope.showMenuAdminClient = true;
            //     }

            //     if($scope.showMenuAdminClient){
            //         localStorage.setItem('showMenuAdminClient', $scope.showMenuAdminClient);
            //         window.location.href = url;
            //     }else{
            //         localStorage.removeItem('showMenuAdminClient');
            //         window.location.href = '{{ route('front.home-page') }}';
            //     }
            // }

            // Biên dịch lại nội dung bên trong container
            var container = angular.element(document.getElementsByClassName('item_product_main'));
            $compile(container.contents())($scope);

            var popup = angular.element(document.getElementById('popup-cart-mobile'));
            $compile(popup.contents())($scope);

            // var quickView = angular.element(document.getElementById('quick-view-product'));
            // $compile(quickView.contents())($scope);

            // Đặt mua hàng
            $scope.hasItemInCart = false;
            $scope.cart = cartItemSync;
            $scope.item_qty = 1;
            $scope.quantity_quickview = 1;
            $scope.noti_product = {};

            $scope.addToCart = function(productId, quantity = 1) {
                url = "{{ route('cart.add.item', ['productId' => 'productId']) }}";
                url = url.replace('productId', productId);
                let item_qty = quantity;

                jQuery.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        'qty': parseInt(item_qty)
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.count > 0) {
                                $scope.hasItemInCart = true;
                            }

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);
                            // toastr.success('Thao tác thành công !')
                            $scope.noti_product = response.noti_product;
                            $scope.$applyAsync();

                            $('#popup-cart-mobile').addClass('active');
                            $('.backdrop__body-backdrop___1rvky').addClass('active');
                            $('#quick-view-product.quickview-product').hide();
                        }
                    },
                    error: function() {
                        toastr.error('Thao tác thất bại !')
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
                // if ($scope.isAdminClient) {
                // } else {
                //     window.location.href = "{{ route('front.login-client') }}";
                // }
            }

            $scope.changeQty = function(qty, product_id) {
                updateCart(qty, product_id)
            }

            $scope.incrementQuantity = function(product) {
                product.quantity = Math.min(product.quantity + 1, 9999);
            };

            $scope.decrementQuantity = function(product) {
                product.quantity = Math.max(product.quantity - 1, 0);
            };

            function updateCart(qty, product_id) {
                jQuery.ajax({
                    type: 'POST',
                    url: "{{ route('cart.update.item') }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: product_id,
                        qty: qty
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.items = response.items;
                            $scope.total = response.total;
                            $scope.total_qty = response.count;
                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // xóa item trong giỏ
            $scope.removeItem = function(product_id) {
                jQuery.ajax({
                    type: 'GET',
                    url: "{{ route('cart.remove.item') }}",
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response.success) {
                            $scope.cart.items = response.items;
                            $scope.cart.count = Object.keys($scope.cart.items).length;
                            $scope.cart.totalCost = response.total;

                            $interval.cancel($rootScope.promise);

                            $rootScope.promise = $interval(function() {
                                cartItemSync.items = response.items;
                                cartItemSync.total = response.total;
                                cartItemSync.count = response.count;
                            }, 1000);

                            if ($scope.cart.count == 0) {
                                $scope.hasItemInCart = false;
                            }
                            $scope.$applyAsync();
                        }
                    },
                    error: function(e) {
                        jQuery.toast.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // Xem nhanh
            $scope.quickViewProduct = {};
            $scope.showQuickView = function(productId) {
                $.ajax({
                    url: "{{ route('front.get-product-quick-view') }}",
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        $('#quick-view-product .quick-view-product').html(response.html);
                        var quickView = angular.element(document.getElementById(
                            'quick-view-product'));
                        $compile(quickView.contents())($scope);
                        $scope.$applyAsync();
                    },
                    error: function(e) {
                        toastr.error('Đã có lỗi xảy ra');
                    },
                    complete: function() {
                        $scope.$applyAsync();
                    }
                });
            }

            // Search product
            jQuery('#live-search').keyup(function() {
                var keyword = jQuery(this).val();
                jQuery.ajax({
                    type: 'post',
                    url: '{{ route('front.auto-search-complete') }}',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        jQuery('.live-search-results').html(data.html);
                    }
                })
            });
        })
        app.factory('cartItemSync', function($interval) {
            var cart = {
                items: null,
                total: null
            };

            cart.items = @json($cartItems);
            cart.count = {{ $cartItems->sum('quantity') }};
            cart.total = {{ $totalPriceCart }};

            return cart;
        });

        @if (Session::has('token'))
            localStorage.setItem('{{ env('prefix') }}-token', "{{ Session::get('token') }}")
        @endif
        @if (Session::has('logout'))
            localStorage.removeItem('{{ env('prefix') }}-token');
        @endif
        var CSRF_TOKEN = "{{ csrf_token() }}";
        @if (Auth::guard('client')->check())
            const DEFAULT_CLIENT_USER = {
                id: "{{ Auth::guard('client')->user()->id }}",
                fullname: "{{ Auth::guard('client')->user()->name }}"
            };
        @else
            const DEFAULT_CLIENT_USER = null;
        @endif
    </script>
</head>

<body ng-app="App" ng-controller="AppController" ng-cloak>
    <!-- LOADING AREA START ===== -->
    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="loader"></div>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->

    <!-- Curser Pointer -->
    {{-- <div class="cursor"></div>
    <div class="cursor2"></div> --}}

    <div class="page-wraper">
        @include('site.partials.header')

        @yield('content')

        @include('site.partials.footer')

        <!-- BUTTON TOP START -->
        <button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

    </div>
    <div onclick="window.location.href= 'tel:{{ str_replace(' ', '', $config->hotline) }}'"
        class="hotline-phone-ring-wrap">
        <div class="hotline-phone-ring">
            <div class="hotline-phone-ring-circle"></div>
            <div class="hotline-phone-ring-circle-fill"></div>
            <div class="hotline-phone-ring-img-circle">
                <a href="tel:{{ str_replace(' ', '', $config->hotline) }}" class="pps-btn-img">
                    <img src="/site/images/phone.png" alt="Gọi điện thoại" width="50">
                </a>
            </div>
        </div>
        <a href="tel:{{ str_replace(' ', '', $config->hotline) }}">
        </a>
        <div class="hotline-bar"><a href="tel:{{ str_replace(' ', '', $config->hotline) }}">
            </a><a href="tel:{{ str_replace(' ', '', $config->hotline) }}">
                <span class="text-hotline">{{ $config->hotline }}</span>
            </a>
        </div>

    </div>
    <div class="inner-fabs show">
        <a target="blank" href="https://zalo.me/{{ str_replace(' ', '', $config->zalo) }}" class="fabs roundCool"
            id="chat-fab">
            <img class="inner-fab-icon" src="/site/images/zalo.png" alt="chat-active-icon" border="0">
        </a>

    </div>


    <!-- JAVASCRIPT  FILES ========================================= -->
    <script src="/site/js/jquery-3.7.1.min.js"></script><!-- JQUERY.MIN JS -->
    <script src="/site/js/popper.min.js"></script><!-- POPPER.MIN JS -->

    <script src="/site/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
    <script src="/site/js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
    <script src="/site/js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
    <script src="/site/js/counterup.min.js"></script><!-- COUNTERUP JS -->

    <script src="/site/js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
    <script src="/site/js/imagesloaded.pkgd.min.js"></script><!-- MASONRY  -->
    <script src="/site/js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
    <script src="/site/js/theia-sticky-sidebar.js"></script><!-- STICKY SIDEBAR  -->
    <script src="/site/js/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->

    <script src="/site/js/lc_lightbox.lite.js"></script><!-- IMAGE POPUP -->
    <script src="/site/js/bootstrap-slider.min.js"></script><!-- Form js -->
    <script src="/site/js/swiper-bundle.min.js"></script> <!-- Swiper JS -->
    <script src="/site/js/img-parallax.js"></script>
    <script src="/site/js/wow.min.js"></script><!-- WOW ANIMATION JS -->

    <!-- Title animation Js -->
    {{-- <script src="/site/js/gsap.min.js"></script><!-- cursor --> --}}
    <script src="/site/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
    <script src="/site/js/callbutton.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    @stack('script')
</body>

</html>
