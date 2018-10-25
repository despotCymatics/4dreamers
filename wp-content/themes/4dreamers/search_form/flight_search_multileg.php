<form id="flight_search_multileg" name="flight_search_multileg" class="form-inline form-flight-multileg" role="form" method="POST">
  <div id="message" style="display: block;"></div>

  <div class="row">
    <div class="col-sm-12 margin-15-bottom radio-button-box">
        <div class="left radio-field">
            <input type="radio" name="FlightType" value="RoundTrip"><label for="FlightType-0"><span><span></span></span><?php echo pll__('Round trip'); ?></label>
        </div>
        <div class="left radio-field">
            <input type="radio" name="FlightType" value="OneWay"><label for="FlightType-1"><span><span></span></span><?php echo pll__('One way'); ?></label>
        </div>
        <div class="left radio-field">
            <input type="radio" name="FlightType" value="Multileg" checked="checked"><label for="FlightType-2"><span><span></span></span><?php echo pll__('Multileg'); ?></label>
        </div>
    </div>
    <!-- Stop 1 -->
    <div class="stop1">
      <div class="col-sm-5 margin-15-bottom">
          <label class="control-label" for="From1"><?php echo pll__('From'); ?></label>
          <div class="controls">
            <i class="fa fa-map-marker infield"></i>
              <input id="From1" name="From1" type="text" placeholder="<?php echo pll__('City or airport'); ?>" class="input destination" value="<?php echo 'Belgrade | BEG | Serbia'; ?>">
              <div class="not_valid_from1" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
          </div>
      </div>
      <div class="col-sm-5 margin-15-bottom">
          <label class="control-label" for="To1"><?php echo pll__('Flying to'); ?></label>
          <div class="controls">
            <i class="fa fa-map-marker infield"></i>
              <input id="To1" name="To1" type="text" placeholder="City or airport" class="input destination" value="">
              <div class="not_valid_to1" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
          </div>
      </div>   
      <div class="col-sm-2 margin-15-bottom">
          <label class="control-label" for="DepartureDate1"><?php echo pll__('Departing'); ?></label>
          <div class="controls">
            <i class="fa fa-calendar-o infield"></i>
              <input id="DepartureDate1" name="DepartureDate1" readonly="" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+2 days")); ?>" class="input datePicker">
          </div>
      </div>

    </div>

    <div class="stop2">
      <div class="col-sm-5 margin-15-bottom">
          <div class="controls">
            <i class="fa fa-map-marker infield"></i>
              <input id="From2" name="From2" type="text" placeholder="<?php echo pll__('City or airport'); ?>" class="input destination">
              <div class="not_valid_from2" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
          </div>
      </div>
      <div class="col-sm-5 margin-15-bottom">
          <div class="controls">
            <i class="fa fa-map-marker infield"></i>
              <input id="To2" name="To2" type="text" placeholder="<?php echo pll__('City or airport'); ?>" class="input destination" value="">
              <div class="not_valid_to2" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
          </div>
      </div>   
      <div class="col-sm-2 margin-15-bottom">
          <div class="controls">
            <i class="fa fa-calendar-o infield"></i>
              <input id="DepartureDate2" name="DepartureDate2" readonly="" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+4 days")); ?>" class="input datePicker">
          </div>
      </div>
    </div>

    <div class="stop3">
      <div class="col-sm-5 margin-15-bottom">
          <div class="controls">
            <i class="fa fa-map-marker infield"></i>
              <input id="From3" name="From3" type="text" placeholder="<?php echo pll__('City or airport'); ?>" class="input destination">
              <div class="not_valid_from3" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
          </div>
      </div>
      <div class="col-sm-5 margin-15-bottom">
          <div class="controls">
            <i class="fa fa-map-marker infield"></i>
              <input id="To3" name="To3" type="text" placeholder="<?php echo pll__('City or airport'); ?>" class="input destination" value="">
              <div class="not_valid_to3" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
          </div>
      </div>   
      <div class="col-sm-2 margin-15-bottom">
          <div class="controls">
            <i class="fa fa-calendar-o infield"></i>
              <input id="DepartureDate3" name="DepartureDate3" readonly="" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+11 days")); ?>" class="input datePicker">
          </div>
      </div>
    </div>


      
      <!-- Select Basic -->
      <div class="col-sm-6 margin-15-bottom">
          <div class="left spec">
              <label class="control-label" for="AdtCount"><?php echo pll__('Adult'); ?> (+18)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                      <select id="AdtCountM" name="AdtCount" class="l-width">
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
                  <select id="ChdCountM" name="ChdCount" class="l-width">
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
                  <select id="InfCountM" name="InfCount" class="l-width">
                      <option selected="selected">0</option>
                      <option>1</option>
                  </select>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-12 margin-15-bottom">       
        <a class="resetBtn" href="#"><?php echo pll__('Reset Search Criteria'); ?> <i class="fa fa-refresh"></i></a>
      </div>
  </div>

  <div class="col-sm-12 margin-15-top box">
    <div class="not_valid_captcha" style="display:none; color: red; top: 50px;"><?php echo pll__('You must fill this field!'); ?></div>
    <div id="g-recaptcha-multi" class="g-recaptcha"></div>    
    <button type="button" id="launch_flight_multileg_query" name="launch_flight_multileg_query" class="btn btn-primary btn-lg search"><?php echo pll__('Search'); ?></button>
  </div>  
</form>  