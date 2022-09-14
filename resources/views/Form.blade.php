<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        @if(session('success'))
        <h4 class="alert alert-success"> {{session('success')}}</h4>
        @endif
        
        <h2>Fire Base Crud</h2>
        <form action="{{route('submit')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="formGroupExampleInput">Name</label>
              <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Enter Name">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Role</label>
              <input type="text" class="form-control" name="role" id="formGroupExampleInput2" placeholder="Enter Role">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
<br>
    <div class="container">
        <h4>All Data</h4>
        @if(isset($data))
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php $i=1  @endphp
                @forelse ($data as $key => $dat)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$dat['name']}}</td>
                    <td>{{$dat['role']}}</td>
                    <td><a href="{{route('delete',$key)}}" class="btn btn-danger">Delete</a>
                        <a href="{{route('edit',$key)}}" class="btn btn-success">Update</a></td>
                  </tr>
                  
                @empty<td>No Data Avilable</td>

                @endforelse
              
            </tbody>
          </table>

          @endif
    </div>
</body>
</html>