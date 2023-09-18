<div class="news-filters" id="news-center-page">
  <form method="get">

    <div class="row align-items-center">
      <div class="col-lg-2"><p class="search_title text-white">Search Palmer Blogs</p></div>
      <div class="col-lg-4"><input type="text" name="post_title" placeholder="Search here" aria-label="Search here"></div>
      <div class="col-lg-4">
        <div class="d-lg-flex align-items-center">
          <p class="search_title text-white">Dates</p>
          <select id="date_selection" name="date-dropdown">
            <option value=""><?php echo esc_attr( __( 'All dates' ) ); ?></option>
            <?php wp_get_archives( array( 'type' => 'monthly', 'format' => 'option', 'show_post_count' => 1 ) ); ?>
          </select>
        </div>
      </div>
      <div class="col-lg-2">
        <input type="hidden" value="1" name="pg_number" class="page_input_value">
        <button type="submit" class="search">Search</button></div>
      </div>
    </form>
  </div>
