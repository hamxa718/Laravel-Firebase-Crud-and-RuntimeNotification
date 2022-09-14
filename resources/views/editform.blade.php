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
        
        <h2>Update Fire Base Crud</h2>
        <form action="{{route('update',$key)}}" method="get">
            @csrf
            <div class="form-group">
              <label for="formGroupExampleInput">Name</label>
              <input type="text" class="form-control" name="name" value="{{$data['name']}}" id="formGroupExampleInput" placeholder="Enter Name">
             
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Role</label>
              <input type="text" class="form-control" name="role" value="{{$data['role']}}" id="formGroupExampleInput2" placeholder="Enter Role">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
    </div>

</body>
</html>