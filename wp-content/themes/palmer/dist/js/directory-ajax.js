$ = jQuery;

$("#reset-button-search-page").on("click", function (e) {
  e.preventDefault();
  jQuery("#search-input-directory-page").val("");
  jQuery(".person-campus-content .row").text("");
  jQuery(".person-campus-wrapper .tabs ul>li:first-child").trigger("click");
});

//select directory form
var directory_form_wp = $("#directory-search");
var directory_form_wpForm = directory_form_wp.find("form");

jQuery("#search-input-directory-page").on("focus", function () {
  jQuery("#submit-button-search-page").text("Search");
});

//Get all resets on clear
directory_form_wp.find("button[type='submit']").on("click", function () {
  $(document).find("#persons-list-ajax").text("");
  if (directory_form_wp.find("button").text() == "Clear") {
    $(document).find("#persons-list-ajax").text("");
    jQuery("#search-input-directory-page").val("all");

    directory_form_wpForm.trigger("submit");
    jQuery("#search-input-directory-page").val("");
  }
});

//get Current active tab
function get_active_tab() {
  var selected_tab;
  jQuery(".person-campus-wrapper ul li").each((i, d) => {
    if (jQuery(d).hasClass("is-active")) {
      selected_tab = jQuery(d).attr("data-slug");
      // console.log(selected_tab);
    }
  });
  return selected_tab;
}

function get_active_campus_id() {
  var selected_tab = localStorage.getItem("active-tab");
  return selected_tab;
}

//ajax call to wp backend for people array
function ajax_call_directory(directory_form_wp, page_no, campus_id) {
  // console.log("init... ajax");
  if (directory_form_wpForm.find("#search-input-directory-page")) {
    var search = directory_form_wpForm
      .find("#search-input-directory-page")
      .val();

    var data = {
      action: "directory_ajax_filter",
      search: search,
      paged: page_no,
      term_id: parseInt(campus_id),
    };

    //Ajax call to wp backend for people array
    $.ajax({
      url: ajax_url,
      data: data,
      beforeSend: function (xhr) {
        jQuery("#directory_pagination .pagination-directory").html("");
        jQuery(".person-campus-content .row").text("");
        directory_form_wp.find("button[type='submit']").text("Searching..."); // changing the button label
      },
      success: function (response) {
        directory_form_wp.find("ul").empty();
        if (response != "no_result") {
          // console.log(response);
          for (var i = 0; i < response.length; i++) {
            var image = response[i].image;
            var link_url = response[i].link.link_url;
            var html = `
                <div class="col-md-6 person-wp">
                    <div class="person-info-wrapper-col">
                    ${
                      image
                        ? `<div class="person-img"><img class="img img-fluid" src="${image}" alt="${response[i].title}"/></div>`
                        : "<div class='person-img'></div>"
                    }
                    <div class="user-person-info">
                        <div class="user-name">
                        ${
                          link_url
                            ? `<a class="" href="${response[i].link.link_url}" target="${response[i].link.link_target}">${response[i].title}</a>`
                            : `<span>${response[i].title}</span>`
                        }    
                       </div>
                        <div class="user-caption">${response[i].caption}</div>
                        <div class="user-bio">${response[i].bio}</div>
                        <div class="user-email">
                        ${
                          response[i].email
                            ? '<i class="fas fa-envelope"></i>'
                            : ""
                        }
                         <a href="mailto:${response[i].email}">${
              response[i].email
            }</a>
                        </div>
                        <div class="user-phone">
                        ${
                          response[i].phone
                            ? '<i class="fas fa-phone-alt"></i>'
                            : ""
                        }
                         <a href="tel:${response[i].phone}">${
              response[i].phone
            }</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>`;

            //Add to only active tab
            jQuery(".person-campus-content .row").each((i, d) => {
              try {
                if (jQuery(d).attr("data-campus-id") == get_active_tab()) {
                  jQuery(d).append(html);
                } else {
                  jQuery(d).text("");
                }
              } catch (error) {
                console.log(error);
              }
            });
          }
          const currentPage = parseInt(response[0].current_page);
          const totalPages = parseInt(response[0].total_pages);
          const postPerPage = parseInt(response[0].posts_per_page);
          const totalPosts = parseInt(response[0].total_posts);
          const nextPage = currentPage + 1;
          const prevPage = currentPage - 1;
          const firstPage = 1;

          const first_html = ` <div class="first-page">
          <a href="#" class="first-page-link" data-current-page='${firstPage}'>
          <span class="screen-reader-text">First Page</span>
          « First
          </a>
          </div>`;

          const last_html = ` <div class="last-page">
          <a href="#" class="last-page-link" data-current-page='${totalPages}'>
          <span class="screen-reader-text">Last Last</span>
          Last »
          </a>
          </div>`;

          const prev_html = `<div class="prev-page">
          <a href="#" class="prev-page-link" data-current-page=${prevPage}>
          <span class="screen-reader-text">Previous page</span>
          ‹  Prev
          </a>
          </div>`;

          var next_html = `<div class="next-page">
          <a href="#" class="next-page-link" data-current-page=${nextPage}>
          <span class="screen-reader-text">Next page</span>
         Next › 
          </a>
          </div>`;

          var nav = "";

          if (currentPage > 1) {
            nav += `${first_html}`;
            nav += `${prev_html}`;
          } else if (currentPage > 1 && currentPage < totalPages) {
            nav += `${prev_html}`;
          }

          nav += "<ul class='page-numbers'>";

          for (var i = 1; i <= totalPages; i++) {
            if (i == currentPage) {
              nav += `<li data-current-page=${i} class="active"><a href="#">${i}</a></li>`;
            } else {
              nav += `<li data-current-page=${i} ><a href="#">${i}</a></li>`;
            }
          }
          nav += "</ul>";

          if (currentPage < totalPages) {
            nav += `${next_html}`;
            nav += `${last_html}`;
          } else if (currentPage > 1 && currentPage < totalPages) {
            nav += `${next_html}`;
          }

          if (totalPages > 1) {
            jQuery("#directory_pagination .pagination-directory").append(nav);
          }
        } else {
          var html =
            "<li class='no-result'>No matching person found. Try a different name or search keyword</li>";
          jQuery(".person-campus-content .row").each((i, d) => {
            try {
              if (jQuery(d).attr("data-campus-id") == get_active_tab()) {
                jQuery(d).append(html);
              }
            } catch (error) {
              console.log(error);
            }
          });
        }
      },
      complete: function (xhr) {
        directory_form_wp.find("button[type='submit']").text("Search");
        // changing the button label
      },
    });
  } else {
    console.error("failed to check");
  }
}

