@extends('layouts.master')

@section('title','Admin Dashboard')

@section('content')



<div class="container-fluid" style="background:#DFD297;padding:20px">
    <div class="row">




        <div class="col-md-4 col-12" style="margin-bottom: 5px">

            <a href="#explorecategory" data-toggle="collapse" style="margin-bottom:5px" class="btn btn-primary btn-block"> MANAGE CATEGORY </a>



            <div id="explorecategory" class="container-fluid collapse">
                    <div class="form-group">
                        <label for="categoryname">Name of Category </label>
                        <span style="color: red"> * </span>
                        <input type="text" placeholder="Category Name" class="form-control" name="categoryname" id="categoryname">

                        <span id="error_adddeletecategory" class="text-danger"> </span>

                    </div>
                <div class="row">
                    <div class="col-md-6 col-6 text-left">
                        <button type="button" id="add_category" class="btn btn-info"> <span class="glyphicon glyphicon-plus-sign"> </span> Add Category </button>
                    </div>
                    <div class="col-md-6 col-6 text-left">
                        <button type="button" id="delete_category" class="btn btn-info">  <span class="glyphicon glyphicon-minus-sign"> </span> Delete Category </button>
                    </div>
                </div>


            </div>

        </div>








        <div class="col-md-4 col-12" style="margin-bottom: 5px">

            <a href="#exploreresults" data-toggle="collapse" style="margin-bottom:5px" class="btn btn-primary btn-block"> View Results </a>

            <div id="exploreresults" class="container-fluid collapse">
                <form action="{{ route('viewresultadmin') }}" id="userformforresult" method="POST">
                    {{csrf_field()}}
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="email"> Email </label>
                            <input type="text" value="{{ old('email') }}" placeholder="Enter Email" class="form-control" name="email" id="email">
                        </div>

                    <div class="form-group col-md-6">
                        <label for="date"> Date of Exam Taken </label>
                        <input type="date" value="{{ old('date') }}" placeholder="Enter Date" class="form-control" name="date" id="date">
                    </div>
                    </div>


                    <div class="form-row">
                    <div class="form-group col-md-6">
                    </div>

                        <div class="form-group col-md-6">
                            <label for="subjectname"> Name of Subject </label>
                            <input type="text"  value="{{ old('subjectname') }}" placeholder="Subject Name" class="form-control"  name="subjectname" id="subjectname" maxlength="60" >

                        </div>
                        <span id="error_viewresult" class="text-danger"></span>
                    </div>




                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="submit" id="goforemail" value="GO" class="btn btn-info ml-auto">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="submit" value="GO" id="goforsubjectname" class="btn btn-info">
                        </div>
                    </div>

                </form>
            </div>

        </div>








        <div class="col-md-4 col-12" style="margin-bottom: 5px">
            <a href="{{ route('user_list') }}" class="btn btn-primary btn-block"> <span class="glyphicon glyphicon-info-sign"> </span> View All Users </a>
        </div>

    </div>









    <div class="row" style="margin-top:5px">
        <div class="col-md-8 col-12">
            <a href="#exploresubject" data-toggle="collapse" style="margin-bottom:5px" class="btn btn-primary btn-block"> MANAGE SUBJECTS </a>



            <div id="exploresubject" class="container-fluid collapse">

                <div class="form-row">
                    <div class="col-md-4 col-12 form-group">
                        <label for="subject_name"> Name of Subject  </label>
                        <span style="color: red"> ** </span>
                        <input type="text"  value="{{ old('subject_name') }}"  placeholder="Subject Name" class="form-control" name="subject_name" id="subject_name" maxlength="60">
                        <span id="error_adddeletesubject" class="text-danger"> </span>
                    </div>

                    <div class="col-md-4 col-12 form-group">
                        <label for="categories">Categories</label>
                        <span style="color: red"> * </span>
                            <select id="categories" class="form-control" name="categories">
                                <option style="display:none" disabled selected value> Select Categories </option>
                               @foreach($data as $datas)
                                    <option value="{{ $datas->Category_Name }}"> {{ $datas->Category_Name }} </option>
                                   @endforeach
                            </select>
                        <span id="error_selectcategory" class="text-danger"> </span>
                    </div>
                </div>

