<!DOCTYPE html>
<html>
<head>
    <title>How to Restore Deleted Records in Laravel? - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
      
<div class="container">
    <h1>How to Restore Deleted Records in Laravel? - ItSolutionStuff.com</h1>
  
    @if(request()->has('view_deleted'))
        <a href="{{ route('newsletter.list') }}" class="btn btn-info">View All Users</a>
        <a href="{{ route('newsletters.restore.all') }}" class="btn btn-success">Restore All</a>
    @else
        <a href="{{ route('newsletter.list', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary">View Delete Records</a>
    @endif
  
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($newsletters as $newsletter)
                <tr>
                    <td>{{ $newsletter->id }}</td>
                    <td>{{ $newsletter->title }}</td>
                    <td>{{ $newsletter->content }}</td>
                    <td>
                        @if(request()->has('view_deleted'))
                            <a href="{{ route('newsletter.restore', $newsletter->id) }}" class="btn btn-success">Restore</a>
                        @else
                            <form method="POST" action="{{ route('newsletter.delete', $newsletter->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
     
</body> 
  
<script type="text/javascript">
    $('.show_confirm').click(function(e) {
        if(!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
        }
    });
</script>
  
</html>