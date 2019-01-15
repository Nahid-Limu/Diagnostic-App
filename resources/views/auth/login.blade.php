@extends('layouts.app')

@section('css')
    <style>
        .bg{
            background-image: url('/img/bg.jpg');
            background-size: 100%;
            height: 800px;
            position: fixed;
            left: 0;
            right: 0;
            z-index: -1;
            filter: blur(5px);
        }
        .login{
            
            background-color: white;
            margin-top: 20%;
            
        }

        .box {
            width: 500px;
            margin-top: 200px;
        }
        
        .shape1{
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #0074d9;
            border-radius: 80px;
            float: left;
            margin-right: -50px;
        }
        .shape2 {
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #0074d9;
            border-radius: 80px;
            margin-top: -30px;
            float: left;
        }
        .shape3 {
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #0074d9;
            border-radius: 80px;
            margin-top: -30px;
            float: left;
            margin-left: -31px;
        }
        .shape4 {
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #0074d9;
            border-radius: 80px;
            margin-top: -25px;
            float: left;
            margin-left: -32px;
        }
        .shape5 {
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #0074d9;
            border-radius: 80px;
            float: left;
            margin-right: -48px;
            margin-left: -32px;
            margin-top: -30px;
        }
        .shape6 {
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #0074d9;
            border-radius: 80px;
            float: left;
            margin-right: -20px;
            margin-top: -35px;
        }
        .shape7 {
            position: relative;
            height: 150px;
            width: 150px;
            background-color: #0074d9;
            border-radius: 80px;
            float: left;
            margin-right: -20px;
            margin-top: -57px;
        }
        .float {
            position: absolute;
            z-index: 2;
        }
        
        .form {
            margin-left: 145px;
           
        }
    </style>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row bg"></div>
    <div><h1 style="text-align: center; font-family: cursive; font-size: 50px;  color: red;">Welcome</h1></div>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div id="login-column" class="col-md-6">
                <div class="box">
                    <div class="shape1"></div>
                    <div class="shape2"></div>
                    <div class="shape3"></div>
                    <div class="shape4"></div>
                    <div class="shape5"></div>
                    <div class="shape6"></div>
                    <div class="shape7"></div>
                    <div class="float">
                            
                        <form class="form" method="POST" action="/login">
                            @csrf
                            <div class="form-group">
                                <label for="username" class="text-white">Username:</label><br>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger pull-3">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <div class="col-md-4">

        </div>
    </div>
</div>
                
@endsection
