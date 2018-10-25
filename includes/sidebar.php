<div class="sidebar" data-background-color="brown" data-active-color="danger">
    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->
    <div class="logo">
        <a class="simple-text logo-mini">
            C+
        </a>

        <a class="simple-text logo-normal">
            Connect+
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="info">
                <div class="photo">
                    <img src="../assets/img/faces/face-2.jpg"/>
                </div>

                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
	                        <span>
								<?php echo $_SESSION['adminusername']; ?>
                                <b class="caret"></b>
							</span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#profile">
                                <span class="sidebar-mini">Mp</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="sidebar-mini">Ep</span>
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="sidebar-mini">S</span>
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="active">
                <a href="/dashboard" aria-expanded="true">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="ti-package"></i>
                    <p>Store
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li>
                            <a href="/stores">
                                <span class="sidebar-mini">STR</span>
                                <span class="sidebar-normal">Stores</span>
                            </a>
                        </li>
                        <li>
                            <a href="/category">
                                <span class="sidebar-mini">CAT</span>
                                <span class="sidebar-normal">Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="/stock">
                                <span class="sidebar-mini">STK</span>
                                <span class="sidebar-normal">Stock</span>
                            </a>
                        </li>
                        <li>
                            <a href="/payment_modes">
                                <span class="sidebar-mini">PM</span>
                                <span class="sidebar-normal">Payment Modes</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="/customers">
                    <i class="ti-clipboard"></i>
                    <p>
                        Customers
                    </p>
                </a>
            </li>
            <li>
                <a href="/suppliers">
                    <i class="ti-clipboard"></i>
                    <p>
                        Suppliers
                    </p>
                </a>
            </li>
            <li>
                <a href="/staff">
                    <i class="ti-user"></i>
                    <p>
                        Staff
                    </p>
                </a>
            </li>
            <li>
                <a href="/attendance">
                    <i class="ti-user"></i>
                    <p>
                        Attendance
                    </p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#tablesExamples">
                    <i class="ti-view-list-alt"></i>
                    <p>
                        Logs
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tablesExamples">
                    <ul class="nav">
                        <li>
                            <a href="/sales-transactions">
                                <span class="sidebar-mini">ST</span>
                                <span class="sidebar-normal">Transactions</span>
                            </a>
                        </li>
                        <li>
                            <a href="/stock-movement">
                                <span class="sidebar-mini">SM</span>
                                <span class="sidebar-normal">Stock Movement</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>