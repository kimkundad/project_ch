@extends('admin.layouts.template')

@section('admin.stylesheet')
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
@stop('admin.stylesheet')

@section('admin.content')
<style>

</style>
				<section role="main" class="content-body">

					<header class="page-header">
						<h2>{{$header}}</h2>

						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="dashboard.html">
										<i class="fa fa-home"></i>
									</a>
								</li>

								<li><span>{{$header}}</span></li>
							</ol>

							<a class="sidebar-right-toggle" data-open="sidebar-right" ><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>


					<!-- start: page -->




							<div class="row">
							<div class="col-md-2 col-lg-2">
							</div>







              <div class="col-md-8 col-lg-8">

							<div class="tabs">

								<div class="tab-content">

									<div id="edit" class="tab-pane active">

                    @if (count($errors) > 0)
                    <br>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

										<form class="form-horizontal" action="{{$url}}" method="post" enctype="multipart/form-data">
                      {{ method_field($method) }}
											{{ csrf_field() }}
                      <input type="hidden" class="form-control" name="id"  value="{{$courseinfo->id}}" >
											<h4 class="mb-xlg">แก้ไขข้อมูลสินค้า</h4>

											<fieldset>

                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">ชื่อสินค้า*</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="name" value="{{$courseinfo->title_course}}" placeholder="มินนะ โนะ นิฮงโกะ みんなの日本語 かんじ N5+N4">
													</div>
												</div>



												<div class="form-group">
													<label class="col-md-3 control-label" for="profileAddress">เลือกภาควิชา*</label>
													<div class="col-md-8">
														<select name="name_department" class="form-control mb-md" required>

								                      <option value="">-- เลือกภาควิชา --</option>
								                      @foreach($department as $departments)
													  <option value="{{$departments->id}}"   @if( $courseinfo->department_id == $departments->id)
                              selected='selected'
                              @endif>{{$departments->name_department}}</option>
													  @endforeach
								                    </select>
																					</div>
																				</div>






																				<div class="form-group">
									 											 <label class="col-md-3 control-label" for="profileFirstName">รหัสสินค้า*</label>
									 													 <div class="col-md-8">
									 															 <input type="text" class="form-control" name="code_course" value="{{$courseinfo->code_course}}" placeholder="EN101">
									 												 </div>
									 										 </div>


                      <div class="form-group">
                        <label class="col-md-3 control-label" for="profileFirstName">ราคาสินค้า*</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price" value="{{$courseinfo->price_course}}" placeholder="1500">
                          </div>
                      </div>


											<div class="form-group">
                        <label class="col-md-3 control-label" for="profileFirstName">ราคาส่วนลด*</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="discount" value="{{$courseinfo->discount}}" placeholder="1500">
                          </div>
                      </div>








                      <div class="form-group">
                        <label class="col-md-3 control-label" for="exampleInputEmail1">รูปสินค้า*</label>
                        <div class="col-md-8">

                      <img src="{{url('assets/uploads/'.$courseinfo->image_course)}}" class="img-responsive">
                                </div>
                      </div>







                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">รายละเอียดสินค้า*</label>
													<div class="col-md-8">
                            <textarea class="form-control" name="detail" rows="8">{{$courseinfo->detail_course}}</textarea>
													</div>
												</div>








											</fieldset>







											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">แก้ไขสินค้า</button>
														<button type="reset" class="btn btn-default">Reset</button>
													</div>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
						</div>



						</div>




















</section>
@stop


@section('scripts')
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>


<script src="{{url('js/bootstrap-uploadprogress.js')}}"></script>




<script>
	$("#newsForm121").uploadprogress({redirect_url: '{{url('admin/course/'.$courseinfo->id.'/edit')}}'});
	//$("#newsForm121").uploadprogress();

$.fn.datepicker.defaults.format = "yyyy-mm-dd";
</script>

@if ($message = Session::get('success_course'))
<script type="text/javascript">
var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
var notice = new PNotify({
      title: 'ยินดีด้วยค่ะ',
      text: '{{$message}}',
      type: 'success',
      addclass: 'stack-bar-top',
      stack: stack_bar_top,
      width: "100%"
    });
</script>
@endif









@stop('admin.scripts')
