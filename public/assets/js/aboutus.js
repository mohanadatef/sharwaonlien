$(document).ready(function(){
    console.log("done");
      $(window).scroll(function(){
        let positiontop = $(document).scrollTop();
        let navpos = $("#navbar").position();
        let head1 = 125;

       
        if(positiontop > (navpos.top + 10))
        {
            $("#navbar").addClass("fixed-top");
            $("#head1Id").hide();
            $(".img-logowhite").removeClass("logo-hide");
            setTimeout(function(){
              $("#bodySecId").css('padding-top',  head1);
            },100);
        }
        else{
            $("#navbar").removeClass("fixed-top"); 
            $("#head1Id").show();
            
            $(".img-logowhite").addClass("logo-hide");  
            console.log(-1 * head1);
            setTimeout(function(){
              $("#bodySecId").css('padding-top', 0);
            },100);
        }
    });
});

function selectItem(Id)
{
    console.log(Id);
   var arr = document.getElementsByClassName("selected-item");
   for (let index = 0; index < arr.length; index++) {
     if(arr[index].id != Id)
     {
      arr[index].className = arr[index].className.replace("selected-item","unselected-item");
     }
   
   }
   document.getElementById(Id).className = document.getElementById(Id).className.replace("unselected-item","selected-item");
}


$(document).ready(function(){
    console.log("done");
    $(window).scroll(function(){
        let positiontop = $(document).scrollTop();
        let navpos = $("#navbar").position();
        let head1 = 125;


        if(positiontop > (navpos.top + 10))
        {
            $("#navbar").addClass("fixed-top");
            $("#head1Id").hide();
            $(".img-logowhite1").removeClass("logo-hide1");
            setTimeout(function(){
                $("#bodySecId").css('padding-top',  head1);
            },100);
        }
        else{
            $("#navbar").removeClass("fixed-top");
            $("#head1Id").show();

            $(".img-logowhite1").addClass("logo-hide1");
            console.log(-1 * head1);
            setTimeout(function(){
                $("#bodySecId").css('padding-top', 0);
            },100);
        }
    });
});