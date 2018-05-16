<style>

ul.nav-main > li.nav-expanded > a {
  box-shadow: 2px 0 0 #32d191  inset;
}
html.no-overflowscrolling .nano > .nano-pane > .nano-slider {
    background: #ee413c;
}
.page-header h2 {
    border-bottom-color: #ee413c;
}
</style>
<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar" ></i>
						</div>
					</div>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li {{ (Request::is('admin/dashboard*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/dashboard/')}}"  >
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>ส่วนควบคุม</span>
										</a>
									</li>
								<!--	<li {{ (Request::is('admin/user*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/user/')}}" >
											<i class="fa fa-male" aria-hidden="true"></i>
											<span>รายชื่อผู้ใช้ทั้งหมด</span>
										</a>
									</li> -->

									<li {{ (Request::is('admin/student*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/student/')}}" >
											<i class="fa fa-graduation-cap " aria-hidden="true"></i>
											<span>รายชื่อสมาชิก</span>
										</a>
									</li>


									<li {{ (Request::is('admin/course*') ? 'class=nav-expanded' : '') }}
                  {{ (Request::is('admin/typecourse*') ? 'class=nav-expanded' : '') }}
                  {{ (Request::is('admin/examination/*') ? 'class=nav-expanded' : '') }}
                  {{ (Request::is('admin/category*') ? 'class=nav-expanded' : '') }}>
										<a href="{{url('admin/course/')}}" >
											<i class="fa fa-cube" aria-hidden="true"></i>
											<span>สินค้า</span>
										</a>
									</li>



                  <li {{ (Request::is('admin/new_course*') ? 'class=nav-expanded' : '') }}>
										<a href="{{url('admin/new_course/')}}" >
											<i class="fa fa-cube" aria-hidden="true"></i>
											<span>สินค้ารอตรวจสอบ !</span>
										</a>
									</li>

                  <li {{ (Request::is('admin/pay_money*') ? 'class=nav-expanded' : '') }}>
										<a href="{{url('admin/pay_money/')}}" >
											<i class="fa fa-fire" aria-hidden="true"></i>
											<span>รอการเบิกจ่าย !</span>
										</a>
									</li>

                  <li {{ (Request::is('admin/success_money*') ? 'class=nav-expanded' : '') }}>
										<a href="{{url('admin/success_money/')}}" >
											<i class="fa fa-heart-o" aria-hidden="true"></i>
											<span>รายการโอนเงินเสร็จสิ้น !</span>
										</a>
									</li>

                  <li {{ (Request::is('admin/department*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/department/')}}" >
											<i class="fa fa-flag" aria-hidden="true"></i>
											<span>หมวดหมู่</span>
										</a>
									</li>



                  <li {{ (Request::is('admin/order_shop*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/order_shop/')}}" >
											<i class="fa fa-external-link" aria-hidden="true"></i>
											<span>รายการสั่งซื้อใหม่</span>
										</a>
									</li>

                  <li {{ (Request::is('admin/play_student*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/play_student/')}}" >
											<i class="fa fa-address-book-o" aria-hidden="true"></i>
											<span>รายการสั่งซื้อเก่า</span>
										</a>
									</li>





                  <li {{ (Request::is('admin/bank*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/bank/')}}" >
											<i class="fa fa-bank" aria-hidden="true"></i>
											<span>ธนาคาร</span>
										</a>
									</li>

                  <li {{ (Request::is('admin/blog*') ? 'class=nav-expanded' : '') }} >
										<a href="{{url('admin/blog/')}}" >
											<i class="fa fa-code" aria-hidden="true"></i>
											<span>ข่าวสาร</span>
										</a>
									</li>







								</ul>



							</nav>



							<hr class="separator" />


						</div>

					</div>

				</aside>
				<!-- end: sidebar -->
