/**
 * Created by igor.kryvoruchko on 21.08.2017.
 */
var plus = 515;
var result = 0;
function width(){
    var len = document.getElementsByClassName('blocks').length;
    for(var i = 0; i <= len; i++){
        result = result + plus;
    }
    document.querySelector('.main').style.width = result + 'px';
}
var text;
var text1;
var text2;
function get(num) {
    var count = document.getElementsByClassName('tools_hello').length;
    var rand = Math.random() * (count - 0) + 0;
    for(var i = 0; i <= count; i++){
        if(rand <= i && rand > i - 1){
            text = document.querySelector("#" + num + i).innerHTML;
        }
    }

}


function get1(num1) {
    var count1 = document.getElementsByClassName('tools_'+num1).length;
    var rand1 = Math.random() * (count1 - 0) + 0;
    for(var i1 = 0; i1 <= count1; i1++){
        if(rand1 <= i1 && rand1 > i1 - 1){
            text1 = document.querySelector("#" + num1 + i1).innerHTML;
        }
    }
}

function get2(num2) {
    var count2 = document.getElementsByClassName('tools_goodbye').length;
    var rand2 = Math.random() * (count2 - 0) + 0;
    for(var i2 = 0; i2 <= count2; i2++){
        if(rand2 <= i2 && rand2 > i2 - 1){
            text2 = document.querySelector("#" + num2 + i2).innerHTML;
        }
    }
}



function sum(category) {
    var res = text +' '+ text1 +' '+ text2;
    document.querySelector("#win_" + category).innerHTML = res;
}

