/**
 * NeoAdmin Demo Menu
 * ------------------
 */
(function ($, NeoAdmin) {

  "use strict";

  /**
   * List of all the available skins
   *
   * @type Array
   */
  var my_skins = [
    "skin-blue",
    "skin-black",
    "skin-red",
    "skin-yellow",
    "skin-purple",
    "skin-green",
    "skin-blue-light",
    "skin-black-light",
    "skin-red-light",
    "skin-yellow-light",
    "skin-purple-light",
    "skin-green-light"
  ];

  //Create the new tab
  var tab_pane = $("<div />", {
    "id": "control-sidebar-theme-demo-options-tab",
    "class": "tab-pane active"
  });

  //Create the tab button
  var tab_button = $("<li />", {"class": "active"})
      .html("<a href='#control-sidebar-theme-demo-options-tab' data-toggle='tab'>"
      + "<i class='fa fa-wrench'></i>"
      + "</a>");

  //Add the tab button to the right sidebar tabs
  $("[href='#control-sidebar-home-tab']")
      .parent()
      .before(tab_button);

  //Create the menu
  var demo_settings = $("<div />");

  //Layout options
  demo_settings.append(
      "<h4 class='control-sidebar-heading'>"
      + "Layout Options"
      + "</h4>"
        //Fixed layout
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-layout='fixed' class='pull-right'/> "
      + "Fixed layout"
      + "</label>"
      + "</div>"
        //Boxed layout
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-layout='layout-boxed'class='pull-right'/> "
      + "Boxed Layout"
      + "</label>"
      + "</div>"
        //Sidebar Toggle
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-layout='sidebar-collapse' class='pull-right'/> "
      + "Toggle Sidebar"
      + "</label>"
      + "</div>"
  );
  var skins_list = $("<ul />", {"class": 'list-unstyled clearfix'});

  //Dark sidebar skins
  var skin_blue =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-blue' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #1183e1;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 12px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #191818;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Blue</p>");
  skins_list.append(skin_blue);
  var skin_black =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-black' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 12px; background: #000;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #000;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #222;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Black</p>");
  skins_list.append(skin_black);
  var skin_purple =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-purple' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #63028f;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #63028f;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #191818;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Purple</p>");
  skins_list.append(skin_purple);
  var skin_green =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-green' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #1bab41;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #1bab41;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #191818;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Green</p>");
  skins_list.append(skin_green);
  var skin_red =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-red' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #f50000;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #f50000;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #191818;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Red</p>");
  skins_list.append(skin_red);
  var skin_yellow =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-yellow' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #ffb804;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #ffb804;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #191818;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Yellow</p>");
  skins_list.append(skin_yellow);

  //Light sidebar skins
  var skin_blue_light =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-blue-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #0261af;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 12px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #1183e1;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Blue Sidebar</p>");
  skins_list.append(skin_blue_light);
  var skin_black_light =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-black-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 12px; background: #000;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #000;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Light Sidebar</p>");
  skins_list.append(skin_black_light);
  var skin_purple_light =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-purple-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #7805ad;'></span><span' style='display:block; width: 80%; float: left; height: 12px; background: #63028f;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #63028f;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Purple Sidebar</p>");
  skins_list.append(skin_purple_light);
  var skin_green_light =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-green-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #109032;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #1bab41;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #1bab41;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Green Sidebar</p>");
  skins_list.append(skin_green_light);
  var skin_red_light =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-red-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #ba0202;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #f50000;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #f50000;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Red Sidebar</p>");
  skins_list.append(skin_red_light);
  var skin_yellow_light =
      $("<li />", {style: "float:left; width: 49.33333%; padding: 8px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-yellow-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 12px; background: #e0a101;'></span><span style='display:block; width: 80%; float: left; height: 12px; background: #ffb804;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 40px; background: #ffb804;'></span><span style='display:block; width: 80%; float: left; height: 40px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin f-13'>Yellow Sidebar</p>");
  skins_list.append(skin_yellow_light);

  demo_settings.append("<h4 class='control-sidebar-heading'>Skins</h4>");
  demo_settings.append(skins_list);

  tab_pane.append(demo_settings);
  $("#control-sidebar-home-tab").after(tab_pane);

  setup();

  /**
   * Toggles layout classes
   *
   * @param String cls the layout class to toggle
   * @returns void
   */
  function change_layout(cls) {
    $("body").toggleClass(cls);
    NeoAdmin.layout.fixSidebar();
    //Fix the problem with right sidebar and layout boxed
    if (cls == "layout-boxed")
      NeoAdmin.controlSidebar._fix($(".control-sidebar-bg"));
    if ($('body').hasClass('fixed') && cls == 'fixed') {
      NeoAdmin.pushMenu.expandOnHover();
      NeoAdmin.layout.activate();
    }
    NeoAdmin.controlSidebar._fix($(".control-sidebar-bg"));
    NeoAdmin.controlSidebar._fix($(".control-sidebar"));
  }

  /**
   * Replaces the old skin with the new skin
   * @param String cls the new skin class
   * @returns Boolean false to prevent link's default action
   */
  function change_skin(cls) {
    $.each(my_skins, function (i) {
      $("body").removeClass(my_skins[i]);
    });

    $("body").addClass(cls);
    store('skin', cls);
    return false;
  }

  /**
   * Store a new settings in the browser
   *
   * @param String name Name of the setting
   * @param String val Value of the setting
   * @returns void
   */
  function store(name, val) {
    if (typeof (Storage) !== "undefined") {
      localStorage.setItem(name, val);
    } else {
      window.alert('Please use a modern browser to properly view this template!');
    }
  }

  /**
   * Get a prestored setting
   *
   * @param String name Name of of the setting
   * @returns String The value of the setting | null
   */
  function get(name) {
    if (typeof (Storage) !== "undefined") {
      return localStorage.getItem(name);
    } else {
      window.alert('Please use a modern browser to properly view this template!');
    }
  }

  /**
   * Retrieve default settings and apply them to the template
   *
   * @returns void
   */
  function setup() {
    var tmp = get('skin');
    if (tmp && $.inArray(tmp, my_skins))
      change_skin(tmp);

    //Add the change skin listener
    $("[data-skin]").on('click', function (e) {
      e.preventDefault();
      change_skin($(this).data('skin'));
    });

    //Add the layout manager
    $("[data-layout]").on('click', function () {
      change_layout($(this).data('layout'));
    });

    $("[data-controlsidebar]").on('click', function () {
      change_layout($(this).data('controlsidebar'));
      var slide = !NeoAdmin.options.controlSidebarOptions.slide;
      NeoAdmin.options.controlSidebarOptions.slide = slide;
      if (!slide)
        $('.control-sidebar').removeClass('control-sidebar-open');
    });

    $("[data-sidebarskin='toggle']").on('click', function () {
      var sidebar = $(".control-sidebar");
      if (sidebar.hasClass("control-sidebar-dark")) {
        sidebar.removeClass("control-sidebar-dark")
        sidebar.addClass("control-sidebar-light")
      } else {
        sidebar.removeClass("control-sidebar-light")
        sidebar.addClass("control-sidebar-dark")
      }
    });

    $("[data-enable='expandOnHover']").on('click', function () {
      $(this).attr('disabled', true);
      NeoAdmin.pushMenu.expandOnHover();
      if (!$('body').hasClass('sidebar-collapse'))
        $("[data-layout='sidebar-collapse']").click();
    });

    // Reset options
    if ($('body').hasClass('fixed')) {
      $("[data-layout='fixed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('layout-boxed')) {
      $("[data-layout='layout-boxed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('sidebar-collapse')) {
      $("[data-layout='sidebar-collapse']").attr('checked', 'checked');
    }

  }
})(jQuery, $.NeoAdmin);
