<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            /*button section only*/
            .button-panel{
                input[type=button]{
                    border:black solid 1px;
                    background-color:black;
                    color:white;
                }
            }
            body{

                background-color:rgb(255,255,255);
            }

            .container {
                padding-top:50px;
                margin-left:auto;
                margin-right:auto;
                width:200px;
                height:200px;
                position: relative;
                perspective:1000px;  

            }



            #cube {

                width: 100%;
                height: 100%;
                position:absolute;
                transform-style: preserve-3d;


            }

            #cube figure {


                /*set border radius*/
                border-radius: 10px;

                /*add shadowing*/
                /*
                 parameters:
                 x,y,blur,alpha
             
                */
                box-shadow: 2px, 0px, 0px, 0.3;

                margin: 0;
                width: 204px;
                height: 204px;
                display: block;
                position: absolute;
                border:rgb(0,0,0) transparent 1px;
                background-color:rgb(100,250,178);

            }

            #cube .front  { transform: rotateY(0deg) translateZ(100px); }
            #cube .back   { transform: rotateX(180deg) translateZ(100px); }
            #cube .right  { transform: rotateY(90deg) translateZ(100px); }
            #cube .left   { transform: rotateY(-90deg) translateZ(100px); }
            #cube .top    { transform: rotateX(90deg) translateZ(100px); }
            #cube .bottom { transform: rotateX(-90deg) translateZ(100px); }

            #cube { transform: translateZ(-100px); }

            #cube{
                transform: rotateY(14deg);
            }

            .dot{ 

                border-radius:30px;
                height:30px;
                width:30px;
                background-color:rgb(255,255,255);
            }

            /* Dot alignment code below */

            .dot-ul{  
                position:absolute;
                top:50px;
                left:50px;
            }
            .dot-lr{
                position:absolute;
                top:150px;
                left:150px;

            }


            .dot-center{
                position:absolute;
                top:100px;
                left:100px; 

            }

            .dot-ur{  
                position:absolute;
                top:50px;
                left:150px;  
            }

            .dot-ll{  
                position:absolute;
                top:150px;
                left:50px; 
            }

            .dot-lc{  
                position:absolute;
                top:100px;
                left:50px;
            }
            .dot-rc{  
                position:absolute;
                top:100px;
                left:150px;  
            }

            /*animation code below*/
            .random{

                -webkit-animation: random 5s ease-in-out forwards  infinite;
                animation: random 5s ease-in-out forwards infinite;

            }


            @keyframes random {
                0% {
                    transform: translateX(0px) rotate(500deg);
                }
                12.5% {
                    transform: translateY(0px) rotateY(500deg);
                }
                25%{
                    transform: translateZ(0px) rotateZ(500deg);

                }
                37.5%{
                    transform: translateX(0px) rotateX(500deg);

                }
                50.5%{
                    transform: translateY(0px) 
                        rotateY(500deg);

                }
                62.5%{
                    transform: translateZ(0px) 
                        rotateZ(500deg);

                }
                75%{
                    transform: translateX(0px) 
                        rotateX(500deg);

                }
                87.5%{
                    transform: translateZ(0px) 
                        rotateY(500deg);

                }

                100% {
                    transform: translateY(0px) rotateY(500deg);
                }
            }
            /*webkit browser animation*/

            @-webkit-keyframes random {
                0% {
                    -webkit-transform: translateX(0px) rotate(50deg);
                }
                12.5% {
                    -webkit-transform: translateY(0px) rotateY(500deg);
                }
                25%{
                    -webkit-transform: translateZ(0px) rotateZ(500deg);

                }
                37.5%{
                    -webkit-transform: translateX(0px) rotateX(500deg);

                }
                50.5%{
                    -webkit-transform: translateY(0px) 
                        rotateY(500deg);

                }
                62.5%{
                    -webkit-transform: translateZ(0px) 
                        rotateZ(500deg);

                }
                75%{
                    -webkit-transform: translateX(0px) 
                        rotateX(500deg);

                }
                87.5%{
                    -webkit-transform: translateZ(0px) 
                        rotateY(500deg);

                }

                100% {
                    -webkit-transform: translateY(0px) rotateY(500deg);
                }

            }


            /*mixins below*/

            /*box shadow*/
            /*            .box-shadow (@x: 0px, @y: 3px, @blur: 5px, @alpha: 0.5) {
                            -webkit-box-shadow: @x @y @blur rgba(0, 0, 0, @alpha);
                            -moz-box-shadow: @x @y @blur rgba(0, 0, 0, @alpha);
                            box-shadow: @x @y @blur rgba(0, 0, 0, @alpha);
                        }
            
                        sets all four border radius values
                        .border-radius (@radius: 5px) {
                            -webkit-border-radius: @radius;
                            -moz-border-radius: @radius;
                            border-radius: @radius;
                        }*/



        </style>
    </head>
    <body>
        <div  class="button-panel">
            <input id="toggle-rotate" type ="button" value ="stop">

            <input id ="side1" type ="button" value ="side 1">
            <input id="side2" type ="button" value ="side 2">
            <input id = "side3" type ="button" value ="side 3">
            <input id="side4" type ="button" value ="side 4">
            <input id="side5" type ="button" value ="side 5">
            <input id="side6" type ="button" value ="side 6">

        </div>



        <section class="container">
            <div class ="random" id="cube">
                <figure id="one" class="front">

                    <div class="dot dot-center"></div>



                </figure>
                <figure id="two" class="back">

                    <div class="dot dot-ul"></div>     
                    <div class="dot dot-lr"></div>

                </figure>
                <figure id="three" class="right">
                    <div class="dot dot-ul"></div>
                    <div class="dot dot-center"></div>
                    <div class="dot dot-lr"></div>
                </figure>
                <figure id="four" class="left">
                    <div class="dot dot-ul"></div>
                    <div class="dot dot-ur"></div>
                    <div class="dot dot-ll"></div>
                    <div class="dot dot-lr"></div>
                </figure>
                <figure id="five" class="top">
                    <div class="dot dot-ul"></div>
                    <div class="dot dot-ur"></div>
                    <div class="dot dot-center"></div>
                    <div class="dot dot-ll"></div>
                    <div class="dot dot-lr"></div>
                </figure>
                <figure id="six" class="bottom">
                    <div class="dot dot-ul"></div>
                    <div class="dot dot-ur"></div>
                    <div class="dot dot-lc"></div>
                    <div class="dot dot-rc"></div>
                    <div class="dot dot-ll"></div>
                    <div class="dot dot-lr"></div>
                </figure>
            </div>
        </section>
        <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                function Cube() {//begin object constructor Cube

                    //call necessarry object functions
                    this.toggleCube();

                    this.rotateEvents();



                }//end object constructor Cube

                Cube.prototype.toggleCube = function () {
                    $("#toggle-rotate").on("click", function () {

                        /*
                         change button value to start if reads 
                         stop and change it to stop if it reads  start
                         */
                        var toggle = $("#toggle-rotate").val();

                        if (toggle === "start") {

                            toggle = "stop";

                        } else if (toggle === "stop") {

                            toggle = "start";

                            var num = Math.floor(Math.random() * 6) + 1;

                            switch (num) {
                                case 1:
                                    $("#cube").css("transform", "rotateY(14deg)");
                                    break;
                                case 2:
                                    $("#cube").css("transform", "rotateY(194deg)");
                                    break;
                                case 3:
                                    $("#cube").css("transform", "rotateY(284deg)");
                                    break;
                                case 4:
                                    $("#cube").css("transform", "rotateY(104deg)");
                                    break;
                                case 5:
                                    $("#cube").css({"transform": "rotateX(-90deg) rotateZ(14deg)"});
                                    break;
                                case 6:
                                    $("#cube").css({"transform": "rotateX(90deg) rotateZ(-14deg)"});
                                    break;
                                default:
                                    // code block
                            }


                        }

                        $("#toggle-rotate").val(toggle);



                        //toggle the .random animation class
                        $("#cube").toggleClass("random");


                    });
                };

                Cube.prototype.rotateEvents = function () {//begin function

                    $("#side1").on("click", function () {//begin event  
                        alert(1);
                        $("#cube").css("transform", "rotateY(14deg)");

                    });//end event

                    $("#side2").on("click", function () {//begin event  
                        $("#cube").css("transform", "rotateY(194deg)");

                    });//end event

                    $("#side3").on("click", function () {//begin event  
                        $("#cube").css("transform", "rotateY(284deg)");

                    });//end event

                    $("#side4").on("click", function () {//begin event  
                        $("#cube").css("transform", "rotateY(104deg)");

                    });//end event

                    $("#side5").on("click", function () {//begin event  
                        $("#cube").css({"transform": "rotateX(-90deg) rotateZ(14deg)"});

                    });//end event

                    $("#side6").on("click", function () {//begin event  
                        $("#cube").css({"transform": "rotateX(90deg) rotateZ(-14deg)"});

                    });//end event

                };//end function

                $("#side1,#side2,#side3,#side4,#side5,#side6").on("click", function () {

                    //set the button value to stop
                    $("#toggle-rotate").val("stop");

                    //remove the .random animation class
                    $("#cube").removeClass("random");


                });



//create instance of Cube
                var cube = new Cube();
            });
        </script>
    </body>
</html>
