<?php


    class HelloWorldController extends BaseController{
        
        public static function index(){
            View::make('home.html');
        }
       
    }