$(document).ready(function() {
    
   var pageCount = 0;

    $( ".tableHistory" ).each(function() {
        pageCount++;
        var classname = this.className;
        var singleClassname = classname.replace('tableHistory ','');
        var idClassname = "#" + singleClassname;
        
        $(idClassname).click(function() {
            //console.log("test");
            var number = this.id;
            // number is name of div to show
            for(var i = 1; i <= pageCount; i++) {
                var classNameToChange = ".tableHistory" + i;
                var classNameFontToChange = "#tableHistory" + i;
                $(classNameToChange).css("display", "none");  
                $(classNameFontToChange).css("font-weight", "normal");  
                $(classNameFontToChange).css("text-decoration", "none");  
                $(this).css("font-weight", "bold");  
                $(this).css("text-decoration", "underline");  
            }
            var classNameToShow = "." + number;
            $(classNameToShow).css("display", "table");
            
            $(classNameToShow + " .galleryIMG").each(function() {
                var nameOfFile = $(this).attr("href");
                var divToChange = $(this).find(".imageToLoad");
                var randomNumber = Math.floor(Math.random() * 500) + 100;
                setTimeout(function() {
                    divToChange.attr("src", nameOfFile);
                }, randomNumber); 
                //console.log(divToChange);
            });

            $(window).scrollTop($('.pageSelect').offset().top - ($(window).height() / 2));
        });
    });
    
});