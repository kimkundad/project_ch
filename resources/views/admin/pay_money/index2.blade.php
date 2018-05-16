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




                <table class="table table-bordered table-striped mb-none dataTable " id="datatable-default">
                  <thead>
                    <tr>
                      <th>NO.</th>
                      <th>เจ้าของสินค้า</th>
                      <th>สินค้า</th>
                      <th>สถานะจ่ายเงิน</th>
                      <th>จำนวนเงิน</th>
                      <th>จำนวนสินค้า</th>

                      <th>สั่งซื้อวันที่</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($objs)
                @foreach($objs as $u)
                    <tr id="{{$u->Oid}}">
                      <td><a href="{{url('admin/order_shop/'.$u->Oid.'/edit')}}">หมายเลข #{{$u->Oid}}</a></td>
                      <td><a href="{{url('admin/student/'.$u->Ustudent.'/edit')}}" target="_blank">{{$u->name}}</a></td>
                      <td><a href="{{url('admin/course/'.$u->Ucourse.'/edit')}}" target="_blank">{{$u->title_course}}</a></td>
                      <td>
                        <div class="switch switch-sm switch-success">
                          <input type="checkbox" name="switch" data-plugin-ios-switch
                          @if($u->discount_1 == 1)
                          checked="checked"
                          @endif
                          />
                        </div>
                      </td>
                      <td>{{$u->money_tran}}</td>
                      <td>{{$u->end_time}}</td>

                      <td>{{$u->Dcre}}</td>


                      <td>
                        <a style="float:left; margin-right:8px;" class="btn btn-primary btn-xs" href="{{url('admin/order_shop/'.$u->Oid.'/edit')}}"
                          role="button"><i class="fa fa-wrench"></i> </a>



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
            url:'{{url('admin/post_status_pay')}}',
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

@if ($message = Session::get('success'))
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