localStorage.setItem(
  "active-tab",
  jQuery(".person-campus-wrapper .tabs ul>li").attr("data-id")
);

//on page load all the person
setTimeout(() => {
  ajax_call_directory(directory_form_wp, 1, get_active_campus_id());
}, 100);

//on submit of form get results
directory_form_wpForm.on("submit", function (e) {
  $(document).find("#persons-list-ajax").text("");
  e.preventDefault();
  ajax_call_directory(directory_form_wp, 1, get_active_campus_id());
});

jQuery("section.person-campus-wrapper nav.tabs ul li").on("click", function () {
  //remove active class from all tabs
  jQuery(".person-campus-wrapper nav.tabs ul li").each((i, d) => {
    jQuery(d).removeClass("is-active");
  });
  //add to current tab
  jQuery(this).addClass("is-active");

  jQuery(".person-campus-content").each((i, d) => {
    jQuery(d).removeClass("is-active");
    if (jQuery(d).attr("id") == jQuery(this).attr("data-slug")) {
      jQuery(d).addClass("is-active");
    }
  });

  localStorage.setItem("active-tab", jQuery(this).attr("data-id"));
  ajax_call_directory(directory_form_wp, 1, get_active_campus_id());
});

$(document).ready(function () {
  if (jQuery("#directory_pagination").length > 0) {
    jQuery("#directory_pagination .pagination-directory").on(
      "click",
      "[data-current-page]",
      function () {
        var page = jQuery(this).attr("data-current-page");
        ajax_call_directory(directory_form_wp, page, get_active_campus_id());
      }
    );
  }
});
