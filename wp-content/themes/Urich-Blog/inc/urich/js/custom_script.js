// jQuery( document ).ready(function($) {
//     var buffer = 10;
//
//     $('.pagination-list-item-link').click(function(event) {
//         event.preventDefault();
//         $(".active-pagination").removeClass("active-pagination");
//         $(this).parent().addClass("active-pagination");
//
//         var currentMetaFilter = $('.active-pagination .pagination-list-item-link').attr('data-filter');
//         filterList(currentMetaFilter);
//
//         //News filter function
//         function filterList(value) {
//             var list = $(".rewards-list .rewards-list-item");
//             $(list).hide();
//             if (value == "All") {
//                 $(".rewards-list").find("div").each(function (i) {
//                     $(this).delay(200).slideDown("fast");
//                 });
//             } else {
//                 $(".rewards-list").find("div[data-attribute*=" + value + "]").each(function (i) {
//                     $(this).delay(200).slideDown("fast");
//                 });
//             }
//         }
//
//         return false;
//     })
// });
// //Left-right NAV pagination event
// jQuery(document).ready(function($){
//     $('.pagination .arrow,.pagination .arrow.arrow-prev').css('cursor','pointer');
//
//
//     $('.pagination .next').on('click',function (){
//         var activeElement = $('.active-pagination');
//         var tempNext = activeElement.next();
//         activeElement.removeClass('.active-pagination');
//         tempNext = tempNext.find('.pagination-list-item-link');
//
//         tempNext.parent().addClass('.active-pagination');
//         tempNext.parent().find('.pagination-list-item-link').click();
//         console.log(tempNext);
//     });
//
//     $(' .pagination .prev').on('click',function (){
//
//         var activeElement = $('.active-pagination');
//
//
//         tempPrev = activeElement.prev().find('.pagination-list-item-link');
//         activeElement.removeClass('.active-pagination');
//
//         tempPrev.parent().addClass('.active-pagination');
//         tempPrev.parent().find('.pagination-list-item-link').click();
//         console.log(tempNext);
//     });
// })