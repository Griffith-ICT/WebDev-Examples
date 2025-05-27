@extends('layouts.master')

@section('title')
  Greeting Form
@endsection

@section('content')
  <form method="post" action="greeting">
    {{csrf_field()}}
    <table>
        <tr><td>Your name:</td> <td><input type="text" name="name"></td></tr>
        <tr><td>Your age:</td> <td><input type="text" name="age"></td></tr>
        <tr><td colspan=2><input type="submit" value="Submit"></td></tr>
    </table>
  </form>
@endsection