$(function () {
   // if($('.filter').length)  {
   //     var filter = {};
   //     filter.box = $('.partners .filter');
   //     filter.inner = filter.box.find('.filter__inner');
   //     filter.opener = filter.box.find('.filter__item').last();
   //     filter.items = filter.opener.siblings('.filter__item');
   //     filter.rowWidth = filter.inner.innerWidth();
   //
   //     filter.showFilter = function () {
   //         filter.inner.css({
   //             height: 'auto',
   //             overflow: 'auto',
   //         });
   //     };
   //
   //     filter.hideFilter = function () {
   //         filter.inner.css({
   //             height: '',
   //             overflow: '',
   //         });
   //     };
   //
   //     filter.createRow = function (items) {
   //         var appendItems = '';
   //
   //         items.forEach(function (item) {
   //             appendItems += item[0].outerHTML;
   //         });
   //
   //         return '<div class="filter__row">' + appendItems + '</div>';
   //     };
   //
   //     filter.createRows = function () {
   //         var rowCount = 1;
   //         var curWidth = 0;
   //         var rowElements = [];
   //
   //         filter.items.each(function (index, item) {
   //             curWidth += $(item).innerWidth();
   //             if(curWidth < filter.rowWidth - filter.opener.innerWidth()) {
   //                 rowElements.push($(item));
   //
   //                 if(filter.items.length - 1 == index) {
   //                     var newRow = filter.createRow(rowElements);
   //
   //                     rowElements.forEach(function (item) {
   //                         item.remove();
   //                     });
   //
   //                     rowElements = [];
   //                     curWidth = 0;
   //
   //                     filter.inner.prepend(newRow);
   //                 };
   //             } else {
   //                 var newRow = filter.createRow(rowElements);
   //
   //                 rowElements.forEach(function (item) {
   //                     item.remove();
   //                 });
   //
   //                 rowElements = [];
   //                 curWidth = 0;
   //
   //                 rowElements.push($(item));
   //
   //                 filter.inner.prepend(newRow);
   //             }
   //         })
   //
   //         filter.showFilter();
   //     };
   //
   //     filter.init = function() {
   //         if($(window).innerWidth() >= 767) {
   //             filter.createRows();
   //         } else {
   //
   //         }
   //     };
   //
   //     filter.init();
   // }
});