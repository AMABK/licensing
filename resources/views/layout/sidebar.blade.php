<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{\Auth::user()->first_name}} {{\Auth::user()->last_name}}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Administrator</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/admin')}}"><i class="fa fa-home"></i> Admin home</a></li>
                    <li><a href="{{URL::to('/admin/add-user')}}"><i class="fa fa-plus"></i> Add new user</a></li>
                    <li><a href="{{URL::to('/admin/view-users')}}"><i class="fa fa-eye"></i> View user</a></li>
                    <li><a href="{{URL::to('/admin/view-deleted-users')}}"><i class="fa fa-trash-o"></i> View deleted users</a></li>
                    <li><a href="{{URL::to('/admin/view-charges')}}"><i class="fa fa-money"></i> View charges</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>Vehicle Groups</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/group')}}"><i class="fa fa-home"></i> Group home</a></li>
                    <li><a href="{{URL::to('/group/add-group')}}"><i class="fa fa-plus-circle"></i> Add new group</a></li>
                    <li><a href="{{URL::to('/group/view-groups')}}"><i class="fa fa-eye"></i> View groups</a></li>
                    <li><a href="{{URL::to('/group/deleted-groups')}}"><i class="fa fa-trash-o"></i> View deleted groups</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-automobile"></i>
                    <span>Vehicles</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/vehicle')}}"><i class="fa fa-home"></i> Vehicle home</a></li>
                    <li><a href="{{URL::to('/vehicle/add-vehicle')}}"><i class="fa fa-plus-circle"></i> Add new vehicle</a></li>
                    <li><a href="{{URL::to('/vehicle/view-vehicles')}}"><i class="fa fa-eye"></i> View vehicles</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Invoices</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/invoice')}}"><i class="fa fa-home"></i> Invoices home</a></li>
                    <li><a href="{{URL::to('/invoice/add-group-invoice')}}"><i class="fa fa-plus-circle"></i> Add group invoice</a></li>
                    <li><a href="{{URL::to('/invoice/add-vehicle-invoice')}}"><i class="fa fa-plus-circle"></i> Add vehicle invoice</a></li>
                    <li><a href="{{URL::to('/invoice/view-invoices')}}"><i class="fa fa-eye"></i> View invoices</a></li>
                    <li><a href="{{URL::to('/invoice/view-deleted-invoices')}}"><i class="fa fa-trash-o"></i> View deleted invoices</a></li>
                    <li><a href="{{URL::to('/invoice/print-view')}}"><i class="fa fa-print"></i> Print View</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-location-arrow"></i>
                    <span>Agents</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/agent')}}"><i class="fa fa-home"></i> Agent home</a></li>
                    <li><a href="{{URL::to('/agent/add-agent')}}"><i class="fa fa-plus-circle"></i> Add agent</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-reorder"></i>
                    <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{URL::to('/reports')}}"><i class="fa fa-home"></i> Reports home</a></li>
<!--                    <li><a href="{{URL::to('/reports/reports')}}"><i class="fa fa-money"></i> Fee collection reports</a></li>-->
                </ul>
            </li>
            <!--            <li class="treeview">
                          <a href="#">
                            <i class="fa fa-money"></i>
                            <span>Finance</span>
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="{{URL::to('/vehicle')}}"><i class="fa fa-home"></i> Invoices home</a></li>
                            <li><a href="{{URL::to('/vehicle/add-vehicle')}}"><i class="fa fa-plus-circle"></i> Add new vehicle</a></li>
                            <li><a href="{{URL::to('/vehicle/view-vehicles')}}"><i class="fa fa-eye"></i> View vehicles</a></li>
                          </ul>
                        </li>-->
            <!--            <li class="treeview">
                          <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Charts</span>
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="/pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                            <li><a href="/pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                            <li><a href="/pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                            <li><a href="/pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>UI Elements</span>
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="/pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                            <li><a href="/pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                            <li><a href="/pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                            <li><a href="/pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                            <li><a href="/pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                            <li><a href="/pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-edit"></i> <span>Forms</span>
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="/pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                            <li><a href="/pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                            <li><a href="/pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="/pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                            <li><a href="/pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                          </ul>
                        </li>
                        <li>
                          <a href="/pages/calendar.html">
                            <i class="fa fa-calendar"></i> <span>Calendar</span>
                            <small class="label pull-right bg-red">3</small>
                          </a>
                        </li>
                        <li>
                          <a href="/pages/mailbox/mailbox.html">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <small class="label pull-right bg-yellow">12</small>
                          </a>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-folder"></i> <span>Examples</span>
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="/pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                            <li><a href="/pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                            <li><a href="/pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                            <li><a href="/pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                            <li><a href="/pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                            <li><a href="/pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                            <li><a href="/pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-share"></i> <span>Multilevel</span>
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            <li>
                              <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                              <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                <li>
                                  <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                  <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                  </ul>
                                </li>
                              </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                          </ul>
                        </li>
                        <li><a href="/documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
                        <li class="header">LABELS</li>
                        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
                      </ul>
                    </section>-->
            <!-- /.sidebar -->
            </aside>
