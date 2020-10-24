var DataTables = (function () {
  var handleTables = function () {
    $('#default-datatable').DataTable()

    $('#responsive-datatable').DataTable({
      responsive: true
    })

    $('#dashboard-new-customers-datatable').DataTable({
      responsive:true
    })
    $('#dashboard-new-orders-datatable').DataTable({
      responsive:true
    })
  }

  return {
    // main function to initiate the module
    init: function () {
      handleTables()
    }
  }
})()

jQuery(document).ready(function () {
  DataTables.init()
})
