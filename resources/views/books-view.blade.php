<!doctype html>
<html lang="en">
  <head>
    <title>Books</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{url('/')}}">Laravel</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}/books/form">Add Books</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>


    <div class="container overflow-hidden" style="width: 50%;height: 50%;margin-top: 10%;margin-bottom: 10%">
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Title</th>
              <th scope="col">Author</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($books as $b)
            <tr>
                
                <th>{{$b->book_id}}</th>
                <td>{{$b->title}}</td>
                <td>{{$b->author}}</td>
                <td>{{$b->price}}</td>
                <td>
                  {{-- <a href="{{url('/books/delete/')}}/{{$b->book_id}}"> --}}
                    <a href="{{route('book.delete',['id'=>$b->book_id])}}">
                    <button class="btn btn-primary">Delete</button>
                  </a>
                  <a href="{{url(route('book.edit'))}}">
                    <button class="btn btn-success">Edit</button>
                  </a>
                </td>
                
            </tr>
            @endforeach
          </tbody>
        </table>


        
    </div>
  </body>
</html>