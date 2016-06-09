var handleDataTableDefault = function() {
    "use strict";
    
    if ($('#data-table').length !== 0) {
        $('#data-table').DataTable({
            responsive: true
        });
    }
};

var TableManageDefault = function () {
    "use strict";
    return {
        //main function
        init: function () {
            handleDataTableDefault();
        }
    };
}();