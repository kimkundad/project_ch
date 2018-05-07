@extends('admin.layouts.template')
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
											<h4 class="mb-xlg">แก้ไขข้อมูลคอร์ส</h4>

											<fieldset>

                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">ชื่อคอร์ส*</label>
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
													<label class="col-md-3 control-label" for="profileAddress">ประเภทคอร์ส*</label>
													<div class="col-md-8">
														<select name="typecourses" class="form-control mb-md" required>

								                      <option value="">-- เลือกประเภทคอร์ส --</option>
								                      @foreach($course as $courses)
													  <option value="{{$courses->id}}"   @if( $courseinfo->type_course == $courses->id)
                              selected='selected'
                              @endif>{{$courses->type_name}}</option>
													  @endforeach
								                    </select>
																					</div>
																				</div>

																				<div class="form-group">
									 											 <label class="col-md-3 control-label" for="profileFirstName">รหัสคอร์ส*</label>
									 													 <div class="col-md-8">
									 															 <input type="text" class="form-control" name="code_course" value="{{$courseinfo->code_course}}" placeholder="EN101">
									 												 </div>
									 										 </div>


                      <div class="form-group">
                        <label class="col-md-3 control-label" for="profileFirstName">ราคาคอร์ส*</label>
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
                        <label class="col-md-3 control-label" for="profileFirstName">อัตราการสูญเสีย ดู video*</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="del_video" value="{{$courseinfo->del_video}}" placeholder="1.75">
                          </div>
                      </div>


                      <div class="form-group">
                        <label class="col-md-3 control-label" for="profileFirstName">ช่วงเวลา*</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="time_course" value="{{$courseinfo->time_course}}" placeholder="10:00-11:59 น.">
                          </div>
                      </div>


                      <div class="form-group">
                        <label class="col-md-3 control-label" for="profileFirstName">วันที่สอน*</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="day_course" value="{{$courseinfo->day_course}}" placeholder="อาทิตย์, จันทร์">
                          </div>
                      </div>



                      <div class="form-group">
                        <label class="col-md-3 control-label" for="exampleInputEmail1">รูป คอร์ส*</label>
                        <div class="col-md-8">

                      <img src="{{url('assets/uploads/'.$courseinfo->image_course)}}" class="img-responsive">
                                </div>
                      </div>


                        <div class="form-group">
                          <label class="col-md-3 control-label" for="exampleInputEmail1">รูป คอร์ส*</label>
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
                          <label class="col-md-3 control-label" for="exampleInputEmail1">เนื้อหาคอร์ส CSV file*</label>
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
        																<input type="file" name="file">
        															</span>
        															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
        														</div>
        													</div>
                                  </div>
                        </div>


                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">รายละเอียดคอร์ส*</label>
													<div class="col-md-8">
                            <textarea class="form-control" name="detail" rows="8">{{$courseinfo->detail_course}}</textarea>
													</div>
												</div>


                    <!--    <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">วันเริ่มคอร์ส*</label>
													<div class="col-md-8">
                            <div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker="" name="start_course" value="{{$courseinfo->start_course}}" class="form-control">
													</div>
													</div>
												</div>


                        <div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">วันสิ้นสุดคอร์ส*</label>
													<div class="col-md-8">
                            <div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" data-plugin-datepicker="" name="end_course" value="{{$courseinfo->end_course}}" class="form-control">
													</div>
													</div>
												</div> -->


												<div class="form-group">
	                        <label class="col-md-3 control-label" for="profileFirstName">ข้อมูลเวลาการเรียน*</label>
	                            <div class="col-md-8">
	                                <textarea class="form-control" name="time_course_text" rows="3">{{$courseinfo->time_course_text}}</textarea>
	                          </div>
	                      </div>


											</fieldset>







											<div class="panel-footer">
												<div class="row">
													<div class="col-md-9 col-md-offset-3">
														<button type="submit" class="btn btn-primary">แก้ไขคอร์ส</button>
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
















						<div class="row">
            <div class="col-md-2 col-lg-2">
            </div>

            <div class="col-md-8 col-lg-8">

            <div class="tabs">

              <div class="tab-content">
                <h4 class="mb-xlg">เพิ่มไฟล์ Video</h4>

								<form id="newsForm121" class="form-horizontal" action="{{url('add_video_course')}}" method="post" enctype="multipart/form-data">

									{{ csrf_field() }}
									<input type="hidden" class="form-control" name="course_id"  value="{{$courseinfo->id}}" >

									<div class="form-group">
										<label class="col-md-3 control-label" for="profileFirstName">ชื่อวีดีโอคอร์ส*</label>
												<div class="col-md-8">
														<input type="text" class="form-control" name="name_video" required>
											</div>
									</div>



									<div class="form-group">
										<label class="col-md-3 control-label" for="exampleInputEmail1">code วีดีโอคอร์ส*</label>
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
																	<input type="file" name="file" required>
																</span>
																<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
															</div>
														</div>
														</div>
									</div>

									<div class="form-group">
										<label class="col-md-3 control-label" for="exampleInputEmail1">รูป วีดีโอคอร์ส*</label>
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
																	<input type="file" name="image" required>
																</span>
																<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
															</div>
														</div>
														</div>
									</div>







									<div class="panel-footer">
										<div class="row">
											<div class="col-md-9 col-md-offset-3">
												<button type="submit" class="btn btn-primary">เพิ่มวิดีโอคอร์ส</button>
												<button type="reset" class="btn btn-default">Reset</button>
											</div>
										</div>
									</div>

								</form>

                </div>

          </div>

          </div>

          </div>
















					<div class="row">
					<div class="col-md-2 col-lg-2">
					</div>

					<div class="col-md-8 col-lg-8">

					<div class="tabs">

						<div class="tab-content">
							<h4 class="mb-xlg">ไฟล์ Video ทั้งหมด</h4>

