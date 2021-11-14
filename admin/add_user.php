<?php 
include("header.php");
$status = FALSE;
if ( authorize($_SESSION["access"]["USER"]["ADD USER"]["create"]) || 
authorize($_SESSION["access"]["USER"]["ADD USER"]["edit"]) || 
authorize($_SESSION["access"]["USER"]["ADD USER"]["view"]) || 
authorize($_SESSION["access"]["USER"]["ADD USER"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You do not have the permission to access this page");
}
?>


		<!--begin::Main-->

		<!--begin::Header Mobile-->
		<?php 
		include("mobile_header.php");
		?>
		<!--end::Header Mobile-->

		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">

				<!--begin::Aside-->
			   <?php 
				include("left_menu.php");
				?>
				<!--end::Aside-->

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<?php include("bottom_header.php"); ?>
					<!--end::Header-->






					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Subheader-->
						<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">New Admin User</h5>
										<!--end::Page Title-->
										
									</div>
									<!--end::Page Heading-->
								</div>
								<!--end::Info-->
								
							</div>
						</div>
						<!--end::Subheader-->
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
						

							<!--begin::Container-->
							<div class="container">
								<div class="card card-custom">
									<div class="card-body p-0">
										<!--begin: Wizard-->
										<div class="wizard wizard-2" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="false">
											<!--begin: Wizard Nav-->
											<div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
												<!--begin::Wizard Step 1 Nav-->
												<div class="wizard-steps">
													<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
														<div class="wizard-wrapper">
															<div class="wizard-icon">
																<span class="svg-icon svg-icon-2x">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<div class="wizard-label">
																<h3 class="wizard-title">Account Settings</h3>
																<div class="wizard-desc">Setup Account Details</div>
															</div>
														</div>
													</div>
													<!--end::Wizard Step 1 Nav-->
													<!--begin::Wizard Step 2 Nav-->
													<div class="wizard-step" data-wizard-type="step">
														<div class="wizard-wrapper">
															<div class="wizard-icon">
																<span class="svg-icon svg-icon-2x">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Map/Compass.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z M14.1654881,7.35483745 L9.61055177,10.3622525 C9.47921741,10.4489666 9.39637436,10.592455 9.38694497,10.7495509 L9.05991526,16.197949 C9.04337012,16.4735952 9.25341309,16.7104632 9.52905936,16.7270083 C9.63705011,16.7334903 9.74423017,16.7047714 9.83451193,16.6451626 L14.3894482,13.6377475 C14.5207826,13.5510334 14.6036256,13.407545 14.613055,13.2504491 L14.9400847,7.80205104 C14.9566299,7.52640477 14.7465869,7.28953682 14.4709406,7.27299168 C14.3629499,7.26650974 14.2557698,7.29522855 14.1654881,7.35483745 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															</div>
															<div class="wizard-label">
																<h3 class="wizard-title">Privileges</h3>
																<div class="wizard-desc">Assign Menus to Admin</div>
															</div>
														</div>
													</div>
													<!--end::Wizard Step 2 Nav-->

												</div>
											</div>
											<!--end: Wizard Nav-->
											<!--begin: Wizard Body-->
											<div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
												<!--begin: Wizard Form-->
												<div class="row">
													<div class="offset-xxl-2 col-xxl-8">
														<form class="form" id="kt_form">
															<!--begin: Wizard Step 1-->
															<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
																<h4 class="mb-10 font-weight-bold text-dark">Enter Account Details</h4>
																<!--begin::Input-->
																<div class="form-group">
																	<label>Full Name</label>
																	<input type="text" class="form-control form-control-solid form-control-lg" name="name" placeholder="Full Name" value="" />
																	
																</div>
																<!--end::Input-->
																
																<div class="row">
																	<div class="col-xl-6">
																		<!--begin::Input-->
																		<div class="form-group">
																			<label>Phone</label>
																			<input type="tel" class="form-control form-control-solid form-control-lg" name="phone" placeholder="phone" value="" />
																			
																		</div>
																		<!--end::Input-->
																	</div>
																	<div class="col-xl-6">
																		<!--begin::Input-->
																		<div class="form-group">
																			<label>Email</label>
																			<input type="email" class="form-control form-control-solid form-control-lg" name="email" placeholder="Email" value="" />
																			
																		</div>
																		<!--end::Input-->
																	</div>
																</div>

																<div class="row">
							                                    <div class="col-xl-6">
							                                    	<div class="form-group">
							                                        <label for="Email">Username</label>
							                                        <input type="text" class="form-control form-control-solid form-control-lg username" name="username" id="username" />
							                                        
							                                        </div>
							                                    </div>
							                                    <div class="col-xl-6">
							                                    	<div class="form-group">
							                                        <label for="password">Password</label>
							                                        <input type="password" class="form-control form-control-solid form-control-lg password" name="password" id="password" />
							                                        
							                                    </div>
							                                    </div>
							                                </div>

							                                <div class="row">
						                                 
						                                    <div class="col-xl-12">
						                                      <div class="form-group">
						                                       <label for="Email">Status</label>
						                                      <select name="status" class="form-control form-control-solid form-control-lg mselect select status">
						                                      <option value=""  selected>Account Status</option>
						                                      <option value="1">Active</option>
						                                      <option value="0">Inactive</option>
						                                     
						                                       </select>
						                                      </div>
						                                  
						                                    </div>
						                                   
						                                </div>



															</div>
															<!--end: Wizard Step 1-->



															<!--begin: Wizard Step 2-->
															<div class="pb-5" data-wizard-type="step-content">
																<h4 class="mb-10 font-weight-bold text-dark">Assign Menus Privilege to this User</h4>
																<div class="row">
																	<div class="col-xl-12">
																		<!--begin::Input-->
																		<div class="form-group form-fields">
																			
																			<table role="table" class="table_view rowfy" id="user_table"> 
                                         <tbody role="rowgroup">
                                        <tr id="template" role="row"> 
                                         
                                          <td role="cell">
                                            <select name="module[]" class="form-control mselect select module">
                                             <option value="" class="validate"selected>Select User Menu Module</option>  
                                          <?php echo modules(); ?>
                                          </select>
                                        </td>
                                        <td role="cell">
                                      <select name="create[]" class="form-control mselect select create">
                                      <option value="" class="validate"selected>Create</option>
                                      <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                      <select name="edit[]" class="form-control mselect select edit">
                                      <option value="" class="validate" selected>Edit</option>
                                     <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="delete[]" class="form-control mselect select delete">
                                      <option value=""  selected>Delete</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="view[]" class="form-control mselect select view">
                                      <option value=""  selected>View</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>

                                      </td>
                                     
                                     </tr>
                                   </tbody>
                                        </table>  


																		</div>
																		<!--end::Input-->
																	</div>

										<div class="col-xl-12">
											<div align="center">
	                                           <button id="add-line" class="btn btn-sm bg-default addme waves-effect waves-light col-white" type="button" ><i class="menu-icon flaticon2-add mr-2 col-white"></i> Add More Privileges</button>
	                                        </div>

                                        </div>
																	
																</div>

															
															</div>
															<!--end: Wizard Step 2-->


															
															<!--begin: Wizard Actions-->
															<div class="d-flex justify-content-between border-top mt-5 pt-10">
																<div class="mr-2">
																	<button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
																</div>
																<div>
																	<button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Submit</button>
																	<button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next</button>
																</div>
															</div>
															<!--end: Wizard Actions-->
														</form>
													</div>
													<!--end: Wizard-->
												</div>
												<!--end: Wizard Form-->
											</div>
											<!--end: Wizard Body-->
										</div>
										<!--end: Wizard-->
									</div>
								</div>
							</div>
							<!--end::Container-->

						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->


<?php include("footer.php"); ?>