@section('title', 'Dashboard')
@extends('layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Website Analytics</h3>
                <div class="nk-block-des text-soft">
                    <p>Welcome to Analytics Dashboard.</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                        data-toggle="dropdown"><em
                                            class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span
                                                class="d-none d-md-inline">Last</span> 30 Days</span><em
                                            class="dd-indc icon ni ni-chevron-right"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Last 30 Days</span></a></li>
                                            <li><a href="#"><span>Last 6 Months</span></a></li>
                                            <li><a href="#"><span>Last 1 Years</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em
                                        class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xl">
                <div class="card card-bordered">
                    <div class="card-inner mb-n2">
                        <div class="card-title-group">
                            <div class="card-title card-title-sm">
                                <h6 class="title">Pages View by Users</h6>
                            </div>
                            <div class="card-tools">
                                <div class="drodown"><a href="#"
                                        class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white"
                                        data-bs-toggle="dropdown">30 Days</a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>7 Days</span></a></li>
                                            <li><a href="#"><span>15 Days</span></a></li>
                                            <li><a href="#"><span>30 Days</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list is-compact">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Page</span></div>
                            <div class="nk-tb-col text-end"><span>Page Views</span></div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span class="tb-sub"><span>/</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>2,879</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span
                                    class="tb-sub"><span>/subscription/index.html</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>2,094</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span
                                    class="tb-sub"><span>/general/index.html</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>1,634</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span
                                    class="tb-sub"><span>/crypto/index.html</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>1,497</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span
                                    class="tb-sub"><span>/invest/index.html</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>1,349</span></span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span
                                    class="tb-sub"><span>/subscription/profile.html</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>984</span></span></div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span
                                    class="tb-sub"><span>/general/index-crypto.html</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>879</span></span></div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col"><span
                                    class="tb-sub"><span>/apps/messages/index.html</span></span></div>
                            <div class="nk-tb-col text-end"><span class="tb-sub tb-amount"><span>598</span></span></div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
@endsection
