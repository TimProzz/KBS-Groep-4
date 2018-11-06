$(document).ready(function() {
    
    //$.cookie("winkelmand", '{"list":[{"productid":1,"hoeveel":2,"active":true},{"productid":2,"hoeveel":5,"active":true}],"id":2}');
    
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
    
    var getDefaultObject = function() {
        return {
            listW: []

        };
    }
    
    var loadCart = function() {
        var AlsJsonString = $.cookie("winkelmand");
        if(AlsJsonString == undefined) {
            return false;
        }
        return AlsJsonString;
    }
    
    $(".submitWinkelmand").on("click", function() {
        var id = parseInt($(this).attr("data-id"));
        var numberToAdd = parseInt($(".numberWinkelmand" + id).val());
        
        if(numberToAdd > 0) {
            var theJson = loadCart();
            if(!theJson) {
                var obj = getDefaultObject();
            } else {
                var obj = jQuery.parseJSON(theJson);
            }
            //var newID = Object.keys(obj).length;
            //console.log(obj);

            var count = 0;
            var check = 0;

            $(obj["listW"]).each(function() {
                if(obj["listW"][count]["productid"] == id) {
                    obj["listW"][count]["hoeveel"] = numberToAdd;
                    check = 1;
                } else {
                    check = 0;
                }
                count++;
            });

            if(check != 1) {
                obj["listW"].push({"productid":id,"hoeveel":numberToAdd,"active":true});
            }

            var newObj = JSON.stringify(obj);
            $.cookie("winkelmand", newObj);
            check = 0;
            count = 0;
        }
    });
});