        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/') }}"><i class="fa fa-files-o fa-fw"></i> 商品管理系统</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

<!--                <li class="dropdown">-->
<!--                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
<!--                        <i class="fa fa-envelope fa-fw"></i> 消息 <i class="fa fa-caret-down"></i>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu dropdown-messages">-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <strong>John Smith</strong>-->
<!--                                    <span class="pull-right text-muted">-->
<!--                                        <em>Yesterday</em>-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <strong>John Smith</strong>-->
<!--                                    <span class="pull-right text-muted">-->
<!--                                        <em>Yesterday</em>-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <strong>John Smith</strong>-->
<!--                                    <span class="pull-right text-muted">-->
<!--                                        <em>Yesterday</em>-->
<!--                                    </span>-->
<!--                                </div>-->
<!--                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a class="text-center" href="#">-->
<!--                                <strong>Read All Messages</strong>-->
<!--                                <i class="fa fa-angle-right"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                    <!-- /.dropdown-messages -->
<!--                </li>-->
                <!-- /.dropdown -->
<!--                <li class="dropdown">-->
<!--                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
<!--                        <i class="fa fa-bell fa-fw"></i> 提醒 <span class="badge">42</span> <i class="fa fa-caret-down"></i>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu dropdown-alerts">-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <i class="fa fa-comment fa-fw"></i> New Comment-->
<!--                                    <span class="pull-right text-muted small">4 minutes ago</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers-->
<!--                                    <span class="pull-right text-muted small">12 minutes ago</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <i class="fa fa-envelope fa-fw"></i> Message Sent-->
<!--                                    <span class="pull-right text-muted small">4 minutes ago</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <i class="fa fa-tasks fa-fw"></i> New Task-->
<!--                                    <span class="pull-right text-muted small">4 minutes ago</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <div>-->
<!--                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted-->
<!--                                    <span class="pull-right text-muted small">4 minutes ago</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="divider"></li>-->
<!--                        <li>-->
<!--                            <a class="text-center" href="#">-->
<!--                                <strong>查看全部提醒</strong>-->
<!--                                <i class="fa fa-angle-right"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                    <!-- /.dropdown-alerts -->
<!--                </li>-->
                <!-- /.dropdown -->

                <li>
                    <a href="{{ URL::to('users/change') }}">
                        <i class="fa fa-edit fa-fw"></i> 更改个人资料
                    </a>
                </li>

                <li>
                    <a href="{{ URL::to('users/signout') }}">
                        <i class="fa fa-sign-out fa-fw"></i> 退出
                    </a>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::to('/') }}"><i class="fa fa-home fa-fw"></i> 管理首页</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('users') }}"><i class="fa fa-users fa-fw"></i> 员工管理</a>
                    </li>

                    <li class="{{  Request::is('goods*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-cogs fa-fw"></i> 货品管理<span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ URL::to('goods') }}"> 货品列表</a>
                            </li>

                            @if (Auth::user()->grade == 1 || Auth::user()->grade == 6)
                            <li>
                                <a href="{{ URL::to('goods/allocation-list') }}"> 调拨列表</a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    @if (Auth::user()->grade == 1)
                    <li>
                        <a href="{{ URL::to('goods/warehouse-all') }}"><i class="fa fa-table  fa-fw"></i> 仓库列表</a>
                    </li>
                    @endif

                    <li class="{{  Request::is('branch*') ? 'active' : '' }}">

                        <a href="#"><i class="fa fa-sitemap  fa-fw"></i> 网点管理<span class="fa arrow"></span></a>

                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ URL::to('branch') }}"> 网点列表</a>
                            </li>

                            @if (Auth::user()->grade == 1)
                            <li>
                                <a href="{{ URL::to('branch/type') }}"> 客户类型</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('branch/area') }}"> 区域管理</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('branch/line') }}"> 线路维护</a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li>
                        <a href="{{ URL::to('notice') }}"><i class="fa fa-bell fa-fw"></i> 提醒列表</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('picking') }}"><i class="fa fa-tasks fa-fw"></i> 出货列表</a>
                    </li>

                    @if (Auth::user()->grade == 1 || Auth::user()->grade == 5)
                    <li>
                        <a href="{{ URL::to('picking/print') }}"><i class="fa fa-print fa-fw"></i> 批量打印</a>
                    </li>
                    @endif

                    <li>
                        <a href="{{ URL::to('branch/visit-all') }}"><i class="fa fa-edit fa-fw"></i> 回访列表</a>
                    </li>

                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