<form id="dd-form" action="{{url('admin/updatesort_video/'.$courseinfo->id)}}" method="post">
	{{ csrf_field() }}
							<div class="dd" id="nestable">
							<ol class="dd-list">
								@if($video_list)
               						 @foreach($video_list as $video_lists)
								<li class="dd-item" data-id="{{ $video_lists->id }}">
									<div class="dd-handle row mar-top">
										{{$video_lists->course_video_name}}
									</div>
								</li>
								@endforeach
										 @endif
							</ol>

							<br>
							<input type="hidden" name="sort_order" id="nestable-output"  />
							<button class="btn btn-default pull-right" type="submit">บันทึกข้อมูล</button>


								</div>
								</form>

							</div>

				</div>

				</div>

				</div>












				<div class="row">
				<div class="col-md-2 col-lg-2">
				</div>

				<div class="col-md-8 col-lg-8">

				<div class="tabs">

					<div class="tab-content">
						<h4 class="mb-xlg">จัดการไฟล์ Video ทั้งหมด..</h4>

						<div class="table-responsive">
								<table class="table table-striped mb-none">

									<tbody>
										@if($video_list)
		               						 @foreach($video_list as $video_lists)
										<tr>
											<td>{{$video_lists->order_sort}}</td>
											<td style="text-align: left">{{$video_lists->course_video_name}}

											</td>
											<td>
												<form  action="{{url('admin/del_video/'.$video_lists->id)}}" method="post" onsubmit="return(confirm('Do you want Delete'))">
													<input type="hidden" name="_method" value="post">
													<input type="hidden" class="form-control" name="course_id"  value="{{$courseinfo->id}}" >
													 <input type="hidden" name="_token" value="{{ csrf_token() }}">
													<button type="submit" style="float:left; margin:3px;" class="btn btn-danger btn-xs"><i class="fa fa-times "></i></button>
												</form>
											</td>

										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>



						</div>

			</div>

			</div>

			</div>















            <div class="row">
            <div class="col-md-2 col-lg-2">
            </div>

            <div class="col-md-8 col-lg-8">

            <div class="tabs">

              <div class="tab-content">
                <h4 class="mb-xlg">เนื้อหาคอร์ส</h4>



                <div class="table-scrollable table-scrollable-borderless">
                                       <table class="table table-hover table-light">
                                        <thead class="uppercase">
                                            <tr>
                                                <th>รายละเอียดเนื้อหา</th>
                                                <th>ลำดับ</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                          <?php

                                 $urlpath = 'assets/excel/'.$courseinfo->url_course;

                               //  $urlpath = file_get_contents($urlpath);
                          // header('Content-Type: text/html; charset=utf-8');
                            $urlpath =  utf8_encode($urlpath);
                          $urlpath = iconv("TIS-620", "utf-8", $urlpath);

                         //$urlpath = trim($urlpath);
                            $f = fopen($urlpath, "r");
                            while (($line = fgetcsv($f)) !== false) {
                                    echo "<tr>";

                                    foreach ($line as $cell) {
                                            echo "<td>" . htmlspecialchars($cell) . "</td>";
                                    }
                                    echo "</tr>\n";
                            }
                            fclose($f);
                                ?>
                                        </tbody>
                                        </table>
                                      </div>

                </div>
          </div>

          </div>

          </div>



