/*=========================================================================================
    File Name: app-user.js
    Description: Employee page
    --------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(document).ready(function () {

  var isRtl;
  if ( $('html').attr('data-textdirection') == 'rtl' ) {
    isRtl = true;
  } else {
    isRtl = false;
  }

  //  Rendering badge in status column
  var customBadgeHTML = function (params) {
    var color = "";
    if (params.value == "active") {
      color = "success"
      return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
    } else if (params.value == "blocked") {
      color = "danger";
      return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
    } else if (params.value == "deactivated") {
      color = "warning";
      return "<div class='badge badge-pill badge-light-" + color + "' >" + params.value + "</div>"
    }
  }

  //  Rendering bullet in verified column
  var customBulletHTML = function (params) {
    var color = "";
    if (params.value == true) {
      color = "success"
      return "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
    } else if (params.value == false) {
      color = "secondary";
      return "<div class='bullet bullet-sm bullet-" + color + "' >" + "</div>"
    }
  }

  // Renering Icons in Actions column
  var customIconsHTML = function (params) {
    var usersIcons = document.createElement("span");
    var editIconHTML = "<a href='app-user-edit.html'><i class= 'employees-edit-icon feather icon-edit-1 mr-50'></i></a>"
    var deleteIconHTML = document.createElement('i');
    var attr = document.createAttribute("class")
    attr.value = "employees-delete-icon feather icon-trash-2"
    deleteIconHTML.setAttributeNode(attr);
    // selected row delete functionality
    deleteIconHTML.addEventListener("click", function () {
      deleteArr = [
        params.data
      ];
      // var selectedData = gridOptions.api.getSelectedRows();
      gridOptions.api.updateRowData({
        remove: deleteArr
      });
    });
    usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
    usersIcons.appendChild(deleteIconHTML);
    return usersIcons
  }

  //  Rendering avatar in username column
  var customAvatarHTML = function (params) {
    return "<span class='avatar'><img src='" + params.data.avatar + "' height='32' width='32'></span>" + params.value
  }

  // ag-grid
  /*** COLUMN DEFINE ***/

  var columnDefs = [{
      headerName: 'ID',
      field: 'id',
      width: 125,
      filter: true,
      checkboxSelection: true,
      headerCheckboxSelectionFilteredOnly: true,
      headerCheckboxSelection: true,
    },
    {
      headerName: 'Username',
      field: 'username',
      filter: true,
      width: 175,
      cellRenderer: customAvatarHTML,
    },
    {
      headerName: 'Email',
      field: 'email',
      filter: true,
      width: 225,
    },
    {
      headerName: 'Name',
      field: 'name',
      filter: true,
      width: 200,
    },
    {
      headerName: 'Country',
      field: 'country',
      filter: true,
      width: 150,
    },
    {
      headerName: 'Role',
      field: 'role',
      filter: true,
      width: 150,
    },
    {
      headerName: 'Status',
      field: 'status',
      filter: true,
      width: 150,
      cellRenderer: customBadgeHTML,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Verified',
      field: 'is_verified',
      filter: true,
      width: 125,
      cellRenderer: customBulletHTML,
      cellStyle: {
        "text-align": "center"
      }
    },
    {
      headerName: 'Department',
      field: 'department',
      filter: true,
      width: 150,
    },
    {
      headerName: 'Actions',
      field: 'transactions',
      width: 150,
      cellRenderer: customIconsHTML,
    }
  ];

  /*** GRID OPTIONS ***/
  var gridOptions = {
    defaultColDef: {
      sortable: true
    },
    enableRtl: isRtl,
    columnDefs: columnDefs,
    rowSelection: "multiple",
    floatingFilter: true,
    filter: true,
    pagination: true,
    paginationPageSize: 20,
    pivotPanelShow: "always",
    colResizeDefault: "shift",
    animateRows: true,
    resizable: true
  };
  if (document.getElementById("myGrid")) {
    /*** DEFINED TABLE VARIABLE ***/
    var gridTable = document.getElementById("myGrid");

    /*** GET TABLE DATA FROM URL ***/
    agGrid
      .simpleHttpRequest({
        url: "../../../app-assets/data/users-list.json"
      })
      .then(function (data) {
        gridOptions.api.setRowData(data);
      });

    /*** FILTER TABLE ***/
    function updateSearchQuery(val) {
      gridOptions.api.setQuickFilter(val);
    }

    $(".ag-grid-filter").on("keyup", function () {
      updateSearchQuery($(this).val());
    });

    /*** CHANGE DATA PER PAGE ***/
    function changePageSize(value) {
      gridOptions.api.paginationSetPageSize(Number(value));
    }

    $(".sort-dropdown .dropdown-item").on("click", function () {
      var $this = $(this);
      changePageSize($this.text());
      $(".filter-btn").text("1 - " + $this.text() + " of 50");
    });

    /*** EXPORT AS CSV BTN ***/
    $(".ag-grid-export-btn").on("click", function (params) {
      gridOptions.api.exportDataAsCsv();
    });

    //  filter data function
    var filterData = function agSetColumnFilter(column, val) {
      var filter = gridOptions.api.getFilterInstance(column)
      var modelObj = null
      if (val !== "all") {
        modelObj = {
          type: "equals",
          filter: val
        }
      }
      filter.setModel(modelObj)
      gridOptions.api.onFilterChanged()
    }
    //  filter inside role
    $("#employees-list-role").on("change", function () {
      var usersListRole = $("#employees-list-role").val();
      filterData("role", usersListRole)
    });
    //  filter inside verified
    $("#employees-list-verified").on("change", function () {
      var usersListVerified = $("#employees-list-verified").val();
      filterData("is_verified", usersListVerified)
    });
    //  filter inside status
    $("#employees-list-status").on("change", function () {
      var usersListStatus = $("#employees-list-status").val();
      filterData("status", usersListStatus)
    });
    //  filter inside department
    $("#employees-list-department").on("change", function () {
      var usersListDepartment = $("#employees-list-department").val();
      filterData("department", usersListDepartment)
    });
    // filter reset
    $(".employees-data-filter").click(function () {
      $('#employees-list-role').prop('selectedIndex', 0);
      $('#employees-list-role').change();
      $('#employees-list-status').prop('selectedIndex', 0);
      $('#employees-list-status').change();
      $('#employees-list-verified').prop('selectedIndex', 0);
      $('#employees-list-verified').change();
      $('#employees-list-department').prop('selectedIndex', 0);
      $('#employees-list-department').change();
    });

    /*** INIT TABLE ***/
    new agGrid.Grid(gridTable, gridOptions);
  }
  // employees language select
  if ($("#employees-language-select2").length > 0) {
    $("#employees-language-select2").select2({
      dropdownAutoWidth: true,
      width: '100%'
    });
  }
  // employees music select
  if ($("#employees-music-select2").length > 0) {
    $("#employees-music-select2").select2({
      dropdownAutoWidth: true,
      width: '100%'
    });
  }
  // employees movies select
  if ($("#employees-movies-select2").length > 0) {
    $("#employees-movies-select2").select2({
      dropdownAutoWidth: true,
      width: '100%'
    });
  }
  // employees birthdate date
  if ($(".birthdate-picker").length > 0) {
    $('.birthdate-picker').pickadate({
      format: 'mmmm, d, yyyy'
    });
  }
  // Input, Select, Textarea validations except submit button validation initialization
  if ($(".employees-edit").length > 0) {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
  }
});
