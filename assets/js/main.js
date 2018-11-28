var slideIndex = 1;

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1} 
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block"; 
    //dots[slideIndex-1].className += " active";
}

$(document).ready(function() {
    //$.cookie("winkelmand", '{"list":[{"productid":1,"hoeveel":2,"active":true},{"productid":2,"hoeveel":5,"active":true}],"id":2}');
    
    if($(".slideshow-container")[0]) {
        showSlides(slideIndex);
    }
    
    var pageCount = 0;
    var currentPageNumber = 1;

    $( ".tableHistory" ).each(function() {
        pageCount++;
        //console.log(pageCount);
        var classname = this.className;
        var singleClassname = classname.replace('tableHistory ','');
        var idClassname = "#" + singleClassname;
        
        $(idClassname).click(function() {
            var number = this.id;
            // number is name of div to show
            for(var i = 1; i <= pageCount; i++) {
                var classNameToChange = ".tableHistory" + i;
                var classNameFontToChange = "#tableHistory" + i;
                $(classNameToChange).css("display", "none");
                
                $(classNameFontToChange).removeClass("pageSelected");
                
                $(classNameFontToChange).css("font-weight", "normal"); 
                $(classNameFontToChange).css("text-decoration", "none");  
                //$(this).css("font-weight", "bold");  
                //$(this).css("text-decoration", "underline");  
            }
            
            $(this).toggleClass("pageSelected");
            
            var classNameToShow = "." + number;
            $(classNameToShow).css("display", "block");
            
            //console.log(classNameToShow);
            
            /*
            $(classNameToShow + " .galleryIMG").each(function() {
                var nameOfFile = $(this).attr("href");
                var divToChange = $(this).find(".imageToLoad");
                var randomNumber = Math.floor(Math.random() * 500) + 100;
                setTimeout(function() {
                    divToChange.attr("src", nameOfFile);
                }, randomNumber); 
            });
            */
            //$(window).scrollTop($('.pageSelect').offset().top - ($(window).height() / 2));
        });
    });
    
    $(".buttonPageSelect").on("click", function() {
        var currentPageID = $(".pageSelected").attr('id');
        var clickedButtonID = $(this).attr('id');
        var currentPageString = currentPageID.replace("tableHistory", "");
        var currentPageNumber = parseInt(currentPageString);
        
        changePageNumber(currentPageNumber, clickedButtonID);
    });
    
    var removeAttributesPageSelect = function() {
        for(var i = 1; i <= pageCount; i++) {
            var classNameToChange = ".tableHistory" + i;
            var classNameFontToChange = "#tableHistory" + i;
            $(classNameToChange).css("display", "none");

            $(classNameFontToChange).removeClass("pageSelected");

            $(classNameFontToChange).css("font-weight", "normal"); 
            $(classNameFontToChange).css("text-decoration", "none");  
            //$(this).css("font-weight", "bold");  
            //$(this).css("text-decoration", "underline");  
        }
    }
    
    var changePageNumber = function(currentPageNumber, clickedButtonID) {
        if(clickedButtonID == "nextButton" && (currentPageNumber + 1) <= pageCount) {
            removeAttributesPageSelect();
            $("#tableHistory" + (currentPageNumber + 1)).addClass("pageSelected");
            $(".tableHistory" + (currentPageNumber + 1)) .css("display", "table");
        } else if(clickedButtonID == "prevButton" && (currentPageNumber - 1) >= 1) {
            removeAttributesPageSelect();
            $("#tableHistory" + (currentPageNumber - 1)).addClass("pageSelected");
            $(".tableHistory" + (currentPageNumber - 1)) .css("display", "table");
        }
    }
    
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
    
    var getNewCartPrices = function(obj, numberToAdd, productIdThatChanged) {
        var count = 0;
        var thePriceOfProduct;
        var totalPrice = 0;
        if(typeof obj["listW"] !== 'undefined' && obj["listW"].length > 0) {
            $(obj["listW"]).each(function() {
                var check = 0;
                var checkNew = 0;
                $.ajax({
                    async: false,
                    type: "POST",
                    url: "winkelmand.php",
                    dataType:'json',
                    data: {
                        newProductID: obj["listW"][count]["productid"],
                    },
                    success: function(data) {
                        thePriceOfProduct = data;
                    }
                });
                var countOfProduct = obj["listW"][count]["hoeveel"];
                var newPrice = thePriceOfProduct * countOfProduct;
                totalPrice += newPrice;

                //$(".fullProductRow").find(".dynamicPriceProduct[data-id='" + obj["listW"][count]["productid"] + "']").html(newPrice.toFixed(2));
                
                if(numberToAdd == 0) {
                    $(".fullProductRow[data-id='" + productIdThatChanged + "']").remove(".fullProductRow");
                } else {
                    $(".fullProductRow").find(".dynamicPriceProduct[data-id='" + obj["listW"][count]["productid"] + "']").html(newPrice.toFixed(2));
                }
                count++;
            });
        } else {
            $(".fullProductRow[data-id='" + productIdThatChanged + "']").remove(".fullProductRow");
        }
        $(".dynamicPriceProductTotal").html(totalPrice.toFixed(2));
    }
    
    $(".submitWinkelmand").on("click", function() {
        var id = parseInt($(this).attr("data-id"));
        var numberToAdd = parseInt($(".numberWinkelmand" + id).val());
        
        var confirmed = 0;
        
        var theJson = loadCart();
        if(!theJson) {
            var obj = getDefaultObject();
        } else {
            var obj = jQuery.parseJSON(theJson);
        }
        var count = 0;
        var check = 0;
        
        if(numberToAdd > 0) {
            confirmed = 1;
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
            if(confirm('Weet je zeker dat je dit product uit je winkelmandje wilt verwijderen?')) {
                confirmed = 1;
                $(obj["listW"]).each(function() {
                    if(obj["listW"][count]["productid"] == id && check == 0) {
                        obj["listW"].splice(count, 1);
                        check = 1;
                        return;
                    }
                    count++;
                });
            }
        }
        if(confirmed == 1) {
            submitDataToCookie(obj, check, count);
            var newTotaalItems = countCartTotalItems();
            $(".winkelmandCount").html(newTotaalItems);

            getNewCartPrices(obj, numberToAdd, id);
        }
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