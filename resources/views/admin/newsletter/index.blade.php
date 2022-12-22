@extends('admin.main_master')

@section('admin')
<br>
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
          
        <div class="col-12">

         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Newsletter List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                 

                  <!-- table baru -->
                  @if(request()->has('view_deleted'))
                  <a href="{{ route('newsletters.index') }}" class="btn btn-info">View All Newsletters</a>
                  <br>
                  <a href="{{ route('newsletters.restore.all') }}" class="btn btn-success">Restore All</a>
              @else
                  <a href="{{ route('newsletters.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary">View Delete Newsletters</a>
              @endif

   
            
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Content</th>

                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($newsletters as $newsletter)
                          <tr>
                            <td><img src="{{ asset($newsletter->image) }}" style="width: 70px; height=40px;" alt=""></td>
                            <td>{{ $newsletter->title }}</td>
                            <td>	{!! $newsletter->content !!}</td>
                              <td>
                                  @if(request()->has('view_deleted'))
                                      <a href="{{ route('newsletter.restore', $newsletter->id) }}" class="btn btn-success">Restore</a>
                                      <a href="{{ route('newsletter.deletepermanently', $newsletter->id) }}" class="btn btn-danger" title="Permanently delete">
                                       Permanently Delete
                                    </a>
                                      
                                  @else
                                  <a href="{{ route('newsletter.delete', $newsletter->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-trash" title="Delete Data"></i></a>
                                  @endif
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->          
        </div>
        <!-- /.col -->


   

     
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  </div>



@endsection