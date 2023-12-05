@extends('layouts.main')
@section('body')
<h1>Register</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
    </div>

    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='email'>
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name='password'>
    </div>

    <div class="mb-3">
        <label for="confirmpass" class="form-label">Password</label>
        <input type="password" class="form-control" id="confirmpass" name='confirm_password'>
      </div>
      {{ csrf_field() }}
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <a class="btn btn-primary mt-4" href="/login" role="button">Login</a>
  
@endsection