<form class="form-inline form-hotel" role="form" id="hotel_search" name="hotel_search" method="POST">
  <div id="message" style="display: block;"></div>
    <div class="row">
        <div class="col-sm-6 margin-15-bottom">
            <label class="control-label" for="Destination"><?php echo pll__('Destination'); ?></label>
            <div class="controls">
                <i class="fa fa-map-marker infield"></i>
                <input id="Destination" name="Destination" type="text" placeholder="<?php echo pll__('City'); ?>" class="input destination" >
                <div class="not_valid_dest" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
            </div>
         </div>   
        <div class="col-sm-3 margin-15-bottom">
            <label class="control-label" for="DepartureDate"><?php echo pll__('Check-in date'); ?></label>
            <div class="controls">
                <i class="fa fa-calendar-o infield"></i>
                <input id="CheckIn" name="CheckIn" type="text" readonly="" placeholder="dd/mm/yyyy" class="input datePicker" value="<?php echo date('d/m/Y',strtotime("+2 days")); ?>">
            </div>
        </div>
            
        <div class="col-sm-3 margin-15-bottom">
            <label class="control-label" for="ReturnDate"><?php echo pll__('Check-out date'); ?></label>
            <div class="controls">
                <i class="fa fa-calendar-o infield"></i>
                <input id="CheckOut" name="CheckOut" type="text" readonly="" placeholder="dd/mm/yyyy" class="input datePicker" value="<?php echo date('d/m/Y',strtotime("+4 days")); ?>">
            </div>
        </div>
    </div>
    <div class="col-sm-12 margin-15-bottom box">
        <div style="padding-bottom:15px"></div>
        <!--div class="not_valid_captcha" style="display:none; color: red; top:80px"><?php echo pll__('You must fill this field!'); ?></div>
        <div id="g-recaptcha-hotel" class="g-recaptcha"></div-->
        <button style="top:40px;" type="button" id="launch_hotel_query" name="launch_hotel_query" class="btn btn-primary btn-lg search"><?php echo pll__('Search'); ?></button>
    </div>
</form>