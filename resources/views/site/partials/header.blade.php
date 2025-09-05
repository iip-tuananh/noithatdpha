<!-- HEADER START -->
<header class="sticky-header site-header header-style-2 mobile-sider-drawer-menu" ng-cloak>
    <div class="main-bar-wraper  navbar-expand-lg">
        <div class="main-bar">

            <div class="container-fluid clearfix">

                <div class="logo-header">
                    <div class="logo-header-inner logo-header-one">
                        <a href="{{ route('front.home-page') }}">
                            <img src="{{ $config->image ? $config->image->path : 'https://placehold.co/100x100' }}"
                                alt="">
                        </a>
                    </div>
                </div>


                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button"
                    class="navbar-toggler collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button>

                <!-- MAIN Vav -->
                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-end">

                    <ul class=" nav navbar-nav">
                        <li><a href="{{ route('front.home-page') }}">Trang chủ</a></li>
                        <li><a href="{{ route('front.about-us') }}">Về Chúng Tôi</a></li>

                        <li class="has-child"><a href="javascript:;">Dịch vụ</a>
                            <ul class="sub-menu">
                                @foreach ($services as $service)
                                    <li><a
                                            href="{{ route('front.service-detail', $service->slug) }}">{{ $service->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="has-child"><a href="javascript:;">Dự án</a>
                            <ul class="sub-menu">
                                @foreach ($projectCategories as $projectCategory)
                                    <li><a
                                            href="{{ route('front.show-project-category', $projectCategory->slug) }}">{{ $projectCategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="has-child">
                            <a href="javascript:;">Sản phẩm</a>
                            <ul class="sub-menu">
                                @foreach ($productCategories as $productCategory)
                                    <li class="has-child"><a
                                            href="{{ route('front.show-product-category', $productCategory->slug) }}">{{ $productCategory->name }}</a>
                                        @if ($productCategory->childs->count() > 0)
                                            <div class="fa fa-angle-right submenu-toogle"></div>
                                            <ul class="sub-menu">
                                                @foreach ($productCategory->childs as $child)
                                                    <li><a
                                                            href="{{ route('front.show-product-category', $child->slug) }}">{{ $child->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @foreach ($postCategories as $postCategory)
                            <li class="has-child"><a
                                    href="{{ route('front.list-blog', $postCategory->slug) }}">{{ $postCategory->name }}</a>
                                <ul class="sub-menu">
                                    @foreach ($postCategory->childs as $child)
                                        <li><a
                                                href="{{ route('front.list-blog', $child->slug) }}">{{ $child->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach

                        <li><a href="{{ route('front.contact-us') }}">Liên hệ</a></li>

                    </ul>

                </div>

                <!-- Header Right Section-->
                <div class="extra-nav header-1-nav">
                    <div class="extra-cell one">
                        <div class="header-search">
                            <a href="#search" class="header-search-icon"><i class="bi bi-search"></i></a>
                        </div>
                    </div>
                    <div class="extra-cell two h-cart-block">
                        <a href="javascript:;" class="wt-cart cart-btn navSidebar-button" title="Your Cart">
                            <span class="link-inner">
                                <span class="woo-cart-total"> </span>
                                <span class="woo-cart-count">
                                    <i class="bi bi-bag"></i>
                                    <span class="shopping-bag wcmenucart-count "
                                        ng-if="cart.count > 0"><% cart.count %></span>
                                </span>
                            </span>
                        </a>
                    </div>
                </div>




                <!-- SITE Search -->
                <div id="search">
                    <span class="close-btn">X</span>
                    <form role="search" id="searchform" action="{{ route('front.search') }}" method="get"
                        class="radius-xl">
                        <div class="input-group">
                            <input class="form-control" value="" name="keyword" type="search"
                                placeholder="Search...">
                            <span class="input-group-append">
                                <button type="button" class="search-btn">
                                    <i class="bi bi-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <div class="xs-sidebar-group info-group ">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">
                        <i class="bi bi-x-square-fill"></i>
                    </a>
                </div>
                <div class="sidebar-textwidget">
                    <!-- Sidebar Info Content -->
                    <div class="sidebar-info-contents" ng-if="cart.count > 0">
                        <div class="content-inner">
                            <div class="content-box">
                                <div class="cart-dropdown-item-wraper">
                                    <div class="nav-cart-content">
                                        <div class="nav-cart-items">
                                            <div class="nav-cart-item" ng-repeat="item in cart.items">
                                                <div class="nav-cart-item-image">
                                                    <a ng-href="/san-pham/<% item.attributes.slug %>.html"><img
                                                            ng-src="<% item.attributes.image %>" alt="p-1"></a>
                                                </div>
                                                <div class="nav-cart-item-desc">
                                                    <span
                                                        class="nav-cart-item-price"><strong><% item.quantity %></strong>
                                                        x <% item.price | number %>₫</span>
                                                    <a
                                                        ng-href="/san-pham/<% item.attributes.slug %>.html"><% item.name %></a>
                                                    <a href="javascript:void(0);"
                                                        class="nav-cart-item-quantity radius-sm"
                                                        ng-click='removeItem(item.id)'>x</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nav-cart-title p-tb10 p-lr15 d-flex">
                                            <h4 class="m-a0">Tổng tiền:</h4>
                                            <h5 class="m-a0"><% cart.total | number %>₫</h5>
                                        </div>
                                        <div class="nav-cart-action" style="text-align: center;">
                                            <a href="{{ route('cart.checkout') }}"
                                                class="site-button-secondry">Thanh toán </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-info-contents" ng-if="cart.count == 0">
                        <div class="content-inner">
                            <div class="content-box">
                                <div class="cart-dropdown-item-wraper">
                                    <div class="nav-cart-content">
                                        <div class="nav-cart-items">
                                            <div class="nav-cart-item">
                                                <div class="nav-cart-item-desc" style="text-align: center;">
                                                    <span class="nav-cart-item-price" style="font-size: 18px; font-weight: 600;">Giỏ hàng trống</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nav-cart-action" style="text-align: center;">
                                            <a href="{{ route('front.home-page') }}"
                                                class="site-button-secondry">Thêm sản phẩm </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER END -->
