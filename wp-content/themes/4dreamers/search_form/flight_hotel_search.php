<form id="flight_hotel_search" name="flight_hotel_search" class="form-inline form-flight-hotel" role="form" method="POST">
  <div id="message" style="display: block;"></div>

  <div class="row">
  <div class="col-sm-6 margin-15-bottom">
      <label class="control-label" for="FromFH"><?php echo pll__('From'); ?></label>
      <div class="controls">
        <i class="fa fa-map-marker infield"></i>
          <input id="FromFH" name="FromFH" type="text" placeholder="City or airport" class="input destination" value="<?php echo 'Belgrade | BEG | Serbia'; ?>">
          <div class="not_valid_fromFH" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
      </div>
   </div>   
   <div class="col-sm-6 margin-15-bottom">
      <label class="control-label" for="ToFH"><?php echo pll__('Flying to'); ?></label>
      <div class="controls">
        <i class="fa fa-map-marker infield"></i>
          <input id="ToFH" name="ToFH" type="text" placeholder="<?php echo pll__('City or airport'); ?>" class="input destination" value="">
          <div class="not_valid_toFH" style="display:none; color: red"><?php echo pll__('You must fill this field!'); ?></div>
      </div>
  </div>
      
      <!-- Text input-->
      <div class="col-sm-4 margin-15-bottom">
          <label class="control-label" for="DepartureDateFH"><?php echo pll__('Departing'); ?></label>
          <div class="controls">
            <i class="fa fa-calendar-o infield"></i>
              <input id="DepartureDateFH" name="DepartureDateFH" readonly="" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+2 days")); ?>" class="input datePicker">
          </div>
      </div>

      <div class="col-sm-2">
          <label class="control-label" for="DepartureTimeFH"><?php echo pll__('Flight time'); ?></label>
          <div class="controls">
              <div class="custom-select fa-caret-down right">
              <select id="DepartureTimeFH" name="DepartureTimeFH" class="l-width">
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
      
      <!-- Text input-->
      <div class="col-sm-4 margin-15-bottom">
          <label class="control-label" for="ReturnDateFH"><?php echo pll__('Returning'); ?></label>
          <div class="controls">
            <i class="fa fa-calendar-o infield"></i>
              <input id="ReturnDateFH" name="ReturnDateFH" readonly="" type="text" placeholder="dd/mm/yyyy" value="<?php echo date('d/m/Y',strtotime("+4 days")); ?>" class="input datePicker">
          </div>
      </div>

      <div class="col-sm-2">
          <label class="control-label" for="DepartureTimeFH"><?php echo pll__('Flight time'); ?></label>
          <div class="controls">
              <div class="custom-select fa-caret-down right">
              <select id="DepartureTimeFH" name="DepartureTimeFH" class="l-width">
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
      
      <div class="col-lg-9 col-md-12 col-sm-12 margin-15-bottom" style="height:64px;">
        <!-- Select Rooms -->
        <div class="left spec">
            <label class="control-label" for="NumRooms"><?php echo pll__('Rooms'); ?></label>
            <div class="controls">
              <div class="custom-select fa-caret-down right">
                <select id="NumRooms" name="NumRooms" class="l-width">
                    <option selected="selected">1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                </div>
            </div>
        </div>

        <!-- Room 1 -->
        <div class="room1">
          <div class="room-no">1.</div>
          <div class="left spec">
              <label class="control-label" for="AdtCount1"><?php echo pll__('Adult'); ?> (+18)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                      <select id="AdtCount1" name="AdtCount1" class="l-width">
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
          <div class="left spec">
              <label class="control-label" for="ChdCount1"><?php echo pll__('Child'); ?> (2-11)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                  <select id="ChdCount1" name="ChdCount1" class="l-width">
                      <option selected="selected">0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                  </select>
                  </div>
              </div>
          </div>
        </div>
        <!-- Room 2 -->
        <div class="room2">
          <div class="room-no">2.</div>
          <div class="left spec">
              <label class="control-label" for="AdtCount2"><?php echo pll__('Adult'); ?> (+18)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                      <select id="AdtCount2" name="AdtCount2" class="l-width">
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
          <div class="left spec">
              <label class="control-label" for="ChdCount2"><?php echo pll__('Child'); ?> (2-11)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                  <select id="ChdCount2" name="ChdCount2" class="l-width">
                      <option selected="selected">0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                  </select>
                  </div>
              </div>
          </div>
        </div> 
        <!-- Room 3 -->
        <div class="room3">
          <div class="room-no">3.</div>
          <div class="left spec">
              <label class="control-label" for="AdtCount3"><?php echo pll__('Adult'); ?> (+18)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                      <select id="AdtCount3" name="AdtCount3" class="l-width">
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
          <div class="left spec">
              <label class="control-label" for="ChdCount3"><?php echo pll__('Child'); ?> (2-11)</label>
              <div class="controls">
                <div class="custom-select fa-caret-down right">
                  <select id="ChdCount3" name="ChdCount3" class="l-width">
                      <option selected="selected">0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                  </select>
                  </div>
              </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="col-sm-12 margin-15-top box">
      <div class="not_valid_captcha" style="display:none; color: red; top: 50px;"><?php echo pll__('You must fill this field!'); ?></div>
      <div id="g-recaptcha-flight-hotel" class="g-recaptcha"></div> 
      <button type="button" id="launch_flight_hotel_query" name="launch_flight_hotel_query" class="btn btn-primary btn-lg search" ><?php echo pll__('Search'); ?></button>
    </div>  
</form>