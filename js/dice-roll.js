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
                        $("#cube").css("transform", "rotateY(0deg)");
                        break;
                    case 2:
                        $("#cube").css("transform", "rotateY(180deg)");
                        break;
                    case 3:
                        $("#cube").css("transform", "rotateY(270deg)");
                        break;
                    case 4:
                        $("#cube").css("transform", "rotateY(90deg)");
                        break;
                    case 5:
                        $("#cube").css({"transform": "rotateX(-90deg) rotateZ(0deg)"});
                        break;
                    case 6:
                        $("#cube").css({"transform": "rotateX(90deg) rotateZ(0deg)"});
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

//    Cube.prototype.rotateEvents = function () {//begin function
//
//        $("#side1").on("click", function () {//begin event  
//            $("#cube").css("transform", "rotateY(0deg)");
//
//        });//end event
//
//        $("#side2").on("click", function () {//begin event  
//            $("#cube").css("transform", "rotateY(180deg)");
//
//        });//end event
//
//        $("#side3").on("click", function () {//begin event  
//            $("#cube").css("transform", "rotateY(270deg)");
//
//        });//end event
//
//        $("#side4").on("click", function () {//begin event  
//            $("#cube").css("transform", "rotateY(90deg)");
//
//        });//end event
//
//        $("#side5").on("click", function () {//begin event  
//            $("#cube").css({"transform": "rotateX(-90deg) rotateZ(0deg)"});
//
//        });//end event
//
//        $("#side6").on("click", function () {//begin event  
//            $("#cube").css({"transform": "rotateX(90deg) rotateZ(-0deg)"});
//
//        });//end event
//
//    };//end function
//
//    $("#side1,#side2,#side3,#side4,#side5,#side6").on("click", function () {
//
//        //set the button value to stop
//        $("#toggle-rotate").val("stop");
//
//        //remove the .random animation class
//        $("#cube").removeClass("random");
//
//
//    });



//create instance of Cube
    var cube = new Cube();
});