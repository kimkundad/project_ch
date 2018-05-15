@extends('admin.layouts.template')

@section('admin.stylesheet')

@stop('admin.stylesheet')

@section('admin.content')



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

										<form id="newsForm" class="form-horizontal" action="{{$url}}" method="post" enctype="multipart/form-data">
                      {{ method_field($method) }}
											{{ csrf_field() }}

											<h4 class="mb-xlg">ใส่ข้อมูลสินค้า</h4>

											<fieldset>

                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">ชื่อสินค้า*</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="มินนะ โนะ นิฮงโกะ みんなの日本語 かんじ N5+N4">
													</div>
												</div>



												<div class="form-group">
													<label class="col-md-3 control-label" for="profileAddress">หมวดหมู่*</label>
													<div class="col-md-8">
														<select name="name_department" class="form-control mb-md" required>

								                      <option value="">-- เลือกหมวดหมู่ --</option>
								                      @foreach($department as $departments)
													  <option value="{{$departments->id}}">{{$departments->name_department}}</option>
													  @endforeach
								                    </select>
													</div>
												</div>










										<div class="form-group">
												<label class="col-md-3 control-label" for="profileFirstName">รหัสสินค้า*</label>
														<div class="col-md-8">
																<input type="text" class="form-control" name="code_course" value="{{ old('code_course') }}" placeholder="EN101">
														</div>
										</div>

                      <div class="form-group">
                        <label class="col-md-3 control-label" for="profileFirstName">ราคาสินค้า*</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="1500">
                          </div>
                      </div>


											<div class="form-group">
                        <label class="col-md-3 control-label" for="profileFirstName">จำนวนสินค้า*</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="discount" value="{{ old('discount') }}" placeholder="500">
                          </div>
                      </div>




                        <div class="form-group">
                          <label class="col-md-3 control-label" for="exampleInputEmail1">รูป สินค้า*</label>
                          <div class="col-md-8">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
        														<div class="input-append">
        															<div class="uneditable-input">
        																<i class="fa fa-file fileupload-exists"></i>
        																<span class="fileupload-preview"></span>
        															</div>
        															<span class="btn btn-default btn-file">
        																<span class="fileupload-exists">Change</span>
        																<span class="fileupload-new">Select file</span>
        																<input type="file" name="image">
        															</span>
        															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
        														</div>
        													</div>
                                  </div>
                        </div>




                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">รายละเอียดสินค้า*</label>
													<div class="col-md-8">
                            <textarea class="form-control" name="detail" rows="4">{{ old('detail') }}</textarea>
													</div>
												</div>





											</fieldset>







											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
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



<script>
$.fn.datepicker.defaults.format = "yyyy-mm-dd";
</script>


@stop('admin.scripts')
