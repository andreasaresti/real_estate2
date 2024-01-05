<?php

use App\Helpers\Helper;

if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
} else {
  $user_id = "";
}


$searched = '';
if (isset($_GET["s"]) && !isset($_GET['_r'])) {
  $searched = $_GET["s"];
}

$minPrice = '';
$maxPrice = '';
$minsquarefeet = '';
$maxsquarefeet = '';
$minlotsize = '';
$maxlotsize = '';
$search_string = '';
$features_array = isset($_GET['features']) ? explode(',', $_GET['features']) : array();
$features_string = implode(',', $features_array);
$number_of_bedrooms = isset($_GET['bedrooms']) ? $_GET['bedrooms'] : '';
$number_of_bathrooms = isset($_GET['bathrooms']) ? $_GET['bathrooms'] : '';
$exactMatchBath = isset($_GET['exactMatchBath']) ? $_GET['exactMatchBath'] : '0';
$exactMatchBed = isset($_GET['exactMatchBed']) ? $_GET['exactMatchBed'] : '0';
$selected_locations_response = Helper::get_selected_locations($_GET);
$selected_locations_response = json_decode($selected_locations_response);
$active_features_response = Helper::get_active_features();
$active_features_response = json_decode($active_features_response);
$active_features = $active_features_response->data;
$active_listing_types_response = Helper::get_active_listing_types();
$active_listing_types_response = json_decode($active_listing_types_response);
$active_property_types_response = Helper::get_active_property_types();
$active_property_types_response = json_decode($active_property_types_response);
$active_marker_search = Helper::get_hashed_searched($searched);
$view = 'listings';

if (isset($_GET['view']) && $_GET['view'] == 'map') {
  $view = 'map';
}
$price_range_array = isset($_GET['price_range']) ? explode(',', $_GET['price_range']) : array();

if (isset($price_range_array[0]) && is_numeric($price_range_array[0])) {
  $minPrice = $price_range_array[0];
}
if (isset($price_range_array[1]) && is_numeric($price_range_array[1])) {
  $maxPrice = $price_range_array[1];
}
$area_size_array = isset($_GET['area_size']) ? explode(',', $_GET['area_size']) : array();
if (isset($area_size_array[0]) && is_numeric($area_size_array[0])) {
  $minsquarefeet = $area_size_array[0];
}
if (isset($area_size_array[1]) && is_numeric($area_size_array[1])) {
  $maxsquarefeet = $area_size_array[1];
}
$lot_size_array = isset($_GET['lot_size']) ? explode(',', $_GET['lot_size']) : array();
if (isset($lot_size_array[0]) && is_numeric($lot_size_array[0])) {
  $minlotsize = $lot_size_array[0];
}
if (isset($lot_size_array[1]) && is_numeric($lot_size_array[1])) {
  $maxlotsize = $lot_size_array[1];
}
?>


<link rel="stylesheet" href="/theme/zillow/assets/css/custom.css?<?php echo time(); ?>">
<link rel="stylesheet" href="/theme/zillow/assets/css/jquery-ui.css?<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
  var marker_search = ''
</script>
<?php


// echo 'selDistricts: '.$selDistricts.'<br>';







if ($active_marker_search) {
?>
  <script>
    console.log("test")
    localStorage.setItem("freedraw-polys", '<?= ($active_marker_search->info) ?>');
    marker_search = "<?= $searched ?>";
  </script>
<?php
} elseif ($searched != '' || isset($_GET['_r'])) {
?>
  <script>
    localStorage.clear("freedraw-polys");
  </script>
<?php
}
?>




<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- Bootstrap-Select CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"> -->
  <link rel="stylesheet" type="text/css" href="/theme/zillow/assets/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="/theme/zillow/assets/css/select2.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" /> -->
</head>

<input type="text" class="form-control" id="minPrice" style="display:none" value="<?php echo $minPrice; ?>">
<input type="text" class="form-control" id="maxPrice" style="display:none" value="<?php echo $maxPrice; ?>">
<input type="text" class="form-control" id="minsquarefeet" style="display:none" value="<?php echo $minsquarefeet; ?>">
<input type="text" class="form-control" id="maxsquarefeet" style="display:none" value="<?php echo $maxsquarefeet; ?>">
<input type="text" class="form-control" id="minlotsize" style="display:none" value="<?php echo $minlotsize; ?>">
<input type="text" class="form-control" id="maxlotsize" style="display:none" value="<?php echo $maxlotsize; ?>">
<input type="text" class="form-control" id="features" style="display:none" value="<?php echo $features_string; ?>">

