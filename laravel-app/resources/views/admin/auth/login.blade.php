<!DOCTYPE html>
<html lang="en">
<head>
  <title>Truck ordering</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container mt-3">
        <h2 class="text-center">Login form</h2>
        <form action="{{route('admin.login')}}" method="post">
            {{ csrf_field() }}
          <div class="mb-3 mt-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" name="email">
          </div>
          <div class="mb-3">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password" name="pswd">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>