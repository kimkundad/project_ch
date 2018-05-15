@extends('admin.layouts.template')
@section('admin.content')

        <section role="main" class="content-body">

          <header class="page-header">
            <h2>{{$datahead}}</h2>

            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="dashboard.html">
                    <i class="fa fa-home"></i>
                  </a>
                </li>

                <li><span>{{$datahead}}</span></li>
              </ol>

              <a class="sidebar-right-toggle" data-open="sidebar-right" ><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>


          <!-- start: page -->



<div class="row">
              <div class="row">
              <div class="col-xs-12">

            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#"  class="panel-action panel-action-toggle" data-panel-toggle></a>

                </div>

                <h2 class="panel-title">{{$datahead}}</h2>
              </header>
              <div class="panel-body">

                <div class="row">
                  <div class="col-md-12">
                    <a class="btn btn-default " href="{{url('admin/course/create')}}" role="button">
                      <i class="fa fa-plus"></i> เพิ่มสินค้า</a>

                  </div>

                </div>

                <br>
                <table class="table table-bordered table-striped mb-none dataTable " id="datatable-default">
                  <thead>
                    <tr>
                      <th>#code</th>
                      <th>เจ้าของ</th>
                      <th>ชื่อสินค้า</th>
                      <th>ประเภท</th>
                      <th>ราคา</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($objs)
                @foreach($objs as $u)
                    <tr id="{{$u->c_id}}">
                      <td>{{$u->code_course}}</td>
                      <th>@if($u->provider == 'email')
                      <img data-view="user_avatar_1980" alt="" src="{{url('assets/images/avatar/'.$u->avatar)}}"
                      class="avatar avatar-32 photo" width="32" height="32" data-pin-nopin="true">
                      @else
                      <img data-view="user_avatar_1980" alt="" src="//{{$u->avatar}}"
                      class="avatar avatar-32 photo" width="32" height="32" data-pin-nopin="true">
                      @endif {{$u->name}}</th>
                      <td>{{$u->title_course}}</td>

                        <td>@foreach($department as $departments)
                          @if($u->department_id == $departments->id)
                          {{$departments->name_department}}
                          @endif
                          @endforeach
                          </td>
                          <td>{{$u->price_course}}</td>

                      <td>
                        <div class="switch switch-sm switch-success">
                          <input type="checkbox" name="switch" data-plugin-ios-switch
                          @if($u->ch_status == 1)
                          checked="checked"
                          @endif
                          />
                        </div>
                      </td>

                      <td>

                        <a style="float:left; margin:3px;" class="btn btn-primary btn-xs" href="{{url('admin/course/'.$u->c_id.'/edit')}}" role="button"><i class="fa fa-wrench"></i> </a>

                          <form  action="{{url('admin/course/'.$u->c_id)}}" method="post" onsubmit="return(confirm('Do you want Delete'))">
                            <input type="hidden" name="_method" value="DELETE">
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
            </section>

              </div>
            </div>
        </div>
</section>
@stop



@section('scripts')


<script type="text/javascript">
$(document).ready(function(){
  $("input:checkbox").change(function() {
    var course_id = $(this).closest('tr').attr('id');

    $.ajax({
            type:'POST',
            url:'{{url('admin/post_status')}}',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: { "course_id" : course_id },
            success: function(data){
              if(data.data.success){


                PNotify.prototype.options.styling = "fontawesome";
                new PNotify({
                      title: 'ยินดีด้วยค่ะ',
                      text: 'คุณได้ทำการเลือกข้อมูลสำเร็จแล้ว',
                      type: 'success'
                    });



              }
            }
        });
    });
});
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


@if ($message = Session::get('delete'))
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

@stop('scripts')
