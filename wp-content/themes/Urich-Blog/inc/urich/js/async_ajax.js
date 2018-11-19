//AJAX social save
jQuery(document).ready(function ($) {
    var all_buttons = $('.blog_article-sidebar-social-item-link');
    all_buttons.on('click',function () {
        // e.preventDefault();
         clickedElement = $(this);
         elementForChange = $(this).next('.blog_article-sidebar-social-item-num');
         var post_id = $('#post_id_num').val();
         var share_button = $(this).attr('id');
         var thisNumber = $(this).next('.blog_article-sidebar-social-item-num').html();
         var data = {
            action: 'social_share',
            social_value: share_button,
            current_post_id : post_id
         };


         $.post(myajax.url, data, function (response) {

             if(response.data==true)
             {
                 elementForChange.text(++thisNumber);
                 elementForChange.css('text-shadow','#000 2px 3px 7px');
                 //window.location.href = clickedElement.attr('href');
             }
             else alert('Sorry, something is wrong...');
         })
    })

})

//generate DOM elements of pagination list
function genetateListOfNumpagination(allpostsList) {
    if(allpostsList==null) {
        allpostsList = jQuery('.all-numbers-posts.hidden').val();
        // console.log('argument without func'+allpostsList);
    }

    jQuery(document).ready(function ($) {
        var ulElementPagination =  $('.pagination-list');
        ulElementPagination.empty('li');
        if (allpostsList!=null) {
            var result = Array.isArray(allpostsList);
            var array_post_ids;
        if(result == false)
                array_post_ids = allpostsList.split(',');     //parse string to array
            else array_post_ids = array_post_ids;
             // console.log(array_post_ids); //for debug
            //method for generate correct chunks
            Array.prototype.chunk = function (n) {
                if (!this.length) {
                    return [];
                }
                return [this.slice(0, n)].concat(this.slice(n).chunk(n));
            };
            var converted_array = array_post_ids.chunk(6);
            converted_array.forEach(function (item, i) {
                ++i;
                var liElement = document.createElement('li');    //generate Li element
                var aChildElement = document.createElement('a'); // generate A element
                if (i == 1) {
                    liElement.className = 'active-pagination';
                }   //set active
                aChildElement.innerHTML = i;                       //set Number of pagination on Front-End
                var attr = item.toString();                        //parse Array to string of numbers
                aChildElement.setAttribute('data', attr);         //setting numbers for response by AJAX
                aChildElement.className += " " + "pagination-list-item-link";         //setting classes for a elements
                liElement.className += " " + "pagination-list-item";         //setting classes for a elements
                aChildElement.setAttribute('href', '#');
                // liElement.setAttribute('class', 'pagination-list-item');
                liElement.appendChild(aChildElement);            //create <li><a></li>
                ulElementPagination.append(liElement);           //create list in <ul><li><a></li></li></ul>
            })
        }
    })
}
//call generate pagination list
jQuery(document).ready(genetateListOfNumpagination());
//define variable for use
var url = jQuery('.all-numbers-posts').attr('data');// at start use global url ajax for send
var selectedTab = ''; //temp at start use global variable
var defaultCategory = '5'; // parent category of BLOG (id)
//event on click TabFilter of Categories
jQuery(document).ready(function ($) {

    $('.filter-tabs-tab').css('cursor','pointer');
    $('.filter-tabs-tab').on('click',function () {
        $(this).toggleClass('active-tab');

        selectedTab = '';
        $('.active-tab').each(function (i) {
        if (i>0) selectedTab +=',';
        selectedTab +=$(this).attr('data-filter');
        });
        if (selectedTab=='') selectedTab = defaultCategory;
        updateSlug('', selectedTab, url, true, '');//true - reload list of pagination
    })

})
//CALL UPDATE POST VIEW BY CLICK ON NUMBER
jQuery(document).ready(function ($) { // get arguments & call ajax method
    $('body').on('click','.pagination-list-item-link', function (e) {
        e.preventDefault();
        $('.active-pagination').removeClass('active-pagination');//set active class for current elements
        $(this).parent().addClass('active-pagination');

        var containerForUpdate = $('blog-content');

        var array_post_ids=$(this).attr('data');
        currentCategory = defaultCategory;
        if(selectedTab) {
            var currentCategory = selectedTab;
        }
        // console.log(currentCategory);          //for debug
        var currentNum = array_post_ids;
        // var url = $('.all-numbers-posts').attr('data');

        if(currentNum!==null && url!==null) {
            containerForUpdate.animate({opacity: "0.2" }, 10, "linear");
            updateSlug(currentNum, currentCategory, url, false, '');  //call AJAX method, false - notreload list of pagination
        }
        else {
            console.log('Sorry... empty values!');
            return false;
        }
    })

});
//AJAX GET BY JQUERY
function updateSlug(currentNum, currentCategory, url, reloadPagination, searchString) { // AJAX METHOD

    $.get(url + '?number_pagination=' + currentNum + '&data-filter=' + currentCategory + '&search-filter=' + searchString) // send request

        .done(function(data){
            $('.blog-content').css('opacity','0.3');
            // $(window).attr('location', url + '?number_pagination=' + currentNum); // reload all page with arguments
            var $data = $(data); // STRING CONVERT TO OBJECT for use to get new element
            //window.history.pushState('','',this.url); //generate new URL in widow browser
            //data - is string at first
            //$data - is object now to use
            $(document).find('.blog-content').html($data.find('.blog-content').html()).animate({opacity: "1" }, 300, "linear", function () {

            });
            $(document).find('.all-numbers-posts').val($data.find('.all-numbers-posts').val());
            var data_filter = $('.filter-tabs-tab.active-tab').attr('data-filter');
            if(reloadPagination == true) {
                //console.log('in true reload'); //for debug
                genetateListOfNumpagination($('.all-numbers-posts').val());
            }
            //$('.active-pagination').removeClass('active-pagination');
            //$('.pagination.wrapper').find('a[data*='+currentNum+']').parent().addClass('active-pagination');
            // console.log('success ajax' + $('.all-numbers-posts').val());
            // Appened new html from object .find().html intop old div
        })
        .fail(function() {
                alert( "error" );
            });
}

