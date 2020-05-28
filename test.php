<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>3dDice</title>
        <style>
            body {
                background-color:#0dd;    
            }
            #view{
                width:200px;
                height:200px;
                margin:100px;
                perspective:600px;
            }
            #dice{
                width:200px;
                height:200px;
                position:relative;
                transform-style:preserve-3d;
                transition: transform 1s;
            }
            #btnFront:checked ~ #view>#dice{
                transform:rotateY(360deg) !important;
            }
            #btnRight:checked ~ #view>#dice{
                transform:rotateY(-90deg) !important;
            }
            #btnBack:checked ~ #view>#dice{
                transform:rotateY(180deg) !important;
            }
            #btnLeft:checked ~ #view>#dice{
                transform:rotateY(90deg) !important;
            }
            #btnTop:checked ~ #view>#dice{
                transform:rotateX(-90deg) !important;
            }
            #btnBottom:checked ~ #view>#dice{
                transform:rotateX(90deg) !important;
            }
            .diceFace{
                position:absolute;
                width:200px;
                height:200px;
                text-align:center;
                line-height:200px;
                font-size:45px;
                border:2px solid #a00;
            }
            #front{
                background-color:rgba(255,0,0,0.6);
                transform:rotateY(0deg) translateZ(100px);
            }
            #right{
                background-color:rgba(0,255,0,0.6);
                transform:rotateY(90deg) translateZ(100px);
            }
            #back{
                background-color:rgba(255,255,0,0.6);
                transform:rotateY(180deg) translateZ(100px);
            }
            #left{
                background-color:rgba(255,0,255,0.6);
                transform:rotateY(-90deg) translateZ(100px);
            }
            #top{
                background-color:rgba(0,255,255,0.6);
                transform:rotateX(90deg) translateZ(100px);
            }
            #bottom{
                background-color:rgba(0,0,255,0.6);
                transform:rotateX(-90deg) translateZ(100px);
            }
            span{
                display:inline-block;
                padding:4px 10px;
                margin:3px;
                background-color:#0aa;
                border:2px inset #dd0
            }


            #test:checked + #test2{
                display:block;
                width:80px;
                background-color:#0aa;
            }
            input[type="radio"]{
                transform:scale(2,2);
                margin:10px;
                color:red;
            }
        </style>
    </head>
    <body>
        <input type="radio" name="roll" id="btnFront">Front
        <input type="radio" name="roll" id="btnRight">Right
        <input type="radio" name="roll" id="btnBack">Back
        <input type="radio" name="roll" id="btnLeft">Left
        <input type="radio" name="roll" id="btnTop">Top
        <input type="radio" name="roll" id="btnBottom">Bottom
        <div id="roll-dice">Roll</div>
        <div id="view">
            <div id="dice">
                <div class="diceFace" id="front">Front</div>
                <div class="diceFace" id="right">Right</div>
                <div class="diceFace" id="back">Back</div>
                <div class="diceFace" id="left">Left</div>
                <div class="diceFace" id="top">Top</div>
                <div class="diceFace" id="bottom">Bottom</div>
            </div>
        </div>
        <h3><a href="https://code.sololearn.com/WbdN9yqBRj20">Visit Some Other Codes Too!</a></h3>
        <script src="assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#roll-dice').click(function () {
                    alert(111); 
                });
               
            });
        </script>
    </body>
</html>