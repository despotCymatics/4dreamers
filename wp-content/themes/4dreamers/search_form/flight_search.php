<form id="flight_search" name="flight_search" class="form-inline form-flight" role="form" method="POST">
  <div id="message" style="display: block;"></div>

  <div class="row">
    <div class="col-sm-12 margin-15-bottom radio-button-box">
          <div class="left radio-field">
              <input type="radio" name="FlightType" value="RoundTrip" checked="checked"><label for="FlightType-0"><span><span></span></span><?php echo pll__('Round trip'); ?></label>
          </div>
          <div class="left radio-field">
              <input type="radio" name="FlightType" value="OneWay"><label for="FlightType-1"><span><span></span></span><?php echo pll__('One way'); ?></label>
          </div>
          <div class="left radio-field">
              <input type="radio" name="FlightType" value="Multileg"><label for="FlightType-2"><span><span></span></span><?php echo pll__('Multileg'); ?></label>
          </div>
      </div>
  <div class="col-sm-6 margin-15-bottom">
      <label class="control-label" for="From"><?php echo pll__('From'); ?></label>
      <div class="controls">
        <i class="fa fa-map-marker infield"></i>
          <input id="From" name="From" type="text" placeholder="City or airport" class="input destination" value="<?php echo 'Belgrade | BEG | Serbia'; ?>">
          <div class="not_valid_from" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
      </div>
   </div>   
   <div class="col-sm-6 margin-15-bottom">
      <label class="control-label" for="To"><?php echo pll__('Flying to'); ?></label>
      <div class="controls">
        <i class="fa fa-map-marker infield"></i>
          <input id="To" name="To" type="text" placeholder="<?php echo pll__('City or airport'); ?>" class="input destination" value="">
          <div class="not_valid_to" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
      </div>
  </div>
      
      <!-- Text input-->
      <div class="col-sm-3 margin-15-bottom">
          <label class="control-label" for="DepartureDate"><?php echo pll__('Departing'); ?></label>
          <div class="controls">
            <i class="fa fa-calendar-o infield"></i>
              <input id="DepartureDate" name="DepartureDate" readonly="" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+2 days")); ?>" class="input datePicker">
          </div>
      </div>
      
      <!-- Text input-->
      <div class="col-sm-3 margin-15-bottom">
          <label class="control-label" for="ReturnDate"><?php echo pll__('Returning'); ?></label>
          <div class="controls">
            <i class="fa fa-calendar-o infield"></i>
              <input id="ReturnDate" name="ReturnDate" readonly="" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+4 days")); ?>" class="input datePicker">
          </div>
      </div>
      
      <!-- Select Basic -->
      <div class="col-sm-6 margin-15-bottom">
          <div class="left spec">
              <label class="control-label" for="AdtCount"><?php echo pll__('Adult'); ?> (+18)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                      <select id="AdtCount" name="AdtCount" class="l-width">
                          <option>0</option>
                          <option selected="selected">1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                          <option>8</option>

                      </select>
                  </div>
              </div>
          </div>
          
          <!-- Select Basic -->
          <div class="left spec">
              <label class="control-label" for="ChdCount"><?php echo pll__('Child'); ?> (2-11)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                  <select id="ChdCount" name="ChdCount" class="l-width">
                      <option selected="selected">0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                  </select>
                  </div>
              </div>
          </div>
          
          <!-- Select Basic -->
          <div class="left spec">
              <label class="control-label" for="InfCount"><?php echo pll__('Infant'); ?></label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                  <select id="InfCount" name="InfCount" class="l-width">
                      <option selected="selected">0</option>
                      <option>1</option>
                  </select>
                  </div>
              </div>
          </div>
      </div>
      
      <div class="col-sm-12 margin-15-bottom">
          <div class="left spec IsCalendarSearch">
              <input id="IsCalendarSearch" type="checkbox" name="IsCalendarSearch">
              <label for="IsCalendarSearch-0"><span></span>+ / - 3 <?php echo pll__('days'); ?></label>
          </div>
          <a id="show-advanced-flight" style="cursor:pointer;"><?php echo pll__('Advanced Search'); ?> <i class="fa fa-angle-double-right"></i></a>
          <a class="resetBtn" href="#"><?php echo pll__('Reset Search Criteria'); ?> <i class="fa fa-refresh"></i></a>
      </div>

      <!-- Advanced -->
      <div id="advanced-flight" style="display:none; height:64px;" >
      <div class="col-sm-3">
          <label class="control-label" for="CabinClasses"><?php echo pll__('Flight cabin class'); ?></label>
          <div class="controls">
              <div class="custom-select fa-caret-down right">
              <select id="CabinClasses" name="CabinClasses" class="l-width">
                <option value="Y"><?php echo pll__('Economy'); ?></option>
                <option value="W"><?php echo pll__('Premium'); ?></option>
                <option value="C"><?php echo pll__('Business'); ?></option>
                <option value="F"><?php echo pll__('First'); ?></option>
              </select>
              </div>
          </div>
      </div>
      <div class="col-sm-3">
          <label class="control-label" for="airline0"><?php echo pll__('Airline'); ?></label>
          <div class="controls">
              <i class="fa fa-map-marker infield"></i>
              <input id="airline0" name="airline0" type="text" placeholder="<?php echo pll__('Airline Name'); ?>" class="input destination">
          </div>
      </div>
      <div class="col-sm-3">
          <label class="control-label" for="DepartureTime"><?php echo pll__('Outbound flight time'); ?></label>
          <div class="controls">
              <div class="custom-select fa-caret-down right">
              <select id="DepartureTime" name="DepartureTime" class="l-width">
                <option value="00:01"><?php echo pll__('Anytime'); ?></option>
                <option value="MORNING"><?php echo pll__('Morning'); ?></option>
                <option value="AFTERNOON"><?php echo pll__('Afternoon'); ?></option>
                <option value="EVENING"><?php echo pll__('Evening'); ?></option>
                <option value="00:00">00:00</option>
                <option value="01:00">01:00</option>
                <option value="02:00">02:00</option>
                <option value="03:00">03:00</option>
                <option value="04:00">04:00</option>
                <option value="05:00">05:00</option>
                <option value="06:00">06:00</option>
                <option value="07:00">07:00</option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
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
      <div class="col-sm-3">
          <label class="control-label" for="ReturnTime"><?php echo pll__('Return flight time'); ?></label>
          <div class="controls">
              <div class="custom-select fa-caret-down right">
              <select id="ReturnTime" name="ReturnTime" class="l-width">
                <option value="00:01"><?php echo pll__('Anytime'); ?></option>
                <option value="MORNING"><?php echo pll__('Morning'); ?></option>
                <option value="AFTERNOON"><?php echo pll__('Afternoon'); ?></option>
                <option value="EVENING"><?php echo pll__('Evening'); ?></option>
                <option value="00:00">00:00</option>
                <option value="01:00">01:00</option>
                <option value="02:00">02:00</option>
                <option value="03:00">03:00</option>
                <option value="04:00">04:00</option>
                <option value="05:00">05:00</option>
                <option value="06:00">06:00</option>
                <option value="07:00">07:00</option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
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
      </div>
    </div>
    <div class="col-sm-12 margin-15-top box">
      <!--div class="not_valid_captcha" style="display:none; color: red; top:50px"><?php echo pll__('You must fill this field!'); ?></div>
      <div id="g-recaptcha-flight" class="g-recaptcha"></div-->
      <button type="button" id="launch_flight_query" name="launch_flight_query" class="btn btn-primary btn-lg search" ><?php echo pll__('Search'); ?></button>
    </div>
</form>
<!-- FLIGHT SEARCH Multileg -->
<?php require "flight_search_multileg.php"; ?>