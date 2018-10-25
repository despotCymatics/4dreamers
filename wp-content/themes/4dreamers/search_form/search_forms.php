<div class="form-holder home">

<!-- FLIGHT SEARCH -->
<?php require "flight_search.php"; ?>

<!-- HOTEL SEARCH -->
<?php require "hotel_search.php"; ?>

<!-- RENT A CAR -->
<?php require "car_search.php"; ?>

<!-- FLIGHT + HOTEL SEARCH -->
<?php require "flight_hotel_search.php"; ?>

<!-- BUTTONS -->
  <div class="button-holder">
    <div class="">
      <button id="flight-toggle" type="button" class="btn btn-default choose active"><i class="fa fa-plane"></i> <?php echo pll__('Flight'); ?></button>
      <button id="hotel-toggle" type="button" class="btn btn-default choose"><i class="fa fa-building"></i> <?php echo pll__('Hotel'); ?></button>
      <button id="car-toggle" type="button" class="btn btn-default choose"><i class="fa fa-car"></i> <?php echo pll__('Renta Car'); ?></button>
      <button id="flight_hotel-toggle" type="button" class="btn btn-default choose"><i class="fa fa-suitcase"></i> <?php echo pll__('Flight'); ?>+<?php echo pll__('Hotel'); ?></button>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/search_query.js"></script>
</div>