@extends('layouts.main')

@section('body')
<h1>Login</h1>
<form action="" method="POST">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name='password'>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Remember me</label>
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <a class="btn btn-primary mt-4" href="/register" role="button">Register</a>
@endsection