<div class="form-row">
                    <div class="col-md-4 col-12 form-group">
                        <label for="duration" >Duration (Minutes)</label>
                        <span style="color: red"> * </span>
                        <input class="form-control" name="duration" type="number" min="1" max="180" id="duration">
                        <span id="error_duration" class="text-danger"> </span>
                    </div>

                <div class=" col-md-4 col-12 form-group">
                    <label for="fullmarks"> Full Marks </label>
                    <span style="color: red"> * </span>
                    <input class="form-control" name="fullmarks" type="number" min="1" max="300" id="fullmarks">
                    <span id="error_fullmarks" class="text-danger"> </span>
                </div>
</div>
                <div class="form-row">
                <div class="col-md-4 col-12 form-group">
                    <label for="passmarks"> Pass Marks </label>
                    <span style="color: red"> * </span>
                    <input class="form-control" name="passmarks" type="number" min="1" max="300" id="passmarks">
                    <span id="error_passmarks" class="text-danger"> </span>
                </div>

                <div class="col-md-4 col-12form-group">
                    <label for="dateofexam" >Date of Exam </label>
                    <input type="date" class="date form-control" name="dateofexam" id="dateofexam">
                    <span id="error_dateofexam" class="text-danger"> </span>
                </div>
</div>

                <div class="row" style="margin-top: 5px">
                    <div class="col-md-4 col-6 text-left">
                        <button type="button" id="add_subject" class="btn btn-info"> <span class="glyphicon glyphicon-plus-sign"> </span> ADD SUBJECT </button>
                    </div>

                    <div class="col-md-4 col-6 text-right">
                        <button type="button" id="delete_subject" class="btn btn-info">  <span class="glyphicon glyphicon-minus-sign"> </span> DELETE SUBJECT</button>
                    </div>
                </div>


            </div>

        </div>

        <div class="col-md-4">

        </div>

        </div>

</div>






@if(!$subjects->isEmpty())
<div class="card" style="margin-top: 20px" id="listofsubjectsadded">
    <div class="card-header"> <span class="glyphicon glyphicon-cog"> </span>  List of Subjects  </div>

    @include('includes.error-message')

    <div class="card-body">
    {{--@if($subjects->isEmpty())--}}
            <table class="table table-bordered table-responsive-sm">
                <thead class="thead-light">
                <tr>
                    <th>Subject Name</th>
                    <th>Category Name</th>
                    <th>Duration</th>
                    <th>Full Marks</th>
                    <th>Pass Marks</th>
                    <th>Exam Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                    <tr>

                        <td>{{$subject->Subject_Name}}</td>

                        <td> {{$subject->category->Category_Name}} </td>
                        <td>{{$subject->Duration}} mins</td>
                        <td>{{$subject->Full_Marks}}</td>
                        <td>{{$subject->Pass_Marks}}</td>
                        <td>{{$subject->Date_of_Exam}} </td>
                        <td>
                            <h4>
                                @if($subject->Status == 1)
                                    <span class="badge badge-success"  style="font-size:16px;padding:4px 8px"> Active </span>
                                    <a class="btn btn-sm btn-info" href="{{ route('changesubjectactivestatus',['id' =>$subject->id] )}}"> Inactivate </a>
                                        @else
                                            <span class="badge badge-warning" style="font-size:16px;padding:4px 8px">Inactive  </span>
                                    <a class="btn btn-sm btn-info" href="{{ route('changesubjectactivestatus',['id' =>$subject->id] )}}"> Activate </a>
                                                @endif
                            </h4>
                        </td>

                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('question_managing',['id' =>$subject->id] )}}"> Manage Questions</a>
                           <a class="btn btn-sm btn-warning"> <span class="glyphicon glyphicon-edit"> </span> Edit </a>
                            <a class="btn btn-sm btn-danger" id="btn-delete" href="{{ route('delete_subject',['id' =>$subject->id] )}}">Delete Subject </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
    {{--@endif--}}
    </div>
</div>