</section>
@stop


@section('scripts')
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{url('./assets/vendor/jquery-nestable/jquery.nestable.js')}}"></script>

<script src="{{url('js/bootstrap-uploadprogress.js')}}"></script>

<script>

socket.on( 'new_count_message', function( data ) {

$( "#new_count_message" ).html( data.new_count_message );
  console.log(data.new_count_message);
});

socket.on( 'new_message', function( data ) {
  console.log(data.message_in);
  if(data.check_noti === 0 ){
    if(data.provider === 'email'){
      $( "#messages_noti" ).append('<li><a href="{{url('admin/inbox_chat/')}}/'+ data.chat_user_id +'" class="clearfix"><figure class="image"><img src="{{url('assets/images/avatar/')}}/'+data.avatar+'" width="35" height="35" class="img-circle"></figure><span class="title">'+ data.name +'</span><span class="message">มีข้อความมาใหม่ถึงคุณ</span></a></li>');
    }else{
      $( "#messages_noti" ).append('<li><a href="{{url('admin/inbox_chat/')}}/'+ data.chat_user_id +'" class="clearfix"><figure class="image"><img src="//'+data.avatar+'" width="35" height="35" class="img-circle"></figure><span class="title">'+ data.name +'</span><span class="message">มีข้อความมาใหม่ถึงคุณ</span></a></li>');
    }
  }
  console.log(data.check_noti);
  $("#messages_show").scrollTop($("#messages_show")[0].scrollHeight);
  $('#notif_audio')[0].play();
});

</script>


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

@if ($message = Session::get('success_course_video'))
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

@if ($message = Session::get('edit_sort_video'))
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

@if ($message = Session::get('delete_video'))
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



<script type="text/javascript">

/*
Name: 			UI Elements / Nestable - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.1
*/

(function( $ ) {

	'use strict';

	/*
	Update Output
	*/
	var updateOutput = function (e) {
		var list = e.length ? e : $(e.target),
			output = list.data('output');

		if (window.JSON) {
			output.val(window.JSON.stringify(list.nestable('serialize')));
		} else {
			output.val('JSON browser support required for this demo.');
		}
	};

	/*
	Nestable 1
	*/
	$('#nestable').nestable({
		group: 1
	}).on('change', updateOutput);

	/*
	Output Initial Serialised Data
	*/
	$(function() {
		updateOutput($('#nestable').data('output', $('#nestable-output')));
	});

}).apply(this, [ jQuery ]);
</script>

@stop('admin.scripts')
