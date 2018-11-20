$(document).ready(function() {
    
    //$.cookie("winkelmand", '{"list":[{"productid":1,"hoeveel":2,"active":true},{"productid":2,"hoeveel":5,"active":true}],"id":2}');
    
    var pageCount = 0;

    $( ".tableHistory" ).each(function() {
        pageCount++;
        var classname = this.className;
        var singleClassname = classname.replace('table table-bordered tableHistory ','');
        var idClassname = "#" + singleClassname;
        
        $(idClassname).click(function() {
            console.log("test");
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
    
    var countCartTotalItems = function() {
        var cookie = $.cookie("winkelmand");
        var cookieObj = jQuery.parseJSON(cookie);
        
        var totaalItems = 0;
        var count = 0;
        
        $(cookieObj["listW"]).each(function() {
            totaalItems += cookieObj["listW"][count]["hoeveel"];
            count++;
        });
        return totaalItems;
    }
    
    var submitDataToCookie = function(obj, check, count) {
        var newObj = JSON.stringify(obj);
        $.cookie("winkelmand", newObj, { expires: 10000 });
        check = 0;
        count = 0;
    }
    
    $(".submitWinkelmand").on("click", function() {
        var id = parseInt($(this).attr("data-id"));
        var numberToAdd = parseInt($(".numberWinkelmand" + id).val());
        
        var theJson = loadCart();
        if(!theJson) {
            var obj = getDefaultObject();
        } else {
            var obj = jQuery.parseJSON(theJson);
        }
        var count = 0;
        var check = 0;
        
        if(numberToAdd > 0) {
            $(obj["listW"]).each(function() {
                if(obj["listW"][count]["productid"] == id && check == 0) {
                    obj["listW"][count]["hoeveel"] = numberToAdd;
                    check = 1;
                }
                count++;
            });

            if(check != 1) {
                obj["listW"].push({"productid":id,"hoeveel":numberToAdd,"active":true});
            }
        } else {
            $(obj["listW"]).each(function() {
                if(obj["listW"][count]["productid"] == id && check == 0) {
                    obj["listW"].splice(count, 1);
                    check = 1;
                    return;
                }
                count++;
            });
        }
        submitDataToCookie(obj, check, count);
        var newTotaalItems = countCartTotalItems();
        $(".winkelmandCount").html(newTotaalItems);
    });
    
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };
    
    $(".sort").change(function() {
        var valueOfSort = $(".sort").val();
        var pathname = window.location.pathname;
        if(getUrlParameter('id') != undefined) {
            var urlSort = pathname + "?sort=" + valueOfSort + "&id=" + getUrlParameter('id');
        } else {
            var urlSort = pathname + "?sort=" + valueOfSort;
        }
        //console.log(urlSort);
        
        window.location.href = urlSort;
    });
});