//Lef-right pagination
jQuery(document).ready(function($){
    $('.arrow').css('cursor','pointer');

    $('#pagination-prev').on('click',function (){
        var activeElement = $('.active-pagination');
        var tempPrev = activeElement.prev('.pagination-list-item');
        if(tempPrev.length) {
            tempPrev = tempPrev.children('a');
            activeElement.removeClass('active-pagination');
            tempPrev.parent().addClass('active-pagination');
            tempPrev.click();

        }

    });
    $('#pagination-next').on('click',function (){
        var activeElement = $('.active-pagination');
        var tempNext = activeElement.next('.pagination-list-item');
        if(tempNext.length) {
            tempNext = tempNext.children('a');
            activeElement.removeClass('active-pagination');
            tempNext.parent().addClass('active-pagination');
            tempNext.click();

        }

    });
})
/*------ajax for use search inout -----*/
/*---use delay-----*/
function makeDelay(ms) {
    var timer = 0;
    return function(callback){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
};
var delay = makeDelay(1000);
jQuery(document).ready(function($){

    $('#search-button').css('cursor','pointer');
    $('#search-button').on('click',function () {
        search_string = $('#search-input').val();
        ajax_search(search_string);
        $('#search-input').css('opacity','1');
    })
    // $('#search-input').on('change', (function(){
    $('#search-input').on('search', (function(){
            search_string = $('#search-input').val();
            // delay(ajax_search(search_string)); // use when need timeout any time on event
            ajax_search(search_string);
            $('#search-input').css('opacity','1');
        })
    );
    function ajax_search(search_string){
        $('#search-input').css('opacity','0.5');
    //console.log(search_string);
        if (selectedTab=='') selectedTab = defaultCategory;
        updateSlug('', defaultCategory, url, true, search_string);//true - reload list of pagination
    }

})