@endif
{{ $subjects->links("pagination::bootstrap-4") }}
{{--{{ $subjects->links() }}--}}








    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');





      $(document).ready(function() {


          $('a#btn-delete').on('click', function(e){
              e.preventDefault();
              e.stopPropagation();
              var $a = this;

              swal({
                          title: "Are you sure?",
                          text: "You will not be able to recover this action!",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: '#DD6B55',
                          confirmButtonText: 'Yes, delete it!',
                          closeOnConfirm: false
                      },
                      function(){
                          document.location.href=$($a).attr('href');
                      });
          });



                  $('#add_category').button().click(function (e) {
              e.preventDefault();
              var error_adddeletecategory = '';
              var btnname = 'adcategory';
              var categoryname = $('#categoryname').val();
              /*if (categoryname == '')
               {
               $('#error_adddeletecategory').html('<label class="text-danger">Category name cannot be empty.</label>');
               $('#categoryname').addClass('is-invalid');
               }*/
              if(categoryname.length === 0)
              {
                  $('#error_adddeletecategory').html('<label class="text-danger"> Category name cannot be empty. </label>');
                  $('#categoryname').addClass('is-invalid');
              }
              else
              {
                  $('#error_adddeletecategory').empty();
                  $('#categoryname').removeClass('is-invalid');
                  $.ajax({
                      method: 'POST',
                      url: "{{ route('manage_categoryansubject') }}",
                      data: {
                          categoryname:categoryname,
                          butnname: btnname,
                          _token:CSRF_TOKEN

                      },
                      success:function(result)
                      {
                          if(result.message == "Successfully Added")
                          {
                              $('input[name=categoryname]').val('');
                              $('#error_adddeletecategory').html('<label class="text-success">Successfully Added.</label>');
                              $('#categoryname').removeClass('is-invalid');

                                  $('#categories').append($("<option></option>").attr("value",result.catname).text(result.catname));


                          }
                          if (result == "Category Name Already Exists")
                          {
                              $('#error_adddeletecategory').html('<label class="text-danger">Category Name Already Exists.</label>');
                              $('#categoryname').addClass('is-invalid');
                          }
                      }
                  });
              }
          });





          $('#delete_category').button().click(function (e) {
              e.preventDefault();
              var error_adddeletecategory = '';
              var btnname = 'deletcategory';
              var categoryname = $('#categoryname').val();
              /*if (categoryname == '')
               {
               $('#error_adddeletecategory').html('<label class="text-danger">Category name cannot be empty.</label>');
               $('#categoryname').addClass('is-invalid');
               }*/
              if(categoryname.length === 0)
              {
                  $('#error_adddeletecategory').html('<label class="text-danger">Category name cannot be empty.</label>');
                  $('#categoryname').addClass('is-invalid');
              }
              else
              {
                  $('#error_adddeletecategory').empty();
                  $('#categoryname').removeClass('is-invalid');
                  $.ajax({
                      method: 'POST',
                      url: "{{ route('manage_categoryansubject') }}",
                      data: {
                          categoryname:categoryname,
                          butnname: btnname,
                          _token:CSRF_TOKEN

                      },
                      success:function(result)
                      {
                          if(result == "Successfully Deleted")
                          {
                              $('input[name=categoryname]').val('');
                              $('#error_adddeletecategory').html('<label class="text-success">Successfully Deleted.</label>');
                              $('#categoryname').removeClass('is-invalid');

                              $("#categories option[value='"+result.catname+"']").remove();

                          }
                          if (result == "Category Name Doesnot Exists")
                          {
                              $('#error_adddeletecategory').html('<label class="text-danger">Category Name Does not Exists.</label>');
                              $('#categoryname').addClass('is-invalid');
                          }
                          if (result == "Failed")
                          {
                              $('#error_adddeletecategory').html('<label class="text-danger"> Failed to Delete. Something went wrong. </label>');
                              $('#categoryname').addClass('is-invalid');
                          }

                      }
                  });
              }
          });





          $('#add_subject').button().click(function (e) {
              e.preventDefault();
              var error_adddeletesubject = '';
              var error_selectcategory = '';
              var error_duration = '';
              var error_fullmarks = '';
              var error_passmarks = '';
              var error_dateofexam = '';
              var btnname = 'addsubject';
              var subjectname = $('#subject_name').val();
              var categories = $('#categories').val();
              var duration = $('#duration').val();
              var fullmarks = $('#fullmarks').val();
              var passmarks = $('#passmarks').val();
              var dateofexam = $('#dateofexam').val();
              $('#error_adddeletesubject').empty();
              $('#error_selectcategory').empty();
              $('#error_duration').empty();
              $('#error_fullmarks').empty();
              $('#error_passmarks').empty();
              $('#error_dateofexam').empty();
              $('#subject_name').removeClass('is-invalid');
              $('#categories').removeClass('is-invalid');
              $('#duration').removeClass('is-invalid');
              $('#fullmarks').removeClass('is-invalid');
              $('#passmarks').removeClass('is-invalid');
              $('#dateofexam').removeClass('is-invalid');

              if(subjectname.length === 0 || !categories  || duration.length === 0 || fullmarks.length === 0 || passmarks.length === 0 || duration < 1 || duration > 180 || fullmarks < 1 || fullmarks > 300 || passmarks < 1 || passmarks > 300) {
              if (subjectname.length === 0) {
                  $('#error_adddeletesubject').html('<label class="text-danger">Subject name cannot be empty.</label>');
                  $('#subject_name').addClass('is-invalid');
              }
              if (!categories) {
                  $('#error_selectcategory').html('<label class="text-danger">Category name cannot be empty.</label>');
                  $('#categories').addClass('is-invalid');
              }
              if (duration.length === 0) {
                  $('#error_duration').html('<label class="text-danger">Duration cannot be Null.</label>');
                  $('#duration').addClass('is-invalid');
              }
              if(fullmarks.length === 0) {
                      $('#error_fullmarks').html('<label class="text-danger">Enter Full Marks.</label>');
                      $('#fullmarks').addClass('is-invalid');
              }
              if(passmarks.length === 0) {
                      $('#error_passmarks').html('<label class="text-danger">Enter Pass Marks.</label>');
                      $('#passmarks').addClass('is-invalid');
              }
              if (duration < 1 || duration > 180) {
                  $('#error_duration').html('<label class="text-danger">Duration can be from 1 minute to 180 minute.</label>');
                  $('#duration').addClass('is-invalid');
              }
              if(fullmarks < 1 || fullmarks > 300) {
                      $('#error_fullmarks').html('<label class="text-danger">Full Marks can be from 1  to 300.</label>');
                      $('#fullmarks').addClass('is-invalid');
              }
              if(passmarks < 1 || passmarks > 300) {
                      $('#error_passmarks').html('<label class="text-danger">Pass Marks can be from 1  to 300.</label>');
                      $('#passmarks').addClass('is-invalid');
              }
          }
              else
              {
                  $('#error_adddeletesubject').empty();
                  $('#error_selectcategory').empty();
                  $('#error_duration').empty();
                  $('#error_fullmarks').empty();
                  $('#error_passmarks').empty();
                  $('#error_dateofexam').empty();
                  $('#subject_name').removeClass('is-invalid');
                  $('#categories').removeClass('is-invalid');
                  $('#duration').removeClass('is-invalid');
                  $('#fullmarks').removeClass('is-invalid');
                  $('#passmarks').removeClass('is-invalid');
                  $('#dateofexam').removeClass('is-invalid');
                  $.ajax({
                      method: 'POST',
                      url: "{{ route('manage_categoryansubject') }}",
                      data: {
                          subjectname:subjectname,
                          categories:categories,
                          duration:duration,
                          fullmarks:fullmarks,
                          passmarks:passmarks,
                          dateofexam:dateofexam,
                          butnname: btnname,
                          _token:CSRF_TOKEN

                      },
                      success:function(result)
                      {
                          if(result.message == "Successfully Added")
                          {
                              $('input[name=subject_name]').val('');
                              $('input[name=categories]').val('');
                              $('input[name=duration]').val('');
                              $('input[name=fullmarks]').val('');
                              $('input[name=passmarks]').val('');
                              $('input[name=dateofexam]').val('');
                              $('#error_adddeletesubject').html('<label class="text-success">Subject Successfully Added.</label>');
                              $('#subject_name').removeClass('is-invalid');
                              $('#categories').removeClass('is-invalid');
                              $('#duration').removeClass('is-invalid');
                              $('#fullmarks').removeClass('is-invalid');
                              $('#passmarks').removeClass('is-invalid');
                              $('#dateofexam').removeClass('is-invalid');

                              $("#listofsubjectsadded").load(" #listofsubjectsadded");
                          }

                          if (result == "Pass Marks Greater or Equal")
                          {
                              $('#error_passmarks').html('<label class="text-danger"> Pass Marks should be less than full marks. </label>');
                              $('#passmarks').addClass('is-invalid');
                              $('#subject_name').removeClass('is-invalid');
                              $('#categories').removeClass('is-invalid');
                              $('#duration').removeClass('is-invalid');
                              $('#fullmarks').removeClass('is-invalid');
                              $('#dateofexam').removeClass('is-invalid');

                          }

                          if (result == "Already")
                          {
                              $('#error_adddeletesubject').html('<label class="text-danger"> Subject already exists on same category. </label>');
                              $('#subject_name').addClass('is-invalid');
                              $('#categories').addClass('is-invalid');
                              $('#duration').removeClass('is-invalid');
                              $('#dateofexam').removeClass('is-invalid');
                              $('#fullmarks').removeClass('is-invalid');
                              $('#passmarks').removeClass('is-invalid');
                          }

                          if (result == "Failed")
                          {
                              $('#error_adddeletesubject').html('<label class="text-danger"> Failed to Add. Something went wrong. </label>');
                              $('#subject_name').addClass('is-invalid');
                              $('#categories').addClass('is-invalid');
                              $('#duration').addClass('is-invalid');
                              $('#dateofexam').addClass('is-invalid');
                              $('#fullmarks').addClass('is-invalid');
                              $('#passmarks').addClass('is-invalid');
                          }

                          if (result == "Category Name Doesnot Exist")
                          {
                              $('#error_selectcategory').html('<label class="text-danger"> Category Name Does not Exist. </label>');
                              $('#subject_name').removeClass('is-invalid');
                              $('#categories').addClass('is-invalid');
                              $('#duration').removeClass('is-invalid');
                              $('#fullmarks').removeClass('is-invalid');
                              $('#passmarks').removeClass('is-invalid');
                              $('#dateofexam').removeClass('is-invalid');
                          }
                      }
                  });
              }
          });





          $('#delete_subject').button().click(function (e) {
              e.preventDefault();
              var error_adddeletesubject = '';
              var error_selectcategory = '';
              var error_duration = '';
              var btnname = 'deletesubject';
              var subjectname = $('#subject_name').val();
              var categories = $('#categories').val();

              $('#error_adddeletesubject').empty();
              $('#error_selectcategory').empty();
              $('#error_duration').empty();
              $('#error_fullmarks').empty();
              $('#error_passmarks').empty();
              $('#error_dateofexam').empty();
              $('#subject_name').removeClass('is-invalid');
              $('#categories').removeClass('is-invalid');
              $('#duration').removeClass('is-invalid');
              $('#fullmarks').removeClass('is-invalid');
              $('#passmarks').removeClass('is-invalid');
              $('#dateofexam').removeClass('is-invalid');


              if(subjectname.length === 0 || !categories)
              {
                  if(subjectname.length === 0)
                  {
                      $('#error_adddeletesubject').html('<label class="text-danger">Subject name cannot be empty.</label>');
                      $('#subject_name').addClass('is-invalid');
                  }

                  if(!categories)
                  {
                      $('#error_selectcategory').html('<label class="text-danger">Category Name cannot be empty.</label>');
                      $('#categories').addClass('is-invalid');
                  }
              }

              else
              {
                  $('#error_adddeletesubject').empty();
                  $('#error_selectcategory').empty();
                  $('#error_duration').empty();
                  $('#subject_name').removeClass('is-invalid');
                  $('#categories').removeClass('is-invalid');
                  $('#duration').removeClass('is-invalid');
                  $.ajax({
                      method: 'POST',
                      url: "{{ route('manage_categoryansubject') }}",
                      data: {
                          subjectname:subjectname,
                          categories:categories,
                          butnname: btnname,
                          _token:CSRF_TOKEN

                      },
                      success:function(result)
                      {
                          if(result == "Successfully Deleted")
                          {
                              $('input[name=subjectname]').val('');
                              $('input[name=categories]').val('');
                              $('input[name=duration]').val('');
                              $('#error_adddeletesubject').html('<label class="text-success">Subject Successfully Deleted.</label>');
                              $('#subject_name').removeClass('is-invalid');
                              $('#categories').removeClass('is-invalid');
                              $('#duration').removeClass('is-invalid');
                              $("#listofsubjectsadded").load(" #listofsubjectsadded");
                          }
                          if (result == "Failed")
                          {
                              $('#error_adddeletesubject').html('<label class="text-danger"> Failed to Add. Something went wrong. </label>');
                              $('#subject_name').addClass('is-invalid');
                          }

                          if (result == "No Exists")
                          {
                                  $('#error_adddeletesubject').html('<label class="text-danger"> Subject Doesnot exist. </label>');
                                  $('#subject_name').addClass('is-invalid');
                          }
                      }
                  });
              }
          });
       });
</script>
@endsection