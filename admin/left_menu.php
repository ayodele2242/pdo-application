	<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
					<!--begin::Brand-->
					<div class="brand flex-column-auto bg-main" id="kt_brand">
						<!--begin::Logo-->
						<a href="dashboard" class="brand-logo">
							<?php
                                  if(empty($web['logo'])){
                                  ?>
                                  <img src="../assets/logo/avatar.png" class="responsive-img" 
								  style="width: 100%; max-width 100px; height: 100%; max-height: 100px; ">
                                <?php }else{
                                  ?>
                                  <img id="profile_pics"  data-holder-rendered="true" 
								  src="<?php echo $web['installUrl']; ?>assets/logo/<?php echo $web['logo']; ?>" 
								  class="responsive-img" 
								  style="width: 100%; max-width 80px; height: 100%; max-height: 80px;  margin-top:30px">
                                  <?php
                                 }
                              ?>
						</a>
						<!--end::Logo-->
						<!--begin::Toggle-->
						<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<!--begin::Svg Icon-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#ffffff" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
										<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#ffffff" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
						</button>
						<!--end::Toolbar-->
					</div>
					<!--end::Brand-->

					<!--begin::Aside Menu-->


					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
						<!--begin::Menu Container-->
						<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
							<!--begin::Menu Nav-->
							<ul class="menu-nav">
								<li class="menu-item" aria-haspopup="true">
									<a href="dashboard" class="menu-link">
										<i class="menu-icon flaticon-home"></i>
										<span class="menu-text">Dashboard</span>
									</a>
								</li>
								
							
							<?php foreach ($_SESSION["access"] as $key => $access) { ?>
								<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
									<a href="javascript:;" class="menu-link menu-toggle">

										 <?php 
											if($access["top_menu_name"] == 'User'){
											echo '<i class="menu-icon flaticon-users"></i>';
											}if($access["top_menu_name"] == 'Inventory'){
											    echo '<i class="menu-icon fas shopping-cart" ></i>';
											}if($access["top_menu_name"] == 'Checkout'){
											    echo '<i class="menu-icon fas">money</i>';
											}if($access["top_menu_name"] == 'Sales'){
											    echo '<i class="menu-icon fas shopping-cart" ></i>';
											}
											if($access["top_menu_name"] == 'Investors'){
											echo '<i class="menu-icon flaticon2-group"></i>';
											}
											if($access["top_menu_name"] == 'Products'){
											    echo '<i class="menu-icon flaticon-grid-menu-v2" ></i>';
											}if($access["top_menu_name"] == 'Slidders'){
											    echo '<i class="menu-icon flaticon2-image-file" ></i>';
											}
											if($access["top_menu_name"] == 'Settings'){
											    echo '<i class="menu-icon flaticon-settings-1"></i>';
											}if($access["top_menu_name"] == 'Pages'){
											    echo '<i class="menu-icon flaticon2-browser-2" ></i>';
											}
											if($access["top_menu_name"] == 'Menu Categories'){
											    echo '<i class="menu-icon flaticon-grid-menu-v2"></i>';
											}
											if($access["top_menu_name"] == 'Farm Plans'){
											    echo '<i class="menu-icon fas fa-tractor"></i>';
											}
											if($access["top_menu_name"] == 'Loan Products'){
	                      echo '<i class="menu-icon flaticon-coins"></i>';
	                    }
	                    if($access["top_menu_name"] == 'Savings'){
	                      echo '<i class="menu-icon flaticon-piggy-bank"></i>';
	                    }
	                    if($access["top_menu_name"] == 'Pending Withdrawal'){
	                      echo '<i class="menu-icon flaticon-calendar"></i>';
	                    }
	                   

											?>

										<!--<i class="menu-icon flaticon-graphic"></i>-->
										<span class="menu-text"><?php echo $access["top_menu_name"]; ?></span>
										<i class="menu-arrow"></i>
									</a>
									<div class="menu-submenu">
										<i class="menu-arrow"></i>
										<ul class="menu-subnav">
										<?php
										foreach ($access as $k => $val) {
                           			    if ($k != "top_menu_name") {
										?>
											<li class="menu-item" aria-haspopup="true">
												<a href="<?php echo $val["page_name"]; ?>" class="menu-link">
													<i class="menu-bullet menu-bullet-dot">
														<span></span>
													</i>
													<span class="menu-text"><?php echo $val["menu_name"]; ?></span>
												</a>
											</li>
										<?php 
										} 
										}
										?>	
											
										</ul>
									</div>
								</li>
							<?php } ?>

							<li class="menu-item" aria-haspopup="true">
									<a href="messenger" class="menu-link">
										<i class="menu-icon flaticon-speech-bubble-1"></i>
										<span class="menu-text">Messenger</span>
									</a>
								</li>

							</ul>
							<!--end::Menu Nav-->
						</div>
						<!--end::Menu Container-->
					</div>
					<!--end::Aside Menu-->
				</div>