<div class="inner-pages homepage-4 agents hp-6 full hd-white">
  <div class="navbar-desktop" data-zrr-key="static-search-page:search-app">
    <div class=" max-height-row" style="margin-left:0.2%; display: flex; align-items: center;">
      <div class="col-2" style="padding-left: 5px; padding-right:5px;">
        <select class="form-control select2" id="search-box-input" onchange="searchNowListingMap()" multiple="multiple">
          <?php
          foreach ($selected_locations_response as $selected_location) {
            echo '<option value="' . $selected_location->id . '" selected="selected">' . $selected_location->name . ' (' . $selected_location->type . ')</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-1" style="padding-left: 5px; padding-right:5px;">
        <select class="selectpicker propertStatus" multiple data-live-search="true" data-size="5" multiple data-selected-text-format="count" multiple title="Property Status" onchange="searchNowListingMap()">
          <?php
          foreach ($active_property_types_response->data as $property_type) {
            echo '<option value="' . $property_type->id . '" class="propertStatus" id="propertStatus' . $property_type->id . '" >' . $property_type->displayname . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-1">
        <select class="selectpicker propertType" multiple data-live-search="true" multiple data-selected-text-format="count" multiple title="Property Type" onchange="searchNowListingMap()">
          <?php
          foreach ($active_listing_types_response->data as $listing_type) {
            echo '<option value="' . $listing_type->id . '">' . $listing_type->displayname . '</option>';
          }
          ?>
        </select>
      </div>

      <div class="col-2">
        <button data-toggle="popover" class="form-control button" id="bedsAndBathButton" data-placement="bottom" data-html="true" title="Number of Bedrooms and Bathrooms">Beds & Bathrooms</button>
        <div id="popover-content-bedsAndBathButton" style="display:none;">
          <div class="">
            <fieldset class="filter_beds">
              <legend>Bedrooms</legend>
              <div aria-label="Beds Select" class="" role="group">
                <?php
                $aria_pressed = 'false';
                if ($number_of_bathrooms == '') {
                  $aria_pressed = 'true';
                }
                echo '<button aria-disabled="false" aria-pressed="' . $aria_pressed . '" value="" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp bedValue">Any</button>';
                $bedrooms_array = [1, 2, 3, 4, 5];
                foreach ($bedrooms_array as $bedroom) {
                  $aria_pressed = 'false';
                  if ($number_of_bedrooms == $bedroom) {
                    $aria_pressed = 'true';
                  }
                  $suffix = '+';
                  if ($exactMatchBed == 1) {
                    $suffix = '';
                  }
                  echo '<button aria-disabled="false" aria-pressed="' . $aria_pressed . '" value="' . $bedroom . '" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp bedValue">' . $bedroom . $suffix . '</button>';
                }
                ?>
              </div>
              <div style="display: flex; align-items: center;">
                <?php
                $checked = "";
                if ($exactMatchBed == 1) {
                  $checked = "checked";
                }
                echo '<label><input id="exposed-filters-exact-beds-check" value="1" class="" type="checkbox" ' . $checked . ' style="margin-right: 5px;">Use exact match&nbsp;</label>';
                ?>
              </div>

            </fieldset>
          </div>

          <div class="">
            <fieldset class="filter_baths">
              <legend>Bathrooms</legend>
              <div name="baths-options" aria-label="Baths Select" class="" role="group">
                <?php
                $aria_pressed = 'false';
                if ($number_of_bathrooms == '') {
                  $aria_pressed = 'true';
                }
                echo '<button aria-disabled="false" aria-pressed="' . $aria_pressed . '" value="" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp bathroomValue">Any</button>';
                $bathrooms_array = [1, 2, 3, 4];
                foreach ($bathrooms_array as $bathroom) {
                  $aria_pressed = 'false';
                  if ($number_of_bathrooms == $bathroom) {
                    $aria_pressed = 'true';
                  }
                  $suffix = '+';
                  if ($exactMatchBath == 1) {
                    $suffix = '';
                  }
                  echo '<button aria-disabled="false" aria-pressed="' . $aria_pressed . '" value="' . $bathroom . '" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 cRyIQp bathroomValue">' . $bathroom . $suffix . '</button>';
                }
                ?>
              </div>
              <div style="display: flex; align-items: center;">
                <?php
                $checked = "";
                if ($exactMatchBath == 1) {
                  $checked = "checked";
                }
                echo '<label><input id="exposed-filters-exact-baths-check" class="" type="checkbox" ' . $checked . ' style="margin-right: 5px;">Use exact match</label>';
                ?>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
      <div class="col-2">
        <button href="#" data-toggle="popover" class="form-control button" id="priceButton" data-placement="bottom" title="Price Range">Price</button>
        <div id="popover-content-priceButton" style="display:none;">
          <form id="priceForm" autocomplete="off" style="width:300px;">
            <div class="row">
              <div class="col-5">
                <label for="minPrice">Min Price</label>
              </div>
              <div class="col-2">
                <p></p>
              </div>
              <div class="col-5">
                <label for="maxPrice">Max Price</label>
              </div>
            </div>
            <div class="row">
              <div class="col-5">
                <select id="min_price" onchange="$('#minPrice').val(this.value);searchNowListingMap()">
                  <option value="">Any</option>
                  <?php
                  $min_range = [200, 400, 600, 800, 1000, 3000, 5000, 10000, 20000, 50000, 100000, 150000];
                  foreach ($min_range as $minimum_value) {
                    $is_selected = '';
                    if ($minPrice == $minimum_value) {
                      $is_selected = 'selected';
                    }
                    echo '<option value="' . $minimum_value . '" ' . $is_selected . '>€' . number_format($minimum_value) . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-2 text-center pl-0 pr-0">
                <p>-</p>
              </div>
              <div class="col-5">
                <select id="max_price" onchange="$('#maxPrice').val(this.value);searchNowListingMap()">
                  <option value="">Any</option>
                  <?php
                  $max_range = [200, 400, 600, 800, 1000, 3000, 5000, 10000, 20000, 50000, 100000, 150000, 250000, 500000, 100000, 15000000, 2000000, 3000000, 5000000, 8000000, 10000000, 15000000, 20000000];
                  foreach ($max_range as $maximum_value) {
                    $is_selected = '';
                    if ($maxPrice == $maximum_value) {
                      $is_selected = 'selected';
                    }
                    echo '<option value="' . $maximum_value . '" ' . $is_selected . '>€' . number_format($maximum_value) . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-1">
        <!-- <div class=" dropdown-filter" style="border: 1px solid;border-radius: 5px;border-color: black;width: 100px;height: 45px;margin-right: 25px;display: flex;justify-content: center;align-items: center;">
          <a>More</a>
        </div> -->
        <button data-toggle="popover" class="form-control button" id="moreButton" data-placement="bottom" data-html="true" title="More">More</button>
        <div id="popover-content-moreButton" style="display:none;">
          <div class="morePop">
            <div class="row">
              <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="location_mobilediv" style="width: 132px"></div>
              <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="property_status_mobilediv" style="width: 175x"></div>
              <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="property_type_mobilediv" style="width: 132px"></div>
            </div>
            <div class="row">
              <form id="squareFeetForm" class="col-12" style="padding-right: 25px;" autocomplete="off">
                <div class="row">
                  <div class="col-12">
                    <h3 for="minSquareFeet" class="moreH3 ">Square Feet</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-5">
                    <select id="minSquareFeet" name="minSquareFeet" onchange="$('#minsquarefeet').val(this.value);searchNowListingMap()">
                      <option value="">Any</option>
                      <?php

                      $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                      foreach ($max_range as $maximum_value) {
                        $is_selected = '';
                        if ($minsquarefeet == $maximum_value) {
                          $is_selected = 'selected';
                        }
                        echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                      }
                      ?>

                    </select>
                  </div>
                  <div class="col-xx text-center pl-0 pr-0">
                    <p>-</p>
                  </div>
                  <div class="col-5">
                    <select id="maxSquareFeet" name="maxSquareFeet" onchange="$('#maxsquarefeet').val(this.value);searchNowListingMap()">
                      <option value="">Any</option>
                      <?php
                      $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                      foreach ($max_range as $maximum_value) {
                        $is_selected = '';
                        if ($maxsquarefeet == $maximum_value) {
                          $is_selected = 'selected';
                        }
                        echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                      }
                      ?>

                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="row">
              <form id="lotSizeForm" class="col-12 moreRows" autocomplete="off">
                <div class="row">
                  <div class="col-12">
                    <h3 for="minLotSize" class="moreH3">Lot Size</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-5">
                    <select id="minLotSize" name="minLotSize" onchange="$('#minlotsize').val(this.value);searchNowListingMap()">
                      <option value="">Any</option>
                      <?php
                      $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                      foreach ($max_range as $maximum_value) {
                        $is_selected = '';
                        if ($minlotsize == $maximum_value) {
                          $is_selected = 'selected';
                        }
                        echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-xx text-center pl-0 pr-0">
                    <p>-</p>
                  </div>
                  <div class="col-5">
                    <select id="maxLotSize" name="maxLotSize" onchange="$('#maxlotsize').val(this.value);searchNowListingMap()">
                      <option value="">Any</option>
                      <?php
                      $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                      foreach ($max_range as $maximum_value) {
                        $is_selected = '';
                        if ($maxlotsize == $maximum_value) {
                          $is_selected = 'selected';
                        }
                        echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </form>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 moreRows" style="  padding-left: 0px !important;">
              <h3 class="moreH3">Other Features!</h6>
                <!-- Checkboxes -->
                <div class="checkboxes margin-bottom-10">
                  <?php
                  $halfPoint = ceil(count($active_features) / 2);
                  foreach ($active_features as $key => $feature) {
                    if ($key % $halfPoint == 0) {
                      if ($key != 0) {
                        echo '</div>';
                      }
                      echo '<div class="row">';
                    }

                    echo '<div class="col-md-6 feature-item">';
                    $is_checked = '';
                    if (in_array($feature->id, $features_array)) {
                      $is_checked = 'checked';
                    }
                    echo '<input id="fcheck-' . $feature->id . '" type="checkbox" ' . $is_checked . ' class="featurecheck" onclick="searchNowListingMap()"  value="' . $feature->id . '" name="features[]">';
                    echo '<label for="fcheck-' . $feature->id . '">' . $feature->displayname . '</label>';
                    echo '</div>';

                    if ($key % $halfPoint == $halfPoint - 1) {
                      echo '</div>';
                    }
                  }
                  if (count($active_features) % $halfPoint != 0) {
                    echo '</div>';
                  }
                  ?>
                </div>
            </div>
          </div>
        </div>
        <!-- <div class="col-1">
          <div class="search-page-action-bar">
            <div class="action-bar-left-content">
              <button onclick="searchNowListingMap()" class="form-control save-search-button" tabindex="0" role="button" type="button" rel="nofollow" aria-label="Save search" aria-expanded="false" aria-haspopup="dialog">
                Search Now
              </button>
            </div>
          </div>
        </div> -->
        <div class="col-1">
          <div class="action-bar-left-content">
            <button onclick="searchReset()" class="form-control save-search-button button" tabindex="0" role="button" type="button" rel="nofollow" aria-label="Save search" aria-expanded="false" aria-haspopup="dialog">
              Reset Search
            </button>
          </div>
          <div class="action-bar-right-content">

            <a class="saved-homes-link saved-homes-visual-audit" tabindex="0" rel="nofollow" aria-label="Saved Homes" href="/myzillow/favorites"><strong></strong></a>
            <!-- //2 Saved Homes -->
          </div>
        </div>
      </div>

    </div>
    <div class="navbar-mobile">
      <div class="row" style="width: 100%;">
        <div class="col-6">
          <select name="" id="search-box-input" class="form-control select2" onchange="searchNowListingMap()" multiple="multiple">
            <?php
            foreach ($selected_locations_response as $selected_location) {
              echo '<option value="' . $selected_location->id . '" selected="selected">' . $selected_location->name . ' (' . $selected_location->type . ')</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-6">
          <button data-toggle="popover" class="form-control button" id="moreButton" data-placement="bottom" data-html="true" title="More">More</button>
          <div id="popover-content-moreButton" style="display:none;">
            <div class="morePop">
              <div class="row">
                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="location_mobilediv" style="width: 132px"></div>
                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="property_status_mobilediv" style="width: 175x"></div>
                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 " id="property_type_mobilediv" style="width: 132px"></div>
              </div>
              <div class="row">
                <form id="squareFeetForm" class="col-12" style="padding-right: 25px;" autocomplete="off">
                  <div class="row">
                    <div class="col-12">
                      <h3 for="minSquareFeet" class="moreH3 ">Square Feet</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5">
                      <select id="minSquareFeet" name="minSquareFeet" onchange="$('#minsquarefeet').val(this.value);searchNowListingMap()">
                        <option value="">Any</option>
                        <?php

                        $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                        foreach ($max_range as $maximum_value) {
                          $is_selected = '';
                          if ($minsquarefeet == $maximum_value) {
                            $is_selected = 'selected';
                          }
                          echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                        }
                        ?>

                      </select>
                    </div>
                    <div class="col-xx text-center pl-0 pr-0">
                      <p>-</p>
                    </div>
                    <div class="col-5">
                      <select id="maxSquareFeet" name="maxSquareFeet" onchange="$('#maxsquarefeet').val(this.value);searchNowListingMap()">
                        <option value="">Any</option>
                        <?php
                        $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                        foreach ($max_range as $maximum_value) {
                          $is_selected = '';
                          if ($maxsquarefeet == $maximum_value) {
                            $is_selected = 'selected';
                          }
                          echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                        }
                        ?>

                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <div class="row">
                <form id="lotSizeForm" class="col-12 moreRows" autocomplete="off">
                  <div class="row">
                    <div class="col-12">
                      <h3 for="minLotSize" class="moreH3">Lot Size</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5">
                      <select id="minLotSize" name="minLotSize" onchange="$('#minlotsize').val(this.value);searchNowListingMap()">
                        <option value="">Any</option>
                        <?php
                        $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                        foreach ($max_range as $maximum_value) {
                          $is_selected = '';
                          if ($minlotsize == $maximum_value) {
                            $is_selected = 'selected';
                          }
                          echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-xx text-center pl-0 pr-0">
                      <p>-</p>
                    </div>
                    <div class="col-5">
                      <select id="maxLotSize" name="maxLotSize" onchange="$('#maxlotsize').val(this.value);searchNowListingMap()">
                        <option value="">Any</option>
                        <?php
                        $max_range = [500, 750, 1000, 1250, 1750, 2000, 2250, 2500, 2750, 3000, 3500, 4000, 5000, 6000, 7000];
                        foreach ($max_range as $maximum_value) {
                          $is_selected = '';
                          if ($maxlotsize == $maximum_value) {
                            $is_selected = 'selected';
                          }
                          echo '<option value="' . $maximum_value . '" ' . $is_selected . '>' . number_format($maximum_value) . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 moreRows" style="  padding-left: 0px !important;">
                <h3 class="moreH3">Other Features!</h6>
                  <!-- Checkboxes -->
                  <div class="checkboxes margin-bottom-10">
                    <?php
                    $halfPoint = ceil(count($active_features) / 2);
                    foreach ($active_features as $key => $feature) {
                      if ($key % $halfPoint == 0) {
                        if ($key != 0) {
                          echo '</div>';
                        }
                        echo '<div class="row">';
                      }

                      echo '<div class="col-md-6 feature-item">';
                      $is_checked = '';
                      if (in_array($feature->id, $features_array)) {
                        $is_checked = 'checked';
                      }
                      echo '<input id="fcheck-' . $feature->id . '" type="checkbox" ' . $is_checked . ' class="featurecheck" onclick="searchNowListingMap()"  value="' . $feature->id . '" name="features[]">';
                      echo '<label for="fcheck-' . $feature->id . '">' . $feature->displayname . '</label>';
                      echo '</div>';

                      if ($key % $halfPoint == $halfPoint - 1) {
                        echo '</div>';
                      }
                    }
                    if (count($active_features) % $halfPoint != 0) {
                      echo '</div>';
                    }
                    ?>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<section class="properties-right featured portfolio blog google-map-right mp-1" style="padding: 0px!important;">
  <div class="container-fluid">
    <div class="row" style="width: 100%;background-color: white;">
      <aside id="MapListingMap" class="col-lg-6 col-md-6 google-maps-left mt-0 MobileHiddenMap" style="height: 100%;display: block;">
        <div class="alert-box success" id="map_success" style="position: absolute;z-index: 9;width: 100%;margin-top: 80px;">Click on the map to select center and radius</div>
        <div class="row" style="padding: 25px 0px 0px 0px;position: absolute;z-index: 9;width: 50%;left: 50%;">
          <div class="col-xl-12 xsRow" style="display: flex;justify-content: flex-end;margin-right: 10px;">
            <a style="display: none;justify-content: center;align-items: center;margin-right:20px;" class="btn btn-map" id="redrawCircleListingMap" onclick="redrawCircleListingMap();">Re-draw</a>
            <!-- <a style="margin-top: 0px; display: flex;justify-content: center;align-items: center;" class="btn btn-map" id="showCircleListingMap" onclick="showCircleListingMap();">Draw</a> -->
            <button style="display: flex;justify-content: center;align-items: center;margin: 0px 5px 0px 5px;" type="button" class="btn btn-map" data-toggle="button" aria-pressed="false" id="freeDrawingMap" onclick="freeDrawingMap();">
              Free-Draw
            </button>
            <a style="margin-top: 0px; display: flex;justify-content: center;align-items: center;" class="btn btn-map" id="clearDrawingsMap" onclick="clearDrawingsMap();">Clear</a>
          </div>
        </div>
        <div id="map-leaflet"></div>
      </aside>
      <div id="ListingListingMapDiv" class="col-lg-6 col-md-12 google-maps-right ListingListingMapDiv">
        <section>
          <div class="pro-wrapper">
            <div class="detail-wrapper-body">
              <div class="listing-title-bar">
                <div class="text-heading text-left">
                  <p class="font-weight-bold mb-0 mt-3" id="page_count"></p>
                </div>
              </div>
            </div>
            <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center">
              <div class="input-group border rounded input-group-lg w-auto mr-4">
                <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" id="paginSize" onchange="searchNowListingMap()" name="paginSize">
                  <option selected value="20">20</option>
                  <option value="40">40</option>
                  <option value="60">60</option>
                  <option value="80">80</option>
                </select>
              </div>
              <div class="input-group border rounded input-group-lg w-auto mr-4">
                <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sortby:</label>
                <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" onchange="searchNowListingMap()" data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="sortby" name="sortby">
                  <option value="1">Latest</option>
                  <option value="2">Price(high to low)</option>
                  <option value="3">Price(low to high)</option>
                  <option value="4">Newest</option>
                  <option value="5">Bedrooms</option>
                  <option value="6">Bathrooms</option>
                  <option value="7">Square Feet</option>
                  <option value="8">Lot Size</option>
                  <option value="9">Default</option>
                </select>
              </div>

            </div>
          </div>
        </section>
        <div class="ListMobile row" id="ListingListContent">

        </div>
        <nav aria-label="..." style="padding: 20px;display: flex;justify-content: center;">
          <ul class="pagination mt-0" id="pagin_content">
          </ul>
        </nav>
      </div>
      <div class="ViewListMap">
        <a onclick="replaceview();" style="padding: 10px 20px 10px 20px;background: #398a39;border-radius: 5px;cursor: pointer;color:white;" id="showMapListingListingMap">Show Map</a>
      </div>
    </div>
    <input type="hidden" id="page_index" value="1">
  </div>
</section>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap-Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
  var exactMatchBed = '<?php echo $exactMatchBed; ?>';
  var exactMatchBath = '<?php echo $exactMatchBath; ?>';
  var minPrice = '<?php echo $minPrice; ?>';
  var maxPrice = '<?php echo $maxPrice; ?>';


  $('#search-box-input').select2({
    maximumSelectionLength: 10,
    size: '10',
    tokenSeparators: [',', ' '],
    placeholder: "District, Municipality, Location",
    minimumInputLength: 1,
    ajax: {
      url: "/api/getLocationSearch",
      type: 'POST',
      dataType: 'json',
      delay: 250,
      data: function(params) {
        var dataToSend = {
          data: params.term
        };
        console.log(dataToSend);
        return JSON.stringify(dataToSend);
      },

      processResults: function(data) {
        return {
          results: data.map(item => {
            return {
              id: item.id,
              text: item.name + ' (' + item.type + ')',
              type: item.type
            };
          })
        };
      },
      cache: true,
      contentType: "application/json",
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('AJAX error: ' + textStatus + ', ' + errorThrown);
      }
    }
  });
  $(document).ready(function() {
    var selectedBedValue = 'Any';
    var selectedBathroomValue = 'Any';
    // Function to close all popovers except the one passed as an argument
    function closeAllPopoversExcept(currentPopover) {
      $("[data-toggle=popover]").each(function() {
        if (this !== currentPopover) {
          $(this).popover('hide');
        }
      });
    }

    // Initialize popovers
    $("[data-toggle=popover]").each(function() {
      $(this).popover({
        html: true,
        sanitize: false,
        content: function() {
          var id = $(this).attr('id');

          return $('#popover-content-' + id).html();
        }
      }).on('show.bs.popover', function() {
        // $('#minPriceI').val($('#minPrice').val());
        // console.log( $('#minPriceI').val());
        // $('#max_price').val($('#maxPrice').val());
      });

    });

    // $('#priceButton').on('show.bs.popover', function() {
    //   $('#minPriceI').val($('#minPrice').val());
    //     console.log( $('#minPriceI').val());
    //     $('#max_price').val($('#maxPrice').val());
    // });

    // Handle popover trigger click
    $("[data-toggle=popover]").on('click', function(e) {
      // Prevent the default action
      e.preventDefault();

      // Close other popovers and toggle the current one
      closeAllPopoversExcept(this);
      $(this).popover('toggle');
    });

    // Close popovers when clicking elsewhere on the page
    $('body').on('click', function(e) {
      if (!$(e.target).closest('.popover').length && !$(e.target).is('[data-toggle=popover]')) {
        closeAllPopoversExcept(null);
      }
    });

    //Listens for when a button inside the filter_beds class is pressed and updates as needed
    $('body').on('click', '.filter_beds button', function() {
      $('.filter_beds button').removeClass('SelectedBed');
      $('.filter_beds button').attr('aria-pressed', 'false');
      $(this).addClass('SelectedBed');
      $(this).attr('aria-pressed', 'true');
      updateSelectionText();
      searchNowListingMap();
    });

    //Listens for when a button inside the filter_baths class is pressed and updates as needed
    $('body').on('click', '.filter_baths button', function() {
      $('.filter_baths button').removeClass('SelectedBath');
      $('.filter_baths button').attr('aria-pressed', 'false');
      $(this).addClass('SelectedBath');
      $(this).attr('aria-pressed', 'true');
      updateSelectionText();
      searchNowListingMap();
    });

    //Updates the text displayed at the top field of the bed and bath button
    function updateSelectionText() {
      var displayText = selectedBedValue + ' Beds - ' + selectedBathroomValue + ' Bathrooms';
      $('#bedsAndBathButton').text(displayText);
    }

    // $('#searchButton').click(function() {
    //   var selectedData = $('#search-box-input').select2('data');
    //   var propertyStatus = $('#propertyStatusDropdown').val();

    //   var districtIds = [],
    //     municipalityIds = [],
    //     locationIds = [];

    //   selectedData.forEach(function(item) {
    //     switch (item.type) {
    //       case "District":
    //         districtIds.push(item.id);
    //         break;
    //       case "Municipality":
    //         municipalityIds.push(item.id);
    //         break;
    //       case "Location":
    //         locationIds.push(item.id);
    //         break;
    //     }
    //   });

    //   // Construct the URL
    //   var url = "/page/listings?";
    //   if (districtIds.length > 0) {
    //     url += "district=" + districtIds.join(',') + "&";
    //   }
    //   if (municipalityIds.length > 0) {
    //     url += "municipality=" + municipalityIds.join(',') + "&";
    //   }
    //   if (locationIds.length > 0) {
    //     url += "location=" + locationIds.join(',') + "&";
    //   }
    //   if (propertyStatus !== "") {
    //     url += "property_status=" + propertyStatus + "&";
    //   }

    //   // Remove the last '&' or '?' from the URL
    //   url = url.slice(0, -1);

    //   window.location.href = url;
    // });
    $('body').on('change', '#exposed-filters-exact-beds-check', function() {
      var useExactMatch = $(this).is(':checked');
      console.log(useExactMatch);

      if (useExactMatch == true) {
        exactMatchBed = 1
        searchNowListingMap();
      } else {
        exactMatchBed = 0;
        searchNowListingMap();
      }

      $('.filter_beds button').each(function() {
        var buttonText = $(this).text();
        if (useExactMatch) {
          buttonText = buttonText.replace('+', '');
        } else {
          var buttonValue = $(this).attr('value');
          if (buttonValue !== '0' && !buttonText.includes('+') && $(this).attr('value') != '') {
            buttonText += '+';
          }
        }
        $(this).text(buttonText);
      });
      if (useExactMatch == true) {
        exactMatchBed = 1
        searchNowListingMap();
      } else {
        exactMatchBed = 0;
        searchNowListingMap();
      }
      // alert('exactMatchBed: ' + exactMatchBed);

      var bedsButtonText = $('#bedsAndBathButton').text();
      if (useExactMatch) {

        selectedBedValue = selectedBedValue.replace('+', '');
      } else {
        if (!selectedBedValue.includes('+') && selectedBedValue !== 'Any') {
          selectedBedValue += '+';
        }
      }
      updateSelectionText();
    });

    $('body').on('change', '#exposed-filters-exact-baths-check', function() {
      var useExactMatch = $(this).is(':checked');
      if (useExactMatch) {
        exactMatchBath = 1
        searchNowListingMap();
      } else {
        exactMatchBath = 0;
        searchNowListingMap();
      }

      $('.filter_baths button').each(function() {
        var buttonText = $(this).text();

        if (useExactMatch) {
          buttonText = buttonText.replace('+', '');
        } else {
          var buttonValue = $(this).attr('value');
          if (buttonValue !== '0' && !buttonText.includes('+') && $(this).attr('value') != '') {
            buttonText += '+';
          }
        }

        $(this).text(buttonText);
      });
      var bedsButtonText = $('#bedsAndBathButton').text();
      if (useExactMatch) {
        selectedBedValue = selectedBedValue.replace('+', '');
      } else {
        if (!selectedBedValue.includes('+') && selectedBedValue !== 'Any') {
          selectedBedValue += '+';
        }
      }
      updateSelectionText();
    });

  });
  // clearDrawingsMap();
  var view = '<?php echo $view; ?>';

  var map = null;

  var circle;
  var viewCircleFlag = 0;
  // area_size=0%20sq%20,1300%20sq%20&price_rang
  search_term = "";
  number_of_bathrooms = '<?php if (isset($_GET['bathrooms'])) echo $_GET['bathrooms'];
                          else echo ""; ?>';
  console.log(number_of_bathrooms);
  var bathButtons = document.querySelectorAll('.filter_baths button');
  bathButtons.forEach(function(button) {
    //console.log(button.value);
    if (button.value === number_of_bathrooms) {
      console.log("Found!");

    }
  });
  number_of_bedrooms = '<?php if (isset($_GET['bedrooms'])) echo $_GET['bedrooms'];
                        else echo ""; ?>';
  temp = '<?php if (isset($_GET['features'])) echo $_GET['features'];
          else echo ""; ?>';
  if (temp !== '') {
    features = temp.split(",");
    for (var j = 0; j < features.length; j++) {
      document.getElementById('fcheck-' + features[j]).checked = true;
    }
  }


  var listing_type = '<?php if (isset($_GET['property_type'])) echo $_GET['property_type'];
                      else echo ""; ?>';
  for (var j = 0; j < listing_type.length; j++) {
    var optionValue = listing_type[j];
    var optionElement = document.querySelector('.propertType option[value="' + optionValue + '"]');
    if (optionElement) {
      optionElement.selected = true;
    }
  }

  var listing_status = <?php echo json_encode(isset($_GET['property_status']) ? explode(',', $_GET['property_status']) : []); ?>;
  for (var j = 0; j < listing_status.length; j++) {
    var optionValue = listing_status[j];
    var optionElement = document.querySelector('.propertStatus option[value="' + optionValue + '"]');
    if (optionElement) {
      optionElement.selected = true;
    }
  }



  loadActiveListingsListingMap([0, 0], 0, 9);

  function loadPageListingMap(index, maker_position0, maker_position1, set, zoom) {
    document.getElementById("page_index").value = index;
    $('html,body').scrollTop(0);
    loadActiveListingsListingGrid([maker_position0, maker_position1], set, zoom);
  }


  function loadActiveListingsListingGrid(maker_position, set, zoom, freedraw = false) {

    // alert('minPrice: ' + $('#minPrice').val());

    // return true;

    customer_id = '<?php echo $user_id; ?>';


    if (document.querySelector(".filter_baths .SelectedBath")) {
      var selectedBathValue = document.querySelector(".filter_baths .SelectedBath").value;
      if (selectedBathValue > 0) {
        console.log(selectedBathValue);
        number_of_bathrooms = selectedBathValue;
      }
    }
    if (document.querySelector(".filter_beds .SelectedBed")) {
      var selectedBedValue = document.querySelector(".filter_beds .SelectedBed").value;
      if (selectedBedValue > 0) {
        console.log(selectedBedValue);
        number_of_bedrooms = selectedBedValue;
      }
    }

    var tempFeatures = [];
    var features = document.getElementsByClassName('featurecheck');
    for (var j = 0; j < features.length; j++) {
      if (features[j].checked) {
        tempFeatures.push(features[j].value);
      }
    }



    tempDistrictArr = [];
    tempMunicipalitiesArr = [];
    tempLocationArr = [];


    if ($('#search-box-input').data('select2')) {
      var selectedItems = $('#search-box-input').select2('data');
      if (selectedItems && selectedItems.length > 0) {
        console.log(selectedItems);

        for (var j = 0; j < selectedItems.length; j++) {
          var selectedItem = selectedItems[j];
          console.log(selectedItem.text);
          if (selectedItem.text.includes('(District)')) {
            tempDistrictArr.push(selectedItem.id);
            console.log(tempDistrictArr);
          } else if (selectedItem.text.includes('(Municipality)')) {
            tempMunicipalitiesArr.push(selectedItem.id);
          } else if (selectedItem.text.includes('(Location)')) {
            tempLocationArr.push(selectedItem.id);
          }
        }
      }
    }


    var tempPropertStatus = [];
    var propertyStatusSelect = document.querySelector('.selectpicker.propertStatus');
    if (propertyStatusSelect) {
      var options = propertyStatusSelect.options;
      for (var j = 0; j < options.length; j++) {
        if (options[j].selected) {
          tempPropertStatus.push(options[j].value);
        }
      }
    }


    var tempPropertTypes = [];
    var propertTypes = document.querySelector('.selectpicker.propertType');
    if (propertTypes) {
      var options = propertTypes.options;
      for (var j = 0; j < options.length; j++) {
        if (options[j].selected) {
          tempPropertTypes.push(options[j].value);
        }
      }
    }




    orderbyName = "";
    orderbyType = "";
    switch (document.getElementById("sortby").value) {
      case "1":
        orderbyName = "updated_at";
        orderbyType = "desc";
        break;
      case "2":
        orderbyName = "price";
        orderbyType = "asc";
        break;
      case "3":
        orderbyName = "price";
        orderbyType = "desc";
        break;
    }
    console.log("marker_search" + marker_search);

    // exactMatchBed = 0;
    // exactMatchBath = 0;

    // alert('exactMatchBed: ' + exactMatchBed);
    // alert('exactMatchBath: ' + exactMatchBath);

    // alert('minPrice: ' + $('#minPrice').val());
    // alert('minPrice: ' + $('#minPrice').find(":selected").val());
    // alert('maxPrice: ' + $('#maxPrice').find(":selected").val());

    console.log($('#minSquareFeet').val());
    console.log($('#minPrice').val());
    var newurl = '<?php echo env('APP_URL'); ?>/page/listings?'
    newurl += 's=' + marker_search;
    newurl += '&district=' + tempDistrictArr;
    newurl += '&municipality=' + tempMunicipalitiesArr;
    newurl += '&location=' + tempLocationArr;
    newurl += '&property_status=' + tempPropertStatus;
    newurl += '&property_type=' + tempPropertTypes;
    newurl += '&bedrooms=' + number_of_bedrooms;
    newurl += '&bathrooms=' + number_of_bathrooms;
    newurl += '&area_size=' + $('#minsquarefeet').val() + ',' + $('#maxsquarefeet').val();
    newurl += '&price_range=' + $('#minPrice').val() + ',' + $('#maxPrice').val();
    newurl += '&lot_size=' + $('#minlotsize').val() + ',' + $('#maxlotsize').val();
    newurl += '&features=' + tempFeatures;
    newurl += '&exactMatchBed=' + exactMatchBed;
    newurl += '&exactMatchBath=' + exactMatchBath;
    newurl += '&draw_map=' + '';
    newurl += '&view=' + view;
    window.history.pushState({
      path: newurl
    }, '', newurl);

    var markers = localStorage.getItem("freedraw-polys");




    const sendData = {
      "number_of_bathrooms": number_of_bathrooms,
      "number_of_bedrooms": number_of_bedrooms,
      "listing_types": tempPropertTypes,
      "features": tempFeatures,
      "min_area_size": $('#minSquareFeet').val(),
      "max_area_size": $('#maxSquareFeet').val(),
      "min_price": $('#minPrice').val(),
      "max_price": $('#maxPrice').val(),
      "property_type_array": tempPropertStatus,
      "districts": tempDistrictArr,
      "municipalities": tempMunicipalitiesArr,
      "locations": tempLocationArr,
      "customer_id": customer_id,
      "page": document.getElementById("page_index").value,
      "per_page": document.getElementById("paginSize").value,
      "orderbyName": orderbyName,
      "orderbyType": orderbyType,
      "exactMatchBed": exactMatchBed,
      "exactMatchBath": exactMatchBath,
      "radius": maker_position,
      "set": set,
      "retrieve_markers": 1
    };
    ps = localStorage.getItem("freedraw-polys")
    if (ps)
      sendData.markers = JSON.parse(ps)
    const url = "/api/activelistings";
    let xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/json');
    xhr.send(JSON.stringify(sendData));
    xhr.onload = function() {
      if (document.getElementById("page_index").value == 1) {
        markers = JSON.parse(xhr.response).listing_markers;
        var markersArray = [];
        for (i = 0; i < markers.length; i++) {
          if (markers[i].center[0] > 0) {
            markersArray.push(markers[i]);
          }
        }
        map_init_circle(markersArray, maker_position, set, zoom);
      }

      list = JSON.parse(xhr.response).items.data;
      const url = new URL(window.location.href);
      if (typeof JSON.parse(xhr.response).hash !== "undefined") {
        url.searchParams.set('s', JSON.parse(xhr.response).hash);

      } else {
        url.searchParams.delete('s');
      }
      window.history.replaceState(null, null, url);

      //list = list.data;
      totalrecords = JSON.parse(xhr.response).items.total;
      current_page = JSON.parse(xhr.response).items.current_page;
      per_page = JSON.parse(xhr.response).items.per_page;
      // alrt(total);
      // var valueArray = [];
      var temp = "";
      for (i = 0; i < list.length; i++) {
        listingStr = "";
        for (j = 0; j < list[i].listing_types.length; j++) {
          if (j == 0) {
            listingStr += list[i].listing_types[j];
          } else {
            listingStr += " , " + list[i].listing_types[j];
          }
        }
        if (list[i].property_type !== "") {
          if (listingStr == "") {
            listingStr += list[i].property_type;
          } else {
            listingStr += " , " + list[i].property_type;
          }
        }
        favorite = "";
        if (list[i].in_favoriteproperties == 1) {
          favorite = 'style="fill: red;"';
        }
        temp += `<div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale" style="padding:5px;">
                        <article  role="group" data-testid="Homes For You-card-0" class="StyledPropertyCard-c11n-8-86-1__sc-jvwq6q-0 bnlSnT">
                            <div  aria-label="4334 Union St APT 1E, Flushing, NY 11355" class="StyledCard-c11n-8-86-1__sc-rmiu6p-0 dVWlBO StyledPropertyCardBody-c11n-8-86-1__sc-1p5uux3-0 ffvFdw" tabindex="0">
                                <div class="StyledPropertyCardDataWrapper-c11n-8-86-1__sc-1omp4c3-0 daWIrq">
                                    <div class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 zybOF">`;
        // console.log(list[i].price);
        if (parseInt(list[i].price) > 0) {

          temp += `€ ` + list[i].price;
        }
        temp += `  <span style="font-size: 17px;margin-left: 20px;">` + list[i].location_name + `</span></div>
                                    <div class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 bLsshH">
                                        <span class="StyledPropertyCardHomeDetails-c11n-8-86-1__sc-1mlc4v9-0 ebUkxz">`;
        if (parseInt(list[i].number_of_bedrooms) > 0) {
          temp += `<span>
                                                <b>` + list[i].number_of_bedrooms + `</b> bds
                                            </span>`;
        }
        if (parseInt(list[i].number_of_bathrooms) > 0) {
          temp += `<span>
                                                <b>` + list[i].number_of_bathrooms + `</b> ba
                                            </span>`;
        }
        if (parseInt(list[i].area_size) > 0) {
          temp += `<span>
                                                <b>` + list[i].area_size + `</b> sqft
                                            </span>`;
        }
        temp += `</span>
                                        <span>` + listingStr + `</span>
                                    </div>
                                    <a onclick="showListigDetailModal(` + list[i].id + `);" tabindex="-1" class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 bWMoAg" style="text-decoration: none;">
                                        <address>` + list[i].displayname + `</address>
                                    </a>
                                    <div class="StyledPropertyCardDataArea-c11n-8-86-1__sc-yipmu-0 cuZKL">LISTING BY: SABBIANCO PROPERTIES LTD</div>
                                    <div class="StyledPropertyCardActionArea-c11n-8-86-1__sc-l8gezt-0 gUZfaS"></div>
                                </div>
                                <div class="StyledPropertyCardPhotoWrapper-c11n-8-86-1__sc-204bo4-0 jBRDYV">
                                    <div class="StyledPropertyCardPhotoHeader-c11n-8-86-1__sc-10m3z6y-0 gGpqXV">
                                        <div class="StyledPropertyCardBadgeArea-c11n-8-86-1__sc-wncxdw-0 OPwBD"></div>
                                        <div class="StyledPropertyCardSaveArea-c11n-8-86-1__sc-15nlng8-0 kMnzOu">
                                            <button aria-disabled="false" onclick="addFavoritListingMap(` + list[i].id + `)" aria-pressed="false" aria-label="Save" data-testid="property-card-save" class="StyledButton-c11n-8-86-1__sc-wpcbcc-0 YDAbE StyledPropertyCardSaveButton-c11n-8-86-1__sc-dquvr7-0 dsoFUX">
                                                <span class="StyledButtonIcon-c11n-8-86-1__sc-wpcbcc-1 fGXTKq">
                                                    <svg viewBox="0 0 24 22">
                                                        <path id="faHeart` + list[i].id + `" ` + favorite + ` class="HeartIcon__fill" d="M17.3996 6.17511e-05C15.5119 0.00908657 13.7078 0.779206 12.3955 2.13608L11.9995 2.54408L11.6035 2.13608C10.2912 0.779206 8.48708 0.00908657 6.59946 6.17511e-05C5.15317 -0.00630912 3.7479 0.480456 2.61543 1.38007C1.08163 2.60976 0.137114 4.42893 0.0137749 6.39093C-0.109564 8.35294 0.5997 10.2761 1.96743 11.6882L2.51943 12.2522L11.3995 21.3482C11.5575 21.5095 11.7738 21.6004 11.9995 21.6004C12.2253 21.6004 12.4415 21.5095 12.5995 21.3482L21.4796 12.2522L22.0316 11.6882C23.3993 10.2761 24.1086 8.35294 23.9852 6.39093C23.8619 4.42893 22.9174 2.60976 21.3836 1.38007C20.2511 0.480456 18.8458 -0.00630912 17.3996 6.17511e-05Z"></path>
                                                        <path class="HeartIcon__outline" d="M12.3955 2.13608C13.7078 0.779206 15.5119 0.00908657 17.3996 6.17511e-05C18.8458 -0.00630912 20.2511 0.480456 21.3836 1.38007C22.9174 2.60976 23.8619 4.42893 23.9852 6.39093C24.1086 8.35294 23.3993 10.2761 22.0316 11.6882L21.4796 12.2522L12.5995 21.3482C12.4415 21.5095 12.2253 21.6004 11.9995 21.6004C11.7738 21.6004 11.5575 21.5095 11.3995 21.3482L2.51943 12.2522L1.96743 11.6882C0.5997 10.2761 -0.109564 8.35294 0.0137748 6.39093C0.137114 4.42893 1.08163 2.60976 2.61543 1.38007C3.7479 0.480456 5.15317 -0.00630912 6.59946 6.17511e-05C8.48708 0.00908657 10.2912 0.779206 11.6035 2.13608L11.9995 2.54408L12.3955 2.13608ZM19.8956 3.25208C19.1854 2.69122 18.3045 2.39053 17.3996 2.40008C16.1576 2.41525 14.9717 2.91978 14.0995 3.80409L13.7155 4.21209L12.4315 5.5321C12.1927 5.77011 11.8063 5.77011 11.5675 5.5321L10.2835 4.21209L9.8995 3.80409C9.0273 2.91978 7.84145 2.41525 6.59947 2.40008C5.69165 2.39734 4.81045 2.70661 4.10345 3.27608C3.09352 4.06928 2.47292 5.25804 2.39944 6.54011C2.31914 7.81608 2.78104 9.06669 3.67145 9.98414L4.22345 10.5601L11.9995 18.5162L19.8476 10.5601L20.3996 9.98414C21.2638 9.05458 21.6991 7.80545 21.5996 6.54011C21.5329 5.2495 20.9116 4.05071 19.8956 3.25208Z"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="StyledPropertyCardPhotoBody-c11n-8-86-1__sc-128t811-0 elHFdM">
                                        <a onclick="showListigDetailModal(` + list[i].id + `);" tabindex="-1" aria-hidden="false" class="Anchor-c11n-8-86-1__sc-hn4bge-0 ifquJH" style="display: block; height: 100%;">
                                            <div class="StyledPropertyCardPhoto-c11n-8-86-1__sc-ormo34-0 bGxHGW">
                                                <img src="` + list[i].image + `" alt="4334 Union St APT 1E, Flushing, NY 11355" aria-hidden="false" draggable="auto" class="Image-c11n-8-86-1__sc-1rtmhsc-0" data-xblocker="passed" style="visibility: visible;">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="StyledPropertyCardPhotoFooter-c11n-8-86-1__sc-bdiiml-0 kPCjYF"></div>
                                </div>
                            </div>
                        </article>
                    </div>`;
      }
      document.getElementById("ListingListContent").innerHTML = temp;
      document.getElementById("page_count").innerHTML = totalrecords + " Search results"
      if (list.length > 0) {
        document.getElementById("ListingListContent").style.height = "auto";
      } else {
        document.getElementById("ListingListContent").style.height = "500px";
      }

      sendData1 = {
        "total": totalrecords,
        "current_page": current_page,
        "per_page": per_page,
      }
      const url1 = "/api/getpagination";
      let xhr1 = new XMLHttpRequest();
      xhr1.open('POST', url1, true);
      xhr1.setRequestHeader('Content-type', 'application/json');
      xhr1.send(JSON.stringify(sendData1));
      xhr1.onload = function() {
        data1 = JSON.parse(xhr1.response);
        list1 = data1.links;
        temp1 = "";
        if (window.innerWidth > 650) {
          for (j = 0; j < list1.length; j++) {
            tempUrl = list1[j].url;
            if (tempUrl == null) {
              tempIndex = null;
            } else {
              tempIndex = tempUrl.substring(tempUrl.indexOf("?page=") + 6);
            }
            flag = "";
            if (list1[j].active) {
              flag = "active";
            }
            temp1 += `<li class="page-item ` + flag + `"><a class="page-link" onclick="loadPageListingMap(` + tempIndex + `,` + maker_position[0] + `,` + maker_position[1] + `,` + set + `,` + zoom + `)">` + list1[j].label + `</a></li>`;
          }
        } else {
          for (j = 0; j < list1.length; j++) {
            tempUrl = list1[j].url;
            if (tempUrl == null) {
              tempIndex = null;
            } else {
              tempIndex = tempUrl.substring(tempUrl.indexOf("?page=") + 6);
            }
            if (j == 0 || j == list1.length - 1) {
              temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageListingMap(` + tempIndex + `,` + maker_position[0] + `,` + maker_position[1] + `,` + set + `,` + zoom + `)">` + list1[j].label + `</a></li>`;
            } else {
              if (list1[j].active) {
                flag = "active";
                temp1 += `<li class="page-item ` + flag + `"><a class="page-link" onclick="loadPageListingMap(` + tempIndex + `,` + maker_position[0] + `,` + maker_position[1] + `,` + set + `,` + zoom + `)">` + list1[j].label + `</a></li>`;
              }
            }
          }
        }
        document.getElementById("pagin_content").innerHTML = temp1;

      }
    }
  }

  function loadActiveListingsListingMap(maker_position, set, zoom) {
    document.getElementById("page_index").value = 1;
    loadActiveListingsListingGrid(maker_position, set, zoom);
  }

  function addFavoritListingMap(index) {

    customer_id = '<?php echo $user_id; ?>';
    if (customer_id !== "") {
      const url = "/api/add-remove-to-favorites";
      const sendData = {
        "customer_id": customer_id,
        "listing_id": index,
      };
      let xhr = new XMLHttpRequest();
      xhr.open('POST', url, true);
      xhr.setRequestHeader('Content-type', 'application/json');
      xhr.send(JSON.stringify(sendData));
      xhr.onload = function() {
        var paragraph = document.getElementById("faHeart" + index);
        if (paragraph.style.fill !== "red") {
          paragraph.style.fill = "red";
        } else {
          paragraph.style.fill = "currentColor";
        }
      }
    } else {
      loginIn();
    }
  }

  var freeDraw
  var markers

  function map_init_circle(valueArray, maker_position, set, zoom) {

    if ($('#map-leaflet').length) {
      if (window.innerWidth <= 768) {
        document.getElementById("MapListingMap").style.display = "block";
      }
      var container = L.DomUtil.get('map');

      if (container != null) {
        container._leaflet_id = null;
      }

      if (map !== undefined && map !== null) {
        map.removeLayer(freeDraw);
        map.remove(); // should remove the map from UI and clean the inner children of DOM element
      }
      if (set > 0) {
        map = L.map('map-leaflet', {
          drawControl: true,
          tap: true
        }).setView(maker_position, zoom);
      } else {
        map = L.map('map-leaflet', {
          tap: true
        }).setView([34.994003757575776, 33.15703828125001], zoom);
      }


      freeDraw = new FreeDraw({
        mode: FreeDraw.NONE
      });

      map.addLayer(freeDraw);

      //localStorage.clear("freedraw-polys")
      ps = localStorage.getItem("freedraw-polys")
      if (ps) {
        (JSON.parse(ps)).forEach(p => {
          freeDraw.create(p)
        })
      }

      freeDraw.on('markers', event => {
        localStorage.setItem("freedraw-polys", JSON.stringify(event.latLngs))

        var new_markers = []
        markerArray.forEach((m, i) => {

          if (event.latLngs.length == 0) {
            if (!map.hasLayer(m)) {
              map.addLayer(m)
            }
            new_markers.push(i)
          } else {
            if (isMarkerInsidePolygon(m, event.latLngs)) {
              if (!map.hasLayer(m)) {
                map.addLayer(m)

              }
              new_markers.push(i)
            } else {
              map.removeLayer(m)
            }
          }
        })
        markers = event.latLngs

        $("#freeDrawingMap").removeClass("active")
        freeDraw.mode(FreeDraw.NONE)
        loadActiveListingsListingGrid(maker_position, set, zoom);


      });

      function isMarkerInsidePolygon(marker, poly) {

        for (var p = 0; p < poly.length; p++) {
          var polyPoints = poly[p];

          var x = marker.getLatLng().lat,
            y = marker.getLatLng().lng;

          var inside = false;
          for (var i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {

            var xi = polyPoints[i].lat,
              yi = polyPoints[i].lng;
            var xj = polyPoints[j].lat,
              yj = polyPoints[j].lng;

            var intersect = ((yi > y) != (yj > y)) &&
              (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
            if (intersect) inside = !inside;
          }

          if (inside) return inside;
        }
        return inside;
      };


      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

      circle = L.circle(maker_position, 1000 * set).addTo(map);
      circle.setStyle({
        color: 'green',
        opacity: 0.5
      });

      if (viewCircleFlag > 0) {
        var donut = L.donut(maker_position, {
          radius: 20000000000000,
          innerRadius: 1000 * set,
          innerRadiusAsPercent: false,
          color: '#000',
          weight: 2,
        }).addTo(map);
      }

      var markerArray = [];

      valueArray.forEach((value) => {
        var icon = L.divIcon({
          html: value.icon,
          iconSize: [50, 50],
          iconAnchor: [50, 50],
          popupAnchor: [-20, -42]
        });
        var marker = L.marker(value.center, {
          icon: icon
        });
        map.addLayer(marker);
        //markerArray.push(marker);
        markerArray[value.id] = marker;
        marker.bindPopup(
          '<div class="listing-window-image-wrapper">' +
          '<a onclick="showListigDetailModal(' + value.id + ');">' +
          '<div class="listing-window-image" style="background-image: url(' + value.image + ');"></div>' +
          '<div class="listing-window-content">' +
          '<div class="info">' +
          '<h2>' + value.title + '</h2>' +
          '<p>' + value.desc + '</p>' +
          '<h3>' + value.price + '</h3>' +
          '</div>' +
          '</div>' +
          '</a>' +
          '</div>'
        );
      })

      let marker = new L.marker(maker_position, {
        draggable: 'true'
      });

      marker.on('dragend', function(event) {
        temp = marker.getLatLng();
        marker.setLatLng(temp, {
          draggable: 'true'
        });
        circle.setLatLng(temp);
        document.getElementById("page_index").value = 1;
        loadActiveListingsListingMap([temp.lat, temp.lng], circle.getRadius() / 1000, map.getZoom());
      });

      map.addLayer(marker);

      map.on('mousedown', function(event) {
        if (viewCircleFlag == 1) {
          marker.setLatLng(event.latlng);
          circle.setLatLng(event.latlng);
          circle.setRadius(0);
          viewCircleFlag = 2;
          map.scrollWheelZoom.disable();
        } else if (viewCircleFlag == 2) {
          map.scrollWheelZoom.enable();
          temp = marker.getLatLng();
          distance = Math.sqrt(Math.pow(event.latlng.lat - temp.lat, 2) + Math.pow(event.latlng.lng - temp.lng, 2))
          circle.setRadius(distance * 1000 / 0.011);
          loadActiveListingsListingMap([temp.lat, temp.lng], distance / 0.011, map.getZoom());
          viewCircleFlag = 3;
          document.getElementById("redrawCircleListingMap").style.background = "rgb(255, 255, 255)";
          document.getElementById("redrawCircleListingMap").style.color = "rgb(0, 0, 0)";
        }
      });

      map.on('mousemove', event => {
        if (viewCircleFlag == 2) {
          temp = marker.getLatLng();
          distance = Math.sqrt(Math.pow(event.latlng.lat - temp.lat, 2) + Math.pow(event.latlng.lng - temp.lng, 2))
          circle.setRadius(distance * 1000 / 0.0115742);
        }
      });

      if (window.innerWidth <= 768) {
        if (document.getElementById("showMapListingListingMap").innerHTML == "Show Listings") {
          document.getElementById("MapListingMap").style.display = "block";
        } else {
          document.getElementById("MapListingMap").style.display = "none";
        }
      }

    }
  }

  function searchNowListingMap() {


    $(".explore__form-checkbox-list").removeClass("filter-block");
    //freeDraw.clear();
    viewCircleFlag = 0;
    //document.getElementById("redrawCircleListingMap").style.display = "none";
    //document.getElementById("showCircleListingMap").style.background = "rgb(255, 255, 255)";
    //document.getElementById("showCircleListingMap").style.color = "rgb(0, 0, 0)";
    //document.getElementById("showCircleListingMap").innerHTML = "Draw";
    //hiddenAdvancedDivListingMap();
    loadActiveListingsListingMap([0, 0], 0, 9);

  }
  // Define a click event handler
  $('.district').click(function() {
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
    searchNowListingMap();
  });
  $('.municipality').click(function() {
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
    searchNowListingMap();
  });
  $('.location').click(function() {
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
    searchNowListingMap();
  });


  function clearDrawingsMap() {
    $('#search-box-input').val(null).trigger('change');
    localStorage.removeItem("freedraw-polys");
    freeDraw.clear();
  }

  function freeDrawingMap() {

    $('input:checkbox').each(function() {
      this.checked = false;
    });
    // document.getElementById("ListingListContent").innerHTML = "";
    // document.getElementById("page_count").innerHTML = " Search results"
    // document.getElementById("pagin_content").innerHTML = "";
    if ($("#freeDrawingMap").hasClass("active")) freeDraw.mode(FreeDraw.NONE)
    else freeDraw.mode(FreeDraw.ALL)
  }

  function showCircleListingMap() {
    if (viewCircleFlag > 0) {
      viewCircleFlag = 0;
      document.getElementById("redrawCircleListingMap").style.display = "none";
      document.getElementById("showCircleListingMap").style.background = "rgb(255, 255, 255)";
      document.getElementById("showCircleListingMap").style.color = "rgb(0, 0, 0)";
      document.getElementById("showCircleListingMap").innerHTML = "Draw";
      loadActiveListingsListingMap([0, 0], 0, 9);
    } else {
      viewCircleFlag = 1;
      $("#map_success").fadeIn(300).delay(5000).fadeOut(400);
      document.getElementById("showCircleListingMap").style.background = "rgb(34, 150, 67)";
      document.getElementById("showCircleListingMap").style.color = "rgb(255, 255, 255)";
      document.getElementById("showCircleListingMap").innerHTML = "Clear";
      document.getElementById("redrawCircleListingMap").style.display = "flex";
      document.getElementById("redrawCircleListingMap").style.background = "rgb(34, 150, 67)";
      document.getElementById("redrawCircleListingMap").style.color = "rgb(255, 255, 255)";
      map_init_circle([], [0, 0], 0, 9);
      document.getElementById("ListingListContent").innerHTML = "";
      document.getElementById("page_count").innerHTML = " Search results"
      document.getElementById("pagin_content").innerHTML = "";
      $('input:checkbox').each(function() {
        this.checked = false;
      });
    }
  }

  function redrawCircleListingMap() {
    $("#map_success").fadeIn(300).delay(3000).fadeOut(400);
    viewCircleFlag = 1;
    document.getElementById("redrawCircleListingMap").style.background = "rgb(34, 150, 67)";
    document.getElementById("redrawCircleListingMap").style.color = "rgb(255, 255, 255)";
  }


  function showHideMapListingListingMap() {
    document.getElementById("MapListingMap").style.height = "870px";
    if ($(window).width() > 1000) {
      document.getElementById("ListingListingMapDiv").style.display = "block";
      document.getElementById("showMapListingListingMap").style.display = "hide";
      document.getElementById("MapListingMap").style.display = "block";
    } else {
      document.getElementById("showMapListingListingMap").style.display = "show";
      if (view == 'map') {
        document.getElementById("ListingListingMapDiv").style.display = "none";
        document.getElementById("MapListingMap").style.display = "block";
        document.getElementById("showMapListingListingMap").innerHTML = "Show Listings";
      } else if (view == 'listings') {
        document.getElementById("MapListingMap").style.display = "none";
        document.getElementById("ListingListingMapDiv").style.display = "block";
        document.getElementById("showMapListingListingMap").innerHTML = "Show Map";
      }
    }
  }
  showHideMapListingListingMap();

  function replaceview() {
    if (view == 'map') {
      view = 'listings';
    } else if (view == 'listings') {
      view = 'map';
    }
    showHideMapListingListingMap();

    var href = new URL('<?php echo env('APP_URL'); ?>/page/listings' + location.search);
    href.searchParams.set('view', view);



    window.history.pushState({
      path: href.toString()
    }, '', href.toString());
  }

  function forSaleBtn() {
    if (document.getElementById("listing-type-dropdown").style.display == "block") {
      document.getElementById("listing-type-dropdown").style.display = "none";
    } else {
      document.getElementById("listing-type-dropdown").style.display = "block";
    }
  }

  function priceBtn() {
    if (document.getElementById("price-dropdown").style.display == "block") {
      document.getElementById("price-dropdown").style.display = "none";
    } else {
      document.getElementById("price-dropdown").style.display = "block";
    }
  }

  // function hiddenAdvancedDivListingMap() {
  //   document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
  // }
  // $(window).resize(function() {
  //   window.location.reload();
  // });
  function searchReset() {
    $('#search-box-input').val(null).trigger('change');
    $(".propertStatus").val('default').selectpicker("refresh");
    $(".propertType").val('default').selectpicker("refresh");
    $('#minPrice').val('');
    $('#maxPrice').val('');
    $('#minsquarefeet').val('');
    $('#maxsquarefeet').val('');
    $('#minlotsize').val('');
    $('#maxlotsize').val('');
    //$('.featurecheck').prop('checked', false);

    $('#selBedrooms').val('');
    $('#selBathrooms').val('');
    searchNowListingMap();

    clearDrawingsMap();
  }

  function replace_divs() {
    if ($(window).width() > 1000) {
      if ($('#location_mobilediv').html() != '') {
        var $locationdiv = $('#location_mobilediv').clone();
        $('#location_desktopdiv').html($locationdiv);
        $('#location_mobilediv').html('');
        $("#location_mobilediv").css("display", "none");
        $("#location_desktopdiv").css("display", "block");
      }
      if ($('#property_status_mobilediv').html() != '') {
        var $locationdiv = $('#property_status_mobilediv').clone();
        $('#property_status_desktopdiv').html($locationdiv);
        $('#property_status_mobilediv').html('');
        $("#property_status_mobilediv").css("display", "none");
        $("#property_status_desktopdiv").css("display", "block");
      }
      if ($('#property_type_mobilediv').html() != '') {
        var $locationdiv = $('#property_type_mobilediv').clone();
        $('#property_type_desktopdiv').html($locationdiv);
        $('#property_type_mobilediv').html('');
        $("#property_type_mobilediv").css("display", "none");
        $("#property_type_desktopdiv").css("display", "block");
      }
    } else {
      if ($('#location_desktopdiv').html() != '') {
        var $locationdiv = $('#location_desktopdiv').clone();
        $('#location_mobilediv').html($locationdiv);
        $('#location_desktopdiv').html('');
        $("#location_mobilediv").css("display", "block");
        $("#location_desktopdiv").css("display", "none");
      }
      if ($('#property_status_desktopdiv').html() != '') {
        var $locationdiv = $('#property_status_desktopdiv').clone();
        $('#property_status_mobilediv').html($locationdiv);
        $('#property_status_desktopdiv').html('');
        $("#property_status_mobilediv").css("display", "block");
        $("#property_status_desktopdiv").css("display", "none");
      }
      if ($('#property_type_desktopdiv').html() != '') {
        var $locationdiv = $('#property_type_desktopdiv').clone();
        $('#property_type_mobilediv').html($locationdiv);
        $('#property_type_desktopdiv').html('');
        $("#property_type_mobilediv").css("display", "block");
        $("#property_type_desktopdiv").css("display", "none");
      }
    }
  }

  function iformat(icon, badge, ) {
    var originalOption = icon.element;
    var originalOptionBadge = $(originalOption).data('badge');

    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
  }
  $(window).resize(function() {
    replace_divs()
  });
  replace_divs();
</script>