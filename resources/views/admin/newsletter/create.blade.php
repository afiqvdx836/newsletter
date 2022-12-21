@extends('admin.main_master')

@section('admin')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Data Tables</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Tables</li>
                            <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          

      <!------ Add Brand Page -->

      <div class="col-12">

          <div class="box">
             <div class="box-header with-border">
               <h3 class="box-title">Add News letter</h3>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
                 <div class="table-responsive">
                  <form method="post" action="{{ route('newsletter.store')}}" enctype="multipart/form-data" >
                      @csrf
                  <div class="form-group">
                     <h5>Title  <span class="text-danger">*</span></h5>
                     <div class="controls">
                        <input type="text"  name="title" class="form-control" > 
                </div>
                 </div>
             
                 @error('title')
                  <span class="text-danger">{{$message}}</span>
                 @enderror
             
                 <div class="form-group">
                    <h5>Content <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <textarea id="editor1" name="content" rows="10" cols="80" required="">
                                Long Description English
                        </textarea>  
                      </div>
                </div>
             
                 @error('content')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
             
                 <div class="form-group">
                     <h5> Image  <span class="text-danger">*</span></h5>
                     <div class="controls">
                  <input type="file"  name="image" class="form-control"  > </div>
                 </div>

                 @error('image')
                 <span class="text-danger">{{$message}}</span>
                @enderror
                                 
             
                          <div class="text-xs-right">
                 <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">					 
                                     </div>
              </form>
             
                 </div>
             </div>
             <!-- /.box-body -->
           </div>
           <!-- /.box -->

           
           <!-- /.box -->          
         </div>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  </div>

@endsection