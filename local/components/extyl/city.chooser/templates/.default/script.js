// if ( !!! window.top.Extyl) window.top.Extyl = {};
//
// window.top.Extyl.CityChooser = {
//     init: function() {
//
//         var self = Extyl.CityChooser;
//
//         $('form.form__choose-city')
//             .off('submit', self.query)
//             .on('submit', self.query)
//         ;
//     },
//
//     query: function(e) {
//
//         e.preventDefault();
//
//         $.ajax({
//             url: '/api/v1/citySelect.php',
//             data: {
//                 'user-city': $('[name="user-city"]:checked').val(),
//             },
//             complete: function() {
//                 location.reload();
//             }
//         });
//
//         return false;
//     },
// };
