<form class="form-inline form-car" role="form" name="car_search" id="car_search" method="POST">
<div id="message" style="display: block;"></div>
    <div class="row">
         <div class="col-sm-3 margin-15-bottom">
            <label class="control-label" for="PickUp"><?php echo pll__('Pick up location'); ?></label>
            <div class="controls">
                <i class="fa fa-map-marker infield"></i>
                <input id="PickUp" name="PickUp" type="text" placeholder="<?php echo pll__('Pick up location'); ?>" class="input destination">
                <div class="not_valid_pickup" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
            </div>
         </div> 
         <div class="col-sm-3 margin-15-bottom">
            <label class="control-label" for="DropOff"><?php echo pll__('Drop off location'); ?></label>
            <div class="controls">
                <i class="fa fa-map-marker infield"></i>
                <input id="DropOff" name="DropOff" type="text" placeholder="<?php echo pll__('Drop off location'); ?>" value="" class="input destination">
            </div>
         </div>   
        <div class="col-sm-3 margin-15-bottom">
            <label class="control-label" for="PickUpDate"><?php echo pll__('Pick up date'); ?></label>
            <div class="controls">
                <i class="fa fa-calendar-o infield"></i>
                <input id="PickUpDate" name="PickUpDate" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+2 days")); ?>" class="input datePicker">
                <div class="custom-select fa-caret-down right">
                    <select id="PickUpTime" name="PickUpTime" class="l-width">
                      <option value="">Select</option>
                      <option value="00:01">00:00</option>
                      <option value="01:00">01:00</option>
                      <option value="02:00">02:00</option>
                      <option value="03:00">03:00</option>
                      <option value="04:00">04:00</option>
                      <option value="05:00">05:00</option>
                      <option value="06:00">06:00</option>
                      <option value="07:00">07:00</option>
                      <option value="08:00">08:00</option>
                      <option selected="selected" value="09:00">09:00</option>
                      <option value="10:00">10:00</option>
                      <option value="11:00">11:00</option>
                      <option value="12:00">12:00</option>
                      <option value="13:00">13:00</option>
                      <option value="14:00">14:00</option>
                      <option value="15:00">15:00</option>
                      <option value="16:00">16:00</option>
                      <option value="17:00">17:00</option>
                      <option value="18:00">18:00</option>
                      <option value="19:00">19:00</option>
                      <option value="20:00">20:00</option>
                      <option value="21:00">21:00</option>
                      <option value="22:00">22:00</option>
                      <option value="23:00">23:00</option>
                    </select>
                </div>
            </div>
           
        </div>
            
        <div class="col-sm-3 margin-15-bottom">
            <label class="control-label" for="DropOffDate"><?php echo pll__('Drop off date'); ?></label>
            <div class="controls">
                <i class="fa fa-calendar-o infield"></i>
                <input id="DropOffDate" name="DropOffDate" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+4 days")); ?>" class="input datePicker">
                <div class="custom-select fa-caret-down right">
                    <select id="DropOffTime" name="DropOffTime" class="l-width">
                      <option value="">Select</option>
                      <option value="00:01">00:00</option>
                      <option value="01:00">01:00</option>
                      <option value="02:00">02:00</option>
                      <option value="03:00">03:00</option>
                      <option value="04:00">04:00</option>
                      <option value="05:00">05:00</option>
                      <option value="06:00">06:00</option>
                      <option value="07:00">07:00</option>
                      <option value="08:00">08:00</option>
                      <option selected="selected" value="09:00">09:00</option>
                      <option value="10:00">10:00</option>
                      <option value="11:00">11:00</option>
                      <option value="12:00">12:00</option>
                      <option value="13:00">13:00</option>
                      <option value="14:00">14:00</option>
                      <option value="15:00">15:00</option>
                      <option value="16:00">16:00</option>
                      <option value="17:00">17:00</option>
                      <option value="18:00">18:00</option>
                      <option value="19:00">19:00</option>
                      <option value="20:00">20:00</option>
                      <option value="21:00">21:00</option>
                      <option value="22:00">22:00</option>
                      <option value="23:00">23:00</option>
                    </select>
                </div>
            </div>
        </div>
        <!--div class="col-sm-3 margin-15-bottom">
            <div class="" style="margin-top:5px">
                <input id="DriverAge" type="checkbox" name="DriverAge" value="1" >
                <label for="DriverAge"><span></span>Driver aged between 25 – 70?</label>
            </div>
        </div-->
    </div>
    <div class="col-sm-12 margin-15-bottom box">
        <div style="padding-bottom:15px"></div>
        <div class="not_valid_captcha" style="display:none; color: red; top:80px"><?php echo pll__('You must fill this field!'); ?></div>
        <div id="g-recaptcha-car" class="g-recaptcha"></div>    
        <button style="top:40px;" type="button" id="launch_car_query" name="launch_car_query" class="btn btn-primary btn-lg search"><?php echo pll__('Search'); ?></button>
    </div>